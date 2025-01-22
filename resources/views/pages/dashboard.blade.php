@php
    use App\Models\Gig;

    $gigs = Gig::all();
@endphp

<x-guest-layout>
    @push('styles')
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
            <style>
                .custom-card {
                    border: none;
                    border-radius: 15px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                }
    
                .card-content {
                    display: flex;
                    align-items: center;
                }
    
                .card-content img {
                    width: 80px;
                    margin-right: 20px;
                }
                .card-text{
                    font-size: 15px;
                    font-weight: 400;
                    color: #000 !important;
                }
            </style>
        @endpush
    <!-- Main content -->
    <div class="container container-input-fields">
        <h2 class="ml-5 nav-link">View and Hire Our Host By</h2>
        <input type="hidden" id="filter_flag" value="{{ $where['country_id'] ?? '' }}" />
        <form method="get" action="{{ route('home.dashboard') }}" id="search-form">
            <div class="row" id="search-filter">
                <!-- Country Input -->
                <div class="col-12 col-sm-4 col-md-3 col-lg-2 mt-3">
                    <div class="form-group">
                        <select name="country_id" class="country_id search-from" required>
                            <option value="" disabled selected>Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- State Input -->
                <div class="col-12 col-sm-4 col-md-3 col-lg-2 mt-3">
                    <div class="form-group">
                        <select name="state_id" class="state_id search-from" required>
                            <option value="" disabled selected>Select State</option>
                        </select>
                    </div>
                </div>
                <!-- City Input -->
                <div class="col-12 col-sm-4 col-md-3 col-lg-2 mt-3">
                    <div class="form-group">
                        <select name="city_id" class="city_id search-from" required>
                            <option value="" disabled selected>Select City</option>
                        </select>
                    </div>
                </div>
                <!-- Zip Code Search -->
                <div class="col-12 col-sm-4 col-md-3 col-lg-2 mt-3">
                    <div class="form-group">
                        <select name="zip_id" class="zip_id search-from" required>
                            <option value="" disabled selected>Select Zip</option>
                        </select>
                    </div>
                </div>
    
                <!-- Search Button -->
                <div class="col-12 col-sm-2 col-md-1 col-lg-1 mt-3">
                    <button class="btn btn-block" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
                <!-- Reset Button -->
                <div class="col-12 col-sm-2 col-md-1 col-lg-1 mt-3">
                    <a href="{{ route('home.dashboard') }}">
                        <button type="button" class="btn btn-block">
                            <i class="fa fa-refresh"></i>
                        </button>
                    </a>
                </div>
            </div>
        </form>
    </div>


    <div class="container mt-4">
        <!-- Bootstrap row for creating a horizontal group of columns -->
        <div class="row g-4" id="gigs">
            <!-- Card 1 -->
            @foreach ($gigs as $gig)
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

        </div>
    </div>

    <script>
        function toggleDescription(gigId) {
            var shortDesc = document.getElementById('short-desc-' + gigId);
            var fullDesc = document.getElementById('full-desc-' + gigId);
            var loadMoreBtn = document.getElementById('load-more-btn-' + gigId);

            if (fullDesc.style.display === 'none') {
                fullDesc.style.display = 'inline';
                loadMoreBtn.innerText = 'Show Less';
            } else {
                fullDesc.style.display = 'none';
                loadMoreBtn.innerText = 'Load More';
            }
        }
    </script>
</x-guest-layout>
