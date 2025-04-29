<?php

namespace App\Http\Controllers;

use App\Models\EquipmentPrice;
use App\Models\Gig;
use Illuminate\Http\Request;
use App\Models\GigFeature;
use App\Models\GigMedia;
use App\Models\Task;
use Exception;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class GigController extends Controller
{
    public function __construct() {}

    public function index($status='enabled')
    {
        $data['gigs'] = Gig::where('status', $status)->where('host_id', Auth::id())->paginate(config('app.pagination'));
        $data['equipment_price'] = EquipmentPrice::get()->toArray();        
        return view('host.gig.index', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'task_id' => ['required', 'string'],
            'description' => ['required', 'string'],
            'equipment_price_id' => ['required', 'integer'],
            'equipment_name' => ['nullable', 'string'],
            'equipment_id' => ['required', 'integer'],
            'price' => ['nullable', 'string'],
            'minutes' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
            'country_id' => ['required', 'integer'],
            'state_id' => ['required', 'integer'],
            'city_id' => ['required', 'integer'],
            'zip_id' => ['nullable', 'integer'],

            'price30min' => ['nullable', 'integer'],
            'price60min' => ['nullable', 'integer'],
            'price90min' => ['nullable', 'integer'],
            'price120min' => ['nullable', 'integer'],
        ]);
        // dd($validatedData);
        $validatedData['host_id'] = Auth::user()->id;

        $features = $request->input('features');
        $gigId = $request->input('gig_id');

        DB::beginTransaction();

        try {
            $gig = Gig::updateOrCreate(
                ['id' => $gigId],
                $validatedData
            );



            /*
            GigFeature::where('gig_id', $gig->id)->delete();
            $gigFeatures = [];
            if($features)
            foreach ($features['label'] as $i => $label) {
                $gigFeatures[] = [
                    'gig_id' => $gig->id,
                    'label' => $label,
                    'value' => $features['value'][$i],
                ];
            }
            GigFeature::insert($gigFeatures);  // Bulk insert for performance
            */

                                
            // Initialize the $gigFeatures array
            $gigFeatures = [];

            if ($features) {  
                foreach ($features['label'] as $i => $label) {
                    $featureValue = null;

                    // Check if new file uploaded for this feature
                    if ($request->hasFile('features.value.' . $i)) {
                        $file = $request->file('features.value.' . $i);

                        // Generate unique filename
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/offer_images');

                        // Move the file to the uploads directory
                        $file->move($destinationPath, $filename);

                        // Save the relative path
                        $featureValue = 'public/uploads/offer_images/' . $filename;
                    } else {
                        // If no new file is uploaded, use the existing value from the database
                        $existingFeature = GigFeature::where('gig_id', $gig->id)
                            ->where('label', $label)
                            ->first();

                        // If there's an existing feature value, use it
                        if ($existingFeature) {
                            $featureValue = $existingFeature->value;
                        } else {
                            $featureValue = null;  // or set default if needed
                        }
                    }

                    // If featureValue is not null, prepare the data to either update or insert
                    if ($featureValue !== null) {
                        $gigFeature = GigFeature::where('gig_id', $gig->id)
                                                ->where('label', $label)
                                                ->first();

                        if ($gigFeature) {
                            // Update the existing feature if found
                            $gigFeature->value = $featureValue;
                            $gigFeature->save();
                        } else {
                            // Insert a new feature if not found
                            $gigFeatures[] = [
                                'gig_id' => $gig->id,
                                'label' => $label,
                                'value' => $featureValue,
                            ];
                        }
                    }
                }
            }

            // Bulk insert remaining new features if any
            if (!empty($gigFeatures)) {
                GigFeature::insert($gigFeatures);
            }






            

            DB::commit();

            $message = isset($gigId) ? 'Gig updated successfully.' : 'Gig saved successfully.';
            Session::flash('message', $message);
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('host.gig.addedit', $gig->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('message', 'Error while saving/updating gig: ' . $e->getMessage());
            Session::flash('alert-class', 'alert-warning');
        }

        return redirect()->back();
    }

    public function storeMedia($gig_id="", Request $request)
    {     
        $validatedData = $request->validate([
            'files' => 'required|array', // Ensure 'files' is an array
            'files.*' => 'mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi,mkv|max:20480', // Validate each file in the array
        ], [
            'files.*.mimes' => 'Each file must be an image (jpeg, png, jpg, gif, svg) or a video (mp4, mov, avi, mkv).',
        ]);
        
        try {
            if (!empty($gig_id)) {
                // GigMedia::where('gig_id', $gig_id)->delete();  // Clear old gigs
                $uploadedFilePaths = [];
                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {
                        $path = $file->store('uploads', 'public');
                        $uploadedFilePaths[] = $path;
                        $originalFileName = $file->getClientOriginalName();
                        $fileType = $this->determineFileType($file->getClientMimeType());

                        GigMedia::create([
                            'gig_id' => $gig_id,
                            'name' => $originalFileName,
                            'path' => $path,                    // File path stored in the 'public/uploads' directory
                            'type' => $fileType,                // Type of file (image or video)
                        ]);
                    }
                }
                Session::flash('gig_id', $gig_id);
                Session::flash('message', 'Media uploaded successfully.');
            }
            
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('message', 'Error while saving/updating gig: ' . $e->getMessage());
            Session::flash('alert-class', 'alert-warning');
            return redirect()->back();
        }
    }






    public function deleteMediaOffer($offer_id, Request $request)
    {
        try {
            $feature = GigFeature::find($offer_id);
    
            if ($feature) {
                if (!empty($feature->value)) {
                    // Get only the file name from the full path
                    $filename = basename($feature->value);
    
                    // Build the full image path
                    $imagePath = public_path('uploads/offer_images/' . $filename);
    
                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }
                }
    
                // Now delete the record from the table
                $feature->delete();
    
                return response()->json(['status' => 'success', 'message' => 'Offer image deleted successfully.']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'No offer found with this ID.']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error while deleting: ' . $e->getMessage()]);
        }
    }
    



    public function deleteMedia($media_id, Request $request)
    {     
        try {
            GigMedia::where('id', $media_id)->delete();
            Session::flash('message', 'Media deleted successfully.');
            Session::flash('alert-class', 'alert-success');
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Session::flash('message', 'Error while deleted media: ' . $e->getMessage());
            Session::flash('alert-class', 'alert-warning');
            return response()->json(['status' => 'error']);
        }
    }

    private function determineFileType($mimeType)
    {
        if (strpos($mimeType, 'image') !== false) {
            return 'image';
        } elseif (strpos($mimeType, 'video') !== false) {
            return 'video';
        } else {
            return 'unknown';
        }
    }

    public function addedit($gig_id = "")
    {
        $data['gig'] = [];
        $data['selectedGig'] = [];

        if($gig_id != ""){
            $data['gig'] = Gig::with(['task', 'country', 'state', 'city', 'zip', 'equipmentPrice'])->findOrFail($gig_id);
            $data['selectedGig'] = GigFeature::where('gig_id', $gig_id)
            ->pluck('gig_id')
            ->toArray();
        }
        $data['tasks'] = Task::get();        
        $data['equipment_price_all'] = EquipmentPrice::get();        
        $data['country'] = DB::table('countries')->get();
        $data['gigs'] = Gig::all();
        
        return view('host.gig.addedit', $data);
    }

    public function destroy(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? "";
            unset($data['id']);
            Gig::where("user_id", $id)->delete();

            Session::flash('message', 'Gig deleted successfully.');
            Session::flash('alert-class', 'alert-success');

            return response()->json(['success' => 'Gig deleted successfully'], 200);
        } catch (Exception $e) {
            Session::flash('message', 'Error while deleting gig.');
            Session::flash('alert-class', 'alert-warning');

            return response()->json(['error' => 'Error while deleting gig'], 400);
        }
    }

    public function status(Request $request, Gig $gig)
    {
        $status = $request->query('status');

        if (in_array($status, [0, 1, 2])) {
            $gig->update(['status' => $status]);
        } else {
            return response()->json(['error' => 'Invalid status value'], 400);
        }
        Session::flash('message', 'Gig status updated successfully');
        Session::flash('alert-class', 'alert-success');

        return response()->json(['success' => 'Gig status updated successfully'], 200);
    }
}
