@extends('frontend.amazy.layouts.app')

@php
    $page = \Modules\FrontendCMS\Entities\DynamicPage::where('slug', 'about-us')->first();
@endphp


@section('title')
{{$content->mainTitle}}
@endsection

@section('title')
Auction Product Gallery | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content=" {{$content->mainTitle}} | {{ config('app.name') }}">
<meta name="description" content="{{$content->mainTitle}} | {{ config('app.name') }}">
<meta property="og:title" content="{{$content->mainTitle}} | {{ config('app.name') }}" />
<meta property="og:description" content="{{$content->mainTitle}} | {{ config('app.name') }}" />
<meta property="og:url" content="{{url()->current()}}" />
@endsection

@push('styles')
<style>


    .about-page-wrapper {
        font-family: 'Poppins', sans-serif;
        color: black;
    }

    .about-section {
        padding: 80px 0;
        position: relative;
    }

  
    .title {
        color: black;
        font-size: 50px;
        margin-bottom: 30px;
    }
   

  

    .about-image {
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        object-fit: cover;
        width: 100%;
        max-height: 690px;
    }

  

    .about-text {
        font-size: 1.125rem;
        line-height: 1.9;
        color: black;
    }

    .about-text p {
        margin-bottom: 24px;
    }

    .quote-box {
    
        padding: 20px 30px;
      
        border-radius: 0 10px 10px 0;
        margin: 30px 0;
        font-style: italic;
        color: #444;
    }

    .feature-item {
        margin-bottom: 30px;
        display: flex;
        align-items: flex-start;
    }

    

    .feature-item:hover .feature-icon {
        background: #ff6b6b;
        color: #fff;
        transform: rotateY(180deg);
    }

    .mission-text {
        font-weight: 800;
        font-size: 1.2rem;
        letter-spacing: 3px;
        background: linear-gradient(90deg, #333, #666);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-transform: uppercase;
        margin-top: 2rem;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .about-section {
            padding: 50px 0;
        }
        .about-title {
            font-size: 2rem;
        }
        .sale-tag {
            font-size: 2.5rem;
        }
        .about-image {
            min-height: 300px;
            margin-bottom: 40px;
        }
    }
</style>
@endpush

@section('content')

<div class="about-page-wrapper">
    <!-- Our Story Section -->
    <section class="about-section bg-white py-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h1 class="title">Our Story</h1>
                </div>
                
                <div class="col-lg-6 col-md-12 mb-5 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1564399580075-5dfe19c205f3?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-fluid about-image" alt="Our Story">
                </div>
                
                <div class="col-lg-6 col-md-12 mb-5">
                    <div class="ps-lg-5 about-text">
                        <p>
                            A writer and a painter walk into a bar after a long day at work.
                            The bartender looks at them and says, “You two look exhausted. What kind of business are you in?”
                            The creatives glance at each other, then back at him, and answer in unison:
                        </p>
                        
                           <p class="fw-bold text-dark mb-4" style="font-size: 1.2rem;">Sales</p>
                        
                        <p>
                            Because to be a successful artist, creativity isn’t enough.
                            Between marketing, networking, sales, invoicing, and everything in between, artists are expected to wear every hat—often at the expense of the work they love.
                        </p>
                        
                        <p class="fw-bold text-dark mb-4" style="font-size: 1.2rem;">23LD exists to lighten that load.</p>
                        
                        <p>
                            Alex (a writer) and Devin (a painter) met in a sales program and bring more than 18 years of combined experience in sales and business development.
                            Two simple questions sparked the idea for 23LD:
                        </p>
                        
                        <div class="quote-box">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3">“Why do salesmen moonlight as creatives, but creatives rarely moonlight as salesmen?”</li>
                                <li>“And why should it be so hard for creative passions to support real lives, real families, and real dreams?”</li>
                            </ul>
                        </div>
                        
                        <p>So we built 23LD as a bridge between artists and their communities by:</p>
                        
                        <ul class="mb-4 text-dark font-weight-bold ml-4">
                            <li class="mb-2">Creating an online platform where artists can sell their work and services</li>
                            <li>Partnering with local businesses that want to display and rotate art from emerging local talent</li>
                        </ul>
                        
                        <p class="mission-text">Create. Connect. Collect.</p>
                        <p>That’s our mission–and we welcome all who want to help us achieve it.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do Section -->
    <section class="about-section py-80 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h1 class="about-title" style="padding-bottom: 50px;">What We Do</h1>
                 
                </div>
                
                <!-- Image column -->
                <div class="col-lg-6 col-md-12 order-lg-2 mb-5 mb-lg-0">
                     <img src="https://images.unsplash.com/photo-1569084024058-1632922a4e1d?q=80&w=719&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-fluid about-image" alt="What We Do">
                </div>
                
                <!-- Content column -->
                <div class="col-lg-6 col-md-12 order-lg-1">
                    <div class="pe-lg-5 about-text">
                        <p class="lead mb-10" style="font-weight: 500;">
                            At 23LD, we build bridges. Between artists and the people who want their work. Between local businesses and the communities they serve. Between buyers and the art being created right in their own backyard.
                        </p>
                        
                        <h5 class="mb-10 fw-bold text-dark">Our work breaks down into three parts:</h5>
                        
                        <div class="feature-item">

                            <div>
                                <h6 class="fw-bold text-dark mb-2">We help artists get seen.</h6>
                                <p class="mb-0 fs-6">Whether it’s selling original pieces, offering creative services, or landing their work in local spaces, we connect artists to real opportunities, not algorithms.</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">

                            <div>
                                <h6 class="fw-bold text-dark mb-2">We help locations come alive.</h6>
                                <p class="mb-0 fs-6">Breweries, cafés, offices, storefronts—anywhere with empty walls or the same tired prints—we bring in rotating local art that elevates the space, draws in customers.</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">

                            <div>
                                <h6 class="fw-bold text-dark mb-2">We help buyers discover local talent.</h6>
                                <p class="mb-0 fs-6">People want to buy local art; they just don’t always know where to find it. We make it easy. Buyers meet the artists who live, work, and create right around them.</p>
                            </div>
                        </div>
                        
                        <p class="mission-text mt-4">Create. Connect. Collect.</p>
                        <p>That’s what we do. And we’re building a world where local art isn’t hard to find; it’s everywhere you look.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

