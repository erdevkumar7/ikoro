@extends('admin.layouts.app')
@section('title', 'Match Tasks')
@section('content')
  <div class="container-fluid" style="width: 93%;">
      <div class="container-fluid mt-4">
            <h4>Match Booking </h4>
            <table class="table table-responsive-md table-responsive-sm table-bordered mt-2 mb-4">
                <thead>
                    <tr>
                        <th scope="col">Task</th>
                        <th scope="col">Description</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Preferred Gender</th>
                        <th scope="col">Preferred Time</th>
                        <th scope="col">Location</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{$booking['title']}}</th>
                        <td>{{$booking['briefing']}}</th>
                        <td>{{$booking['name']}}</th>
                        <td>{{$booking['preferred_gender']}}</th>
                        <td>{{$booking['operation_time']}}</td>
                        <td>{{$booking['country_name']}} - {{$booking['state_name']}} - {{$booking['city_name']}} - {{$booking['zipcode']}}</td>
                    </tr>
                </tbody>
            </table>

            <h5>Hosts Matching</h5> 
            
            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif

            <div>
                <table class="table table-responsive-md table-responsive-sm table-bordered mt-2">
                    <thead>
                        <tr>
                            <th scope="col">Host</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Phone</th>
                            <th scope="col">WhatsApp</th>
                            <th scope="col">Location</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $displayedHostIds = [];
                        @endphp
                        
                        @forelse($gigs as $gig)
                        @if (!in_array($gig['host_id'], $displayedHostIds))
                        <tr>
                            <th scope="row">{{$gig['host']['name']}}</th>
                            <td>{{$gig['host']['gender']}}</th>
                            <td>{{$gig['host']['phone']}}</th>
                            <td>{{$gig['host']['whatsapp_no']}}</th>
                            <td>{{$gig['country']['name']}} - {{$gig['state']['name']}} - {{$gig['city']['name']}} - {{$gig['zip']['code']}}</td>
                            <td class="action-td-width">
                                @if(($booking['host_id'] ?? "") == $gig['host']['user_id'])
                                Assigned
                                @else
                                    @if(empty($booking['host_id'] ?? ""))
                                    <a class=" btn btn-outline-success" href="{{route('admin.booking.action', [$booking['id'], $gig['host']['user_id']])}}?action=assign">Assign</a>
                                    @endif
                                @endif

                            </td>
                        </tr>
                        
                        @php
                        $displayedHostIds[] = $gig['host_id'];
                        @endphp
                        
                        @endif

                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No Hosts Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
          </div>
      </div>
  </div>
@endsection