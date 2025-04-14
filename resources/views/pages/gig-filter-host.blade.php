@extends('layouts.home-layout')
@section('page_conent')
    <div>
        @if ($gigs->isNotEmpty())
            <div class="filter-host-user">
                {{-- <div class="row select-host-click" data-id="{{ $gig->host->id }}" data-url="{{ route('get.selectedhost') }}"> --}}

                <div class="row partial-host-list">
                    @foreach ($gigs as $gig)
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('get.host.profile', $gig->host->id) }}">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 host-image">
                                                @if ($gig->host->image)
                                                    <img class="d-block" src="{{ asset('public/' . $gig->host->image) }}"
                                                        alt="">
                                                @else
                                                    <img class="d-block w-100" src="{{ asset('frontend/images/host.jpg') }}"
                                                        alt="">
                                                @endif
                                            </div>
                                            <div class="col-6 mt-4 host-by-name">
                                                <span class="nav-link-dash host-name-text">Host :
                                                    {{ $gig->host->name }}</span>
                                                <span class="nav-link-dash gender-host-text">Gender :
                                                    {{ $gig->host->gender }}</span>
                                            </div>
                                        </div>
                                        <div class="text nav-link-dash font-weight-bold mt-3">
                                            {{ $gig->country->name ?? 'no-country' }} -
                                            {{ $gig->state->name ?? 'no-state' }} -
                                            {{ $gig->city->name ?? 'no-city' }} -
                                            {{ $gig->zip->code ?? 'no-zipcode' }}
                                        </div>

                                        <div class="text nav-link-dash">Phone : {{ $gig->host->phone }}</div>
                                        <div class="text nav-link-dash">WhatsApp : {{ $gig->host->whatsapp_no }}</div>
                                        <div class="text nav-link-dash">Services : {{ $gig->task->title }}</div>
                                        <div class="text nav-link-dash">Tool used :
                                            {{ $gig->equipmentPrice->equipment->name }}</div>
                                    </div>
                                </div>
                            </a>
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
