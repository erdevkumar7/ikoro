<div class="row filter-host-user">
    @foreach ($gigs as $gig)
        {{-- <div class="row select-host-click" data-id="{{ $gig->host->id }}" data-url="{{ route('get.selectedhost') }}"> --}}
        <div class="row partial-host-list">
            <a href="{{ route('get.host.profile', $gig->host->id) }}">
                <div class="card p-3 mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                @if ($gig->host->image)
                                    <img class="d-block" width="100" src="{{ asset('public/' . $gig->host->image) }}"
                                        alt="">
                                @else
                                    <img class="d-block" width="100" src="{{ asset('frontend/images/host.jpg') }}"
                                        alt="">
                                @endif
                            </div>
                            <div class="col-md-6 mt-4">
                                <span class="nav-link-dash">Hosted by
                                    {{ $gig->host->name }}</span>
                            </div>
                        </div>
                        <div class="text nav-link-dash font-weight-bold mt-4">
                            {{ $gig->country->name ?? 'no-country' }} -
                            {{ $gig->state->name ?? 'no-state' }} -
                            {{ $gig->city->name ?? 'no-city' }} -
                            {{ $gig->zip->code ?? 'no-zipcode' }}</div>
                        <div class="text nav-link-dash">Gender : {{ $gig->host->gender }}</div>
                        <div class="text nav-link-dash">Phone : {{ $gig->host->phone }}</div>
                        <div class="text nav-link-dash">WhatsApp : {{ $gig->host->whatsapp_no }}
                            <div class="text nav-link-dash">Services : {{ $gig->task->title }}</div>
                            <div class="text nav-link-dash">Tool used :
                                {{ $gig->equipmentPrice->equipment->name }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
