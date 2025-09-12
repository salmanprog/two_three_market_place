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
                <div class="col-sm-3 ui-resizable" data-type="container-content">
                    <div data-type="component-photo">
                        <div class="photo-panel">
                            <img src="{{asset('')}}Modules/PageBuilder/Resources/assets/keditor/snippets/img/buyer_login.jfif" width="100%" height="334px" style="display: inline-block;" class="img-circle">
                        </div>
                    </div>
                    <div data-type="component-text">
                        <p style="text-align: center;">Create your buyer account to explore products, connect with sellers, and start purchasing.</p>
                        <div style="text-align:center;">
                            <a href="{{URL('/login')}}" class="home10_primary_btn2 gj-cursor-pointer mb-0 small_btn">
                                Login as Buyer
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 ui-resizable" data-type="container-content">
                    <div data-type="component-photo">
                        <div class="photo-panel">
                            <img src="{{asset('')}}Modules/PageBuilder/Resources/assets/keditor/snippets/img/artist_login.jfif" width="100%" height="334px" style="display: inline-block;" class="img-circle">
                        </div>
                    </div>
                    <div data-type="component-text">
                        <p style="text-align: center;">Create your Artist account to upload your artwork and start selling your paintings today.</p>
                        <div style="text-align:center;">
                            <a href="{{route('seller.login')}}" class="home10_primary_btn2 gj-cursor-pointer mb-0 small_btn">
                                Login as Artist
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 ui-resizable" data-type="container-content">
                    <div data-type="component-photo">
                        <div class="photo-panel">
                            <img src="{{asset('')}}Modules/PageBuilder/Resources/assets/keditor/snippets/img/event_login.jpg" width="100%" height="334px" style="display: inline-block;" class="img-circle">
                        </div>
                    </div>
                    <div data-type="component-text">
                        <p style="text-align: center;">Create your Organizer account to start hosting and managing events today.</p>
                        <div style="text-align:center;">
                            <a href="{{route('event.login')}}" class="home10_primary_btn2 gj-cursor-pointer mb-0 small_btn">
                                Login as Organiser
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 ui-resizable" data-type="container-content">
                    <div data-type="component-photo">
                        <div class="photo-panel">
                            <img src="{{asset('')}}Modules/PageBuilder/Resources/assets/keditor/snippets/img/interior_designer.jpg" width="100%" height="334px" style="display: inline-block;" class="img-circle">
                        </div>
                    </div>
                    <div data-type="component-text">
                        <p style="text-align: center;">Create your Interior designers account transform spaces by planning layouts.</p>
                        <div style="text-align:center;">
                            <a href="{{URL('/login')}}" class="home10_primary_btn2 gj-cursor-pointer mb-0 small_btn">
                                Login as Interior Designers
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


