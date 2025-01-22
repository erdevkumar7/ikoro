<x-guest-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/dashboard.css') }}">
        <style>
            i:hover{
                color: rgba(250, 250, 12, 0.82);
            }
        </style>
    @endpush
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-8">
                <h2 class="nav-link">{{ $gig->title }}</h2>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="live-text btn">Save</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            @foreach ($gig->media as $key => $media)
                @if ($key === 0)
                    <div class="col-md-6">
                        <img class="d-block w-100" src="{{ asset('storage/app/public/' . $media->path) }}"
                            alt="Slide {{ $key + 1 }}">
                    </div>
                @else
                    <div class="col-md-3 mt-3">
                        <img class="d-block w-100" src="{{ asset('storage/app/public/' . $media->path) }}"
                            alt="Slide {{ $key + 1 }}">
                    </div>
                @endif
            @endforeach
        </div>
        <div class="text font-weight-bold mt-4 nav-link">{{ $gig->country->name ?? 'no-country'}} - {{ $gig->state->name ?? 'no-state'}} - {{ $gig->city->name ?? 'no-city'}} - {{ $gig->zip->code ?? 'no-zipcode'}}</div>
        @foreach ($gig->features as $feature)
        <div class="text nav-link">{{ $feature->label }} - {{ $feature->value }}</div>
        @endforeach
        <div class="text nav-link font-weight-bold mt-2">
            @for ($i = 1; $i <= 5; $i++)
                <i class="fa fa-star-o"></i>
            @endfor 
             <span> 1- <i class="fa-solid fa-comments"></i></span>
            </div>
        <div class="row">
            <div class="col-md-4 mt-3 card-main" style="margin-right: 760px;">
                <div class="card p-3 mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img class="d-block" width="100" src="{{ asset('public/'.$gig->host->image) }}" alt="">
                            </div>
                            <div class="col-md-6 mt-4">
                                <span class="nav-link-dash">Hosted by {{ $gig->host->name }}</span>
                            </div>
                        </div>
                        <div class="text nav-link-dash font-weight-bold mt-4">{{ $gig->country->name ?? 'no-country'}} - {{ $gig->state->name ?? 'no-state'}} - {{ $gig->city->name ?? 'no-city'}} - {{ $gig->zip->code ?? 'no-zipcode'}}</div>
                        <div class="text nav-link-dash">Gender : {{ $gig->host->gender }}</div>
                        <div class="text nav-link-dash">Phone : {{ $gig->host->phone }}</div>
                        <div class="text nav-link-dash">WhatsApp : {{ $gig->host->whatsapp_no }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
