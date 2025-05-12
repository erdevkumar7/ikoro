<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Commission;
use App\Models\Host;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BankController extends Controller
{
    public function host_addEditBank()
    {
        $host = Host::where('user_id', Auth::user()->id)->first();

        if (!$host) {
            return redirect()->back()->withErrors(['error' => 'Invalid or missing host.']);
        }
        $data['bank'] = [];
        $data['bank'] = Host::with(['bank'])->findOrFail($host->id);
        return view('host.bankAddEdit', $data);
    }

    public function host_saveBankDetail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:75'],
            'account_number' => ['required', 'integer'],
            'branch_code' => ['required', 'integer'],
            'swift_code' => ['required', 'integer'],
        ]);

        // Get the authenticated host
        // $host = Auth::guard('host')->user();
        $host = Host::where('user_id', Auth::user()->id)->first();

        if (!$host) {
            return redirect()->back()->withErrors(['error' => 'Invalid or missing host.']);
        }

        $validatedData['host_id'] = $host->id;
        $bankId = $request->input('bank_id');

        try {
            // You may want to wrap this in a DB transaction if there are related operations
            $bank = Bank::updateOrCreate(
                ['id' => $bankId, 'host_id' => $host->id], // Ensure host_id is matched on update
                $validatedData
            );

            $message = $bankId ? 'Bank-detail updated successfully.' : 'Bank-detail saved successfully.';
            Session::flash('message', $message);
            Session::flash('alert-class', 'alert-success');

            return redirect()->route('host.addEditBank');
        } catch (\Exception $e) {
            Session::flash('message', 'Error while saving/updating bank: ' . $e->getMessage());
            Session::flash('alert-class', 'alert-warning');
            return redirect()->back();
        }
    }


    public function adminCommissionForm()
    {
        $commission = Commission::first();
        return view('admin.commission', compact('commission'));
    }

    public function storeCommission(Request $request)
    {
        $request->validate([
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        Commission::create([
            'percentage' => $request->percentage,
        ]);
        Session::flash('message', 'Commission created successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.commission.form')->with('success', 'Commission created successfully.');
    }

    public function updateCommission(Request $request, $id)
    {
        $request->validate([
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        $commission = Commission::findOrFail($id);
        $commission->update([
            'percentage' => $request->percentage,
        ]);
        Session::flash('message', 'Commission updated successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.commission.form')->with('success', 'Commission updated successfully.');
    }
}
