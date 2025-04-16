@extends('layouts.home-layout')
@section('page_conent')
    <div>
        @if ($gigs->isNotEmpty())
            <div class="filter-host-user">
                {{-- <div class="row select-host-click" data-id="{{ $gig->host->id }}" data-url="{{ route('get.selectedhost') }}"> --}}

                <div class="row partial-host-list">
                    @foreach ($gigs as $gig)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 host-image">
                                            @if ($gig->host->image)
                                                <img class="d-block" src="{{ asset('public/' . $gig->host->image) }}"
                                                    alt="">
                                            @else
                                                <img class="d-block w-100" src="{{ asset('frontend/images/host.jpg') }}"
                                                    alt="">
                                            @endif
                                        </div>
                                        <div class="col-8 mt-4 host-by-name">
                                            <span class="nav-link-dash host-name-text">
                                                <i class="fa fa-user" aria-hidden="true"></i> {{ $gig->host->name }}</span>

                                                <div class="text nav-link-dash font-weight-bold mt-3">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>   
                                                    {{ $gig->city->name ?? 'no-city' }},                                                 
                                                    {{ $gig->state->name ?? 'no-state' }}                                                    
                                                </div>
            
                                                <div class="text nav-link-dash"><i class="fa fa-cogs" aria-hidden="true"></i> {{ $gig->task->title }}</div>
                                                <div class="text nav-link-dash">
                                                    <i class="fa fa-camera-retro" aria-hidden="true"></i>
                                                    {{ $gig->equipmentPrice->equipment->name }}</div>
                                        </div>
                                    </div>
                                 
                                </div>
                                <div class="filter-view-more">
                                    <a href="{{ route('get.host.profile', $gig->host->id) }}">View More</a>
                                </div>
                            </div>
                          
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="d-flex justify-content-center gig-filter-paginate">
                {{ $gigs->links() }}
            </div>
        @else
            <div class="emptyhost-page">
                <span class="text-white"><b>No host found for the selected fields!</b></span>
            </div>
        @endif
    </div>
@endsection
