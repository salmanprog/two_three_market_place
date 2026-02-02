@extends('frontend.amazy.layouts.app')
@push('styles')
@endpush
@section('content')
    <section class="nav-dp-wrapper">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h1 class="nav-dp-title">Hospitality</h1>
                </div>
                <div class="col-lg-4">
                    <div class="nav-dp-img-wrapper">
                        <img src="../public/images/locations/hospitality.png" alt="hospitality">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="nav-dp-img-wrapper">
                        <img src="../public/images/locations/hospitality-02.png" class="w-100" style="max-height: 340px;" alt="hospitality">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="nav-dp-content-wrapper">
                        <h2 class="nav-dp-hd-md">"Hotels, Airbnbs, Restaurants—oh my!"</h2>
                        <p>
                            Wherever people spend their time, local art leaves a mark.
                        </p>
                        <p>
                            Sometimes it's a fuzzy feeling that keeps them coming back.
                        </p>
                        <p>
                            Other times, it's a clear signal: we care about this community.
                        </p>
                        <p>
                            Either way, displaying local art doesn't just make our artists happy.
                        </p>
                        <p>
                            It makes your regulars happy, too.
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection
