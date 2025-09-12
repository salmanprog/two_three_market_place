@extends(theme('layouts.app'))
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('Modules/PageBuilder/Resources/assets/css/affiliate.css')}}">
    <style>
        .row{
            margin: 0!important;
        }
    </style>
@endsection

@section('content')


<div class="row">
    <div class="container mt_30 mb_30">
        <div data-type="container" data-preview="{{asset('')}}Modules/PageBuilder/Resources/assets/keditor/snippets/preview/articles_list.png" data-keditor-title="Articles List" data-keditor-categories="Text;Heading;Photo">
            <div class="row">
                <div class="col-sm-4 ui-resizable" data-type="container-content">
                    <div data-type="component-photo">
                        <div class="photo-panel">
                            <img src="{{asset('')}}Modules/PageBuilder/Resources/assets/keditor/snippets/img/buyer.jpg" width="100%" height="334px" style="display: inline-block;" class="img-circle">
                        </div>
                    </div>
                    <div data-type="component-text">
                        <p style="text-align: center;">Create your buyer account to explore products, connect with sellers, and start purchasing.</p>
                        <div style="text-align:center;">
                            <a href="{{route('frontend.buyer.signup')}}" class="home10_primary_btn2 gj-cursor-pointer mb-0 small_btn">
                                Become a Buyer
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 ui-resizable" data-type="container-content">
                    <div data-type="component-photo">
                        <div class="photo-panel">
                            <img src="{{asset('')}}Modules/PageBuilder/Resources/assets/keditor/snippets/img/artist.jfif" width="100%" height="334px" style="display: inline-block;" class="img-circle">
                        </div>
                    </div>
                    <div data-type="component-text">
                        <p style="text-align: center;">Create your Artist account to upload your artwork and start selling your paintings today.</p>
                        <div style="text-align:center;">
                            <a href="{{route('frontend.merchant-register','subscription')}}" class="home10_primary_btn2 gj-cursor-pointer mb-0 small_btn">
                                Become a Artist
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 ui-resizable" data-type="container-content">
                    <div data-type="component-photo">
                        <div class="photo-panel">
                            <img src="{{asset('')}}Modules/PageBuilder/Resources/assets/keditor/snippets/img/eventss.jpg" width="100%" height="334px" style="display: inline-block;" class="img-circle">
                        </div>
                    </div>
                    <div data-type="component-text">
                        <p style="text-align: center;">Create your Organizer account to start hosting and managing events today.</p>
                        <div style="text-align:center;">
                            <a href="{{route('frontend.event-organiser-register','subscription')}}" class="home10_primary_btn2 gj-cursor-pointer mb-0 small_btn">
                                Become a Organiser
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


