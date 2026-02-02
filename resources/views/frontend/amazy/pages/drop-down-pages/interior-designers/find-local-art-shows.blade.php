@extends('frontend.amazy.layouts.app')
@push('styles')
@endpush
@section('content')
    <section class="nav-dp-wrapper">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h1 class="nav-dp-title">Find Local Art Shows</h1>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-img-wrapper">
                        <img src="../public/images/interior-designers/local-art.png" alt="local-art-show">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nav-dp-content-wrapper">
                        <!-- <h2 class="nav-dp-hd-md">Our goal isn’t to compete with you, but to support and promote. </h2> -->
                        <p>
                       Our Locations are constantly hosting new art shows for you to enjoy! Some of these events will be free, and some are ticketed. 
                        </p>
                        <p>Please be respectful to the artists and their art when you go!* </p>
                        <p>
                    *Confirm individual events’ age limits before attending

                        </p>
                       <p></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection