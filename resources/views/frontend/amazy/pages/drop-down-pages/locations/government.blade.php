@extends('frontend.amazy.layouts.app')
@push('styles')
@endpush


@section('content')
    <section class="nav-dp-wrapper">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-40 line-height-1-2 mx-auto" style="max-width: 920px;" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" data-aos-anchor-placement="top-bottom">Government</h1>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper reduce-img-size">
                        <img src="../public/images/locations/government.jpg" alt="government">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-content-wrapper">
                        <h2 class="nav-dp-hd-md">"Where's my bust of George Washington?"</h2>
                        <p>
                            Paintings and sculptures are how we immortalized the founding fathers and wouldn't have known what they looked like without the artists who made history through art.
                        </p>
                        <p>
                            Art history is embedded in the government and should continue to be the case. 23LD works with local, city, state, and federal governments to provide the next art pieces to commemorate the people who serve our country.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
