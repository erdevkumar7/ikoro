{{-- @foreach ($data as $gig)
    <div class="col col-cards">
        <div class="">
            <div id="carousel{{ $gig->id }}" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($gig->media as $key => $media)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img class="d-block w-100" src="{{ asset('storage/app/public/' . $media->path) }}"
                                alt="Slide {{ $key + 1 }}">
                        </div>
                    @endforeach
                    <div class="carousel-overlay">
                        <div class="live-text btn">Live</div>
                        <div class="additional-text additiona-img">
                            <img
                                src="{{ asset('frontend/images/upload-icon-vector-illustration-removebg-preview.png') }}">
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carousel{{ $gig->id }}" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel{{ $gig->id }}" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="card-body">
                <a href="{{ route('home.dashboard.details', $gig->id) }}" class="nav-link">
                    <h4 class="text-left mb-0 nav-link">{{ $gig->title }}</h4>
                    <p class="text-left mb-0 nav-link">Hosted by {{ $gig->host->name }}</p>
                    <p class="text-left mb-0 nav-link">{{ $gig->price }}$/{{ $gig->minutes }}mins
                    </p>
                </a>
            </div>
        </div>
    </div>
@endforeach --}}


@foreach ($data as $gig)
<div class="col-md-4 mt-3">
    <div class="card custom-card" style="background: rgb(173, 239, 41);">
        <div class="card-content">
            <div>
                <h5 class="card-title">{{ $gig->title }}</h5>
                <p class="card-text">
                    <span class="short-description" id="short-desc-{{ $gig->id }}">
                        {{ Str::limit($gig->description, 70) }}
                    </span>
                    <span class="full-description" id="full-desc-{{ $gig->id }}"
                        style="display:none;">
                        {{ $gig->description }}
                    </span>
                    <a href="javascript:;" onclick="toggleDescription({{ $gig->id }})"
                        id="load-more-btn-{{ $gig->id }}">
                        Load More
                    </a>
                </p>
                <a href="{{ route('home.dashboard.details', $gig->id) }}"
                    class="btn btn-outline-secondary">Details</a>
            </div>
            @if ($gig->media && $gig->media->isNotEmpty())
                <img class="d-block w-30" src="{{ asset('storage/app/public/' . $gig->media->first()->path) }}"
                    alt="Image">
            @else
                <img src="{{ asset('frontend/images/logo.jpg') }}" alt="Image">
            @endif
        </div>
    </div>
</div>
@endforeach
