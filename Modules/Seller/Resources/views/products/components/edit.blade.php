@extends('backEnd.master')
@php
    $sellerMapsEnabled = config('app.map_api_status') == 'true' && filled(config('app.map_api_key'));
@endphp
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/seller/css/edit.css'))}}"/>
@include('seller::products.partials.product_address_styles')
@endsection
@section('mainContent')
@if(isModuleActive('FrontendMultiLang'))
@php
$LanguageList = getLanguageList();
@endphp
@endif
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between w-100">
                            <h3 class="mb-0 mr-30">{{ __('common.product') }} {{ __('common.update') }}</h3>
                        </div>
                    </div>
                </div>
                <?php //print_r($product->product); die(); ?>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <form action="{{route('seller.product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="p_id" value="{{ $product->product->id}}">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for=""> {{__("product.i_want_to_manage_stock_for_this_product")}}</label>
                                        <label class="switch_toggle" for="checkbox1">
                                            <input type="checkbox" id="checkbox1" @if ($product->stock_manage == 1) checked @endif value="{{ $product->id }}">
                                            <div class="slider round"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if($product->product->product_type ==1)
                                <div class="row">
                                    @if ($product->stock_manage == 1)
                                        <div class="col-xl-6">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="product_stock">{{__('product.product_stock')}} <span class="text-danger">*</span></label>
                                                <input class="primary_input_field" name="product_stock" id="product_stock" placeholder="{{__("product.product_stock")}}" type="number" min="0" step="0" value="{{$product->skus->first()->product_stock??0}}" required>
                                                @error('product_stock')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                    <input type="hidden" id="stock_manage" name="stock_manage" value="{{ $product->stock_manage }}">
                                    <div class="col-lg-6">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for=""> {{__("product.selling_price")}} <span class="text-danger">*</span></label>
                                            <input class="primary_input_field" name="selling_price" id="selling_price" placeholder="{{__("product.selling_price")}}" type="number" min="1" step="{{step_decimal()}}" value="{{$product->skus->first()->selling_price?$product->skus->first()->selling_price:''}}" required>
                                            <span class="text-danger">{{$errors->first('selling_price')}}</span>
                                        </div>
                                    </div>
                                    @if(isModuleActive('WholeSale'))
                                    <div class="col-lg-6 whole_sale_info_add" id="whole_sale_info_add">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="">{{ __('wholesale.Wholesale Price') }}</label>
                                            <!-- table-responsive -->
                                            <div class="table-responsive">
                                                <table class="create_table">
                                                    <tbody id="single_product_w_p">
                                                    @if( count($totalWholesalePrice)>0 )
                                                        @foreach($totalWholesalePrice as $w_key=>$wholesale_price)
                                                            <tr class="whole_sale_price_list">
                                                                <td class="p-2 border-0">
                                                                    <input type="text" class="form-control primary_input_field" value="{{ $wholesale_price->min_qty }}" name="wholesale_min_qty_0[]">
                                                                </td>
                                                                <td class="p-2 border-0">
                                                                    <input type="text" class="form-control primary_input_field" value="{{ $wholesale_price->max_qty }}" name="wholesale_max_qty_0[]">
                                                                </td>
                                                                <td class="p-2 border-0">
                                                                    <input type="text" class="form-control primary_input_field" value="{{ $wholesale_price->selling_price }}" name="wholesale_price_0[]">
                                                                </td>
                                                                <td class="p-2 pr-0 remove_whole_sale border-0">
                                                                    <button type="button" class="btn close style_close_icon"> <span aria-hidden="true">&times;</span> </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr class="whole_sale_price_list whole_sale_price_list_child">
                                                            <td class="pl-0 pb-0 border-0">
                                                                <input type="text" class="form-control primary_input_field" placeholder="Min QTY" name="wholesale_min_qty_0[]">
                                                            </td>
                                                            <td class="pl-0 pb-0 border-0">
                                                                <input type="text" class="form-control primary_input_field" placeholder="Max QTY" name="wholesale_max_qty_0[]">
                                                            </td>
                                                            <td class="pl-0 pb-0 border-0">
                                                                <input type="text" class="form-control primary_input_field" placeholder="Price per piece" name="wholesale_price_0[]">
                                                            </td>
                                                            <td class="p-2 pr-0 remove_whole_sale border-0">
                                                                <button type="button" class="btn close style_close_icon"> <span aria-hidden="true">&times;</span> </button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="add_items_button mb-20">
                                            <button type="button" class="btn btn-light btn-sm border add_single_whole_sale_price"> {{__('common.add_more')}} </button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @endif
                            <div class="row">
                                @if(isModuleActive('FrontendMultiLang'))
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                            @foreach ($LanguageList as $key => $language)
                                                <li class="nav-item">
                                                    <a class="nav-link anchore_color @if (auth()->user()->lang_code == $language->code) active @endif" href="#pnelement{{$language->code}}" role="tab" data-toggle="tab" aria-selected="@if (auth()->user()->lang_code == $language->code) true @else false @endif">{{ $language->native }} </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach ($LanguageList as $key => $language)
                                                <div role="tabpanel" class="tab-pane fade @if (auth()->user()->lang_code == $language->code) show active @endif" id="pnelement{{$language->code}}">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for="product_name"> {{__("product.display_name")}}</label>
                                                                <input class="primary_input_field" id="product_name" name="product_name[{{$language->code}}]" placeholder="{{__("product.display_name")}}" type="text" value="{{isset($product)?$product->getTranslation('product_name',$language->code):old('product_name.'.$language->code)}}">
                                                                <span class="text-danger">{{$errors->first('product_name')}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 @if(!app('general_setting')->product_subtitle_show) d-none @endif">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for="subtitle_1"> {{ __('product.subtitle_1') }}</label>
                                                                <input class="primary_input_field" name="subtitle_1[{{$language->code}}]" id="subtitle_1" placeholder="{{ __('product.subtitle_1') }}" type="text" value="{{isset($product)?$product->getTranslation('subtitle_1',$language->code):old('subtitle_1.'.$language->code)}}">
                                                                <span id="error_subtitle_1"class="text-danger">{{ $errors->first('subtitle_1') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 @if(!app('general_setting')->product_subtitle_show) d-none @endif">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for="subtitle_2"> {{ __('product.subtitle_2') }}</label>
                                                                <input class="primary_input_field" name="subtitle_2[{{$language->code}}]" id="subtitle_2" placeholder="{{ __('product.subtitle_2') }}" type="text" value="{{isset($product)?$product->getTranslation('subtitle_2',$language->code):old('subtitle_2.'.$language->code)}}">
                                                                <span id="error_subtitle_2" class="text-danger">{{ $errors->first('subtitle_2') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="product_name"> {{__("product.display_name")}}</label>
                                            <input class="primary_input_field" id="product_name" name="product_name" placeholder="{{__("product.display_name")}}" type="text" value="{{old('product_name')?old('product_name'):$product->product_name}}">
                                            <span class="text-danger">{{$errors->first('product_name')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 @if(!app('general_setting')->product_subtitle_show) d-none @endif">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="subtitle_1"> {{ __('product.subtitle_1') }}</label>
                                            <input class="primary_input_field" name="subtitle_1" id="subtitle_1" placeholder="{{ __('product.subtitle_1') }}" type="text" value="{{old('subtitle_1')?old('subtitle_1'):$product->subtitle_1}}">
                                            <span id="error_subtitle_1"class="text-danger">{{ $errors->first('subtitle_1') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 @if(!app('general_setting')->product_subtitle_show) d-none @endif">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="subtitle_2"> {{ __('product.subtitle_2') }}</label>
                                            <input class="primary_input_field" name="subtitle_2" id="subtitle_2" placeholder="{{ __('product.subtitle_2') }}" type="text" value="{{old('subtitle_2')?old('subtitle_2'):$product->subtitle_2}}">
                                            <span id="error_subtitle_2" class="text-danger">{{ $errors->first('subtitle_2') }}</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-6">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="thumbnail_image_file_seller">{{ __('product.thumbnail_image') }} ({{getNumberTranslate(165)}} x {{getNumberTranslate(165)}}) {{__('common.px')}}</label>
                                        <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="thumbnail_image">
                                            <input class="primary-input file_amount" type="text" id="thumbnail_image_file_seller" placeholder="{{ __('product.thumbnail_image') }}" readonly>
                                            <button class="" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="thumbnail_image_seller">{{ __('product.Browse') }} </label>
                                                <input type="hidden" class="selected_files" value="{{@$product->thumb_image_media->media_id}}">
                                            </button>
                                        </div>
                                        <div class="product_image_all_div artwork-protect-zone">
                                            @if(@$product->thumb_image_media == null && $product->thum_img != null)
                                                <div class="thumb_img_div">
                                                    <img id="ThumbnailImg" src="{{showImage($product->thum_img != null?$product->thum_img:'backend/img/default.png')}}" alt="">
                                                </div>
                                            @else
                                                <input type="hidden" class="product_images_hidden" name="thumbnail_image" value="{{@$product->thumb_image_media->media_id}}">
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                @include('seller::products.partials.product_address_fields', ['productForAddress' => $product->product])

                                    <div class="col-lg-3">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">Art Services</label>

                                            <select class="primary_select mb-25" name="art_services" id="art_services">
                                                <option value="">Select Art Services</option>
                                                @php
                                                    $productArtService = (string) ($product->product->art_services ?? '');
                                                    $isArtService = fn (string $key, array $aliases) => in_array($productArtService, $aliases, true);
                                                @endphp
                                                <option value="commissions" {{ $isArtService('commissions', ['commissions', 'Commissions']) ? 'selected' : '' }}>Commissions</option>
                                                <option value="murals" {{ $isArtService('murals', ['murals', 'Murals']) ? 'selected' : '' }}>Murals</option>
                                                <option value="live_art" {{ $isArtService('live_art', ['live_art', 'Live Art']) ? 'selected' : '' }}>Live Art</option>
                                                <option value="art_shows" {{ $isArtService('art_shows', ['art_shows', 'Art Shows']) ? 'selected' : '' }}>Art Shows</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">Category</label>

                                            <select class="primary_select mb-25" name="category" id="category">
                                                <option value="">Select Category</option>
                                                <option value="All" {{ $product->product->category == 'All' ? 'selected' : '' }}>All</option>
                                                <option value="Paintings" {{ $product->product->category == 'Paintings' ? 'selected' : '' }}>Paintings</option>
                                                <option value="Drawing" {{ $product->product->category == 'Drawing' ? 'selected' : '' }}>Drawing</option>
                                                <option value="Mixed Media" {{ $product->product->category == 'Mixed Media' ? 'selected' : '' }}>Mixed Media</option>
                                                <option value="Sculpture" {{ $product->product->category == 'Sculpture' ? 'selected' : '' }}>Sculpture</option>
                                                <option value="Other" {{ $product->product->category == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-3">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">Style</label>

                                            <select class="primary_select mb-25" name="style" id="style">
                                                <option value="">Select Style</option>
                                                
                                                <option value="Abstract Art" {{ $product->product->style == 'Abstract Art' ? 'selected' : '' }}>Abstract Art</option>
                                                <option value="Art Deco" {{ $product->product->style == 'Art Deco' ? 'selected' : '' }}>Art Deco</option>
                                                <option value="Art Nouveau" {{ $product->product->style == 'Art Nouveau' ? 'selected' : '' }}>Art Nouveau</option>
                                                <option value="Baroque" {{ $product->product->style == 'Baroque' ? 'selected' : '' }}>Baroque</option>
                                                <option value="Bauhaus" {{ $product->product->style == 'Bauhaus' ? 'selected' : '' }}>Bauhaus</option>
                                                <option value="Classicism" {{ $product->product->style == 'Classicism' ? 'selected' : '' }}>Classicism</option>
                                                <option value="Contemporary Art" {{ $product->product->style == 'Contemporary Art' ? 'selected' : '' }}>Contemporary Art</option>
                                                <option value="Cubism" {{ $product->product->style == 'Cubism' ? 'selected' : '' }}>Cubism</option>
                                                <option value="Dadaism" {{ $product->product->style == 'Dadaism' ? 'selected' : '' }}>Dadaism</option>
                                                <option value="Expressionism" {{ $product->product->style == 'Expressionism' ? 'selected' : '' }}>Expressionism</option>
                                                <option value="Fauvism" {{ $product->product->style == 'Fauvism' ? 'selected' : '' }}>Fauvism</option>
                                                <option value="Figurative" {{ $product->product->style == 'Figurative' ? 'selected' : '' }}>Figurative</option>
                                                <option value="Harlem Renaissance" {{ $product->product->style == 'Harlem Renaissance' ? 'selected' : '' }}>Harlem Renaissance</option>
                                                <option value="Impressionism" {{ $product->product->style == 'Impressionism' ? 'selected' : '' }}>Impressionism</option>
                                                <option value="Minimalism" {{ $product->product->style == 'Minimalism' ? 'selected' : '' }}>Minimalism</option>
                                                <option value="Neoclassicism" {{ $product->product->style == 'Neoclassicism' ? 'selected' : '' }}>Neoclassicism</option>
                                                <option value="Neo-Impressionism" {{ $product->product->style == 'Neo-Impressionism' ? 'selected' : '' }}>Neo-Impressionism</option>
                                                <option value="Pop Art" {{ $product->product->style == 'Pop Art' ? 'selected' : '' }}>Pop Art</option>
                                                <option value="Post-Impressionism" {{ $product->product->style == 'Post-Impressionism' ? 'selected' : '' }}>Post-Impressionism</option>
                                                <option value="Realism" {{ $product->product->style == 'Realism' ? 'selected' : '' }}>Realism</option>
                                                <option value="Surrealism" {{ $product->product->style == 'Surrealism' ? 'selected' : '' }}>Surrealism</option>
                                                <option value="Other" {{ $product->product->style == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">Subject</label>

                                            <select class="primary_select mb-25" name="subject" id="subject">
                                                <option value="">Select Subject</option>

                                                <option value="Abstract" {{ $product->product->subject == 'Abstract' ? 'selected' : '' }}>Abstract</option>
                                                <option value="Landscape" {{ $product->product->subject == 'Landscape' ? 'selected' : '' }}>Landscape</option>
                                                <option value="Pop Culture" {{ $product->product->subject == 'Pop Culture' ? 'selected' : '' }}>Pop Culture</option>
                                                <option value="People" {{ $product->product->subject == 'People' ? 'selected' : '' }}>People</option>
                                                <option value="Animal" {{ $product->product->subject == 'Animal' ? 'selected' : '' }}>Animal</option>
                                                <option value="Floral" {{ $product->product->subject == 'Floral' ? 'selected' : '' }}>Floral</option>
                                                <option value="Nature" {{ $product->product->subject == 'Nature' ? 'selected' : '' }}>Nature</option>
                                                <option value="Seascape" {{ $product->product->subject == 'Seascape' ? 'selected' : '' }}>Seascape</option>
                                                <option value="Dogs" {{ $product->product->subject == 'Dogs' ? 'selected' : '' }}>Dogs</option>
                                                <option value="Cats" {{ $product->product->subject == 'Cats' ? 'selected' : '' }}>Cats</option>
                                                <option value="Religious" {{ $product->product->subject == 'Religious' ? 'selected' : '' }}>Religious</option>
                                                <option value="Love" {{ $product->product->subject == 'Love' ? 'selected' : '' }}>Love</option>
                                                <option value="Nude" {{ $product->product->subject == 'Nude' ? 'selected' : '' }}>Nude</option>
                                                <option value="Geometric" {{ $product->product->subject == 'Geometric' ? 'selected' : '' }}>Geometric</option>
                                                <option value="Music" {{ $product->product->subject == 'Music' ? 'selected' : '' }}>Music</option>
                                                <option value="Food/Drinks" {{ $product->product->subject == 'Food/Drinks' ? 'selected' : '' }}>Food/Drinks</option>
                                                <option value="Medical" {{ $product->product->subject == 'Medical' ? 'selected' : '' }}>Medical</option>
                                                <option value="Sports" {{ $product->product->subject == 'Sports' ? 'selected' : '' }}>Sports</option>
                                                <option value="Men" {{ $product->product->subject == 'Men' ? 'selected' : '' }}>Men</option>
                                                <option value="Women" {{ $product->product->subject == 'Women' ? 'selected' : '' }}>Women</option>
                                                <option value="Buildings" {{ $product->product->subject == 'Buildings' ? 'selected' : '' }}>Buildings</option>
                                                <option value="Cartoon" {{ $product->product->subject == 'Cartoon' ? 'selected' : '' }}>Cartoon</option>
                                                <option value="Other" {{ $product->product->subject == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">Medium</label>

                                            <select class="primary_select mb-25" name="medium" id="medium">
                                                <option value="">Select Medium</option>

                                                <option value="Acrylic" {{ $product->product->medium == 'Acrylic' ? 'selected' : '' }}>Acrylic</option>
                                                <option value="Oil" {{ $product->product->medium == 'Oil' ? 'selected' : '' }}>Oil</option>
                                                <option value="Watercolor" {{ $product->product->medium == 'Watercolor' ? 'selected' : '' }}>Watercolor</option>
                                                <option value="Ink" {{ $product->product->medium == 'Ink' ? 'selected' : '' }}>Ink</option>
                                                <option value="Ceramic" {{ $product->product->medium == 'Ceramic' ? 'selected' : '' }}>Ceramic</option>
                                                <option value="Other" {{ $product->product->medium == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">Material</label>

                                            <select class="primary_select mb-25" name="material" id="material">
                                                <option value="">Select Material</option>

                                                <option value="Canvas" {{ $product->product->material == 'Canvas' ? 'selected' : '' }}>Canvas</option>
                                                <option value="Paper" {{ $product->product->material == 'Paper' ? 'selected' : '' }}>Paper</option>
                                                <option value="Wood" {{ $product->product->material == 'Wood' ? 'selected' : '' }}>Wood</option>
                                                <option value="Metal" {{ $product->product->material == 'Metal' ? 'selected' : '' }}>Metal</option>
                                                <option value="Other" {{ $product->product->material == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">Price</label>

                                            <input 
                                                type="range" 
                                                class="primary_range"
                                                id="price"
                                                name="price"
                                                min="0"
                                                max="10000"
                                                step="50"
                                                value="5000"
                                            >

                                            <div class="mt-10">
                                                Up to: <strong>$<span id="price_value">5000</span></strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">Color Palette</label>

                                            <!-- Single color selection -->
                                            <input 
                                                type="color" 
                                                class="form-control"
                                                name="palette_color"
                                                id="palette_color"
                                                value={{$product->product->palette_color}}
                                            >

                                            <small class="text-muted">
                                                Select one color from the palette
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">Size</label>

                                            <select class="primary_select mb-25" name="size" id="size">
                                                <option value="">Select Size</option>

                                                <option value="Small" {{ $product->product->size == 'Small' ? 'selected' : '' }}>Small (&lt; 20in)</option>
                                                <option value="Medium" {{ $product->product->size == 'Medium' ? 'selected' : '' }}>Med (20–38in)</option>
                                                <option value="Large" {{ $product->product->size == 'Large' ? 'selected' : '' }}>Large (38–60in)</option>
                                                <option value="X Large" {{ $product->product->size == 'X Large' ? 'selected' : '' }}>X Large (&gt; 60in)</option>
                                            </select>
                                        </div>
                                    </div>

                                <div class="col-lg-3" style="display:none">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for=""> {{__("product.discount")}}</label>
                                        <input class="primary_input_field" name="discount" id="discount"
                                               placeholder="{{__("product.discount")}}" type="number" min="0"
                                               step="{{step_decimal()}}"
                                               value="{{$product->discount?$product->discount:0}}">
                                        <span class="text-danger">{{$errors->first('discount')}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="display:none">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="">{{ __('product.discount_type') }}</label>
                                        <select class="primary_select mb-25" name="discount_type" id="discount_type">
                                            <option {{$product->discount_type == 1?'selected':''}} value="1">{{ __('product.amount') }}</option>
                                            <option {{$product->discount_type == 0?'selected':''}} value="0">{{ __('product.percentage') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="display:none">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label"
                                               for="startDate">{{__('product.discount_start_date')}}</label>
                                        <div class="primary_datepicker_input">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">
                                                        <input placeholder="{{ __('common.date') }}" class="primary_input_field primary-input date form-control" id="startDate" type="text" name="discount_start_date" value="{{$product->discount_start_date??''}}" autocomplete="off">
                                                    </div>
                                                </div>
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="display:none">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label"
                                               for="endDate">{{__('product.discount_end_date')}}</label>
                                        <div class="primary_datepicker_input">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">
                                                        <input placeholder="{{ __('common.date') }}" class="primary_input_field primary-input date form-control" id="endDate" type="text" name="discount_end_date" value="{{$product->discount_end_date??''}}" autocomplete="off">
                                                    </div>
                                                </div>
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="end-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            @if($product->product->product_type ==2)
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="product_sku">{{ __('common.select') }} {{ __('common.new') }}</label>
                                            <select class="primary_select mb-25" name="product_sku" id="product_sku">
                                                <option value="" disabled selected>{{__('seller.select_from_list')}}</option>
                                                @foreach($skus as $sku)
                                                    <option value="{{$sku->id}}">{{$sku->sku}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" id="stock_manage" name="stock_manage" value="{{ $product->stock_manage }}">
                                    <div class="col-lg-6">
                                        <ul class="mt-25" id="sku_list_div">
                                            @foreach($product->skus as $sku)
                                                <li class="badge_1 mb-10" id="badge_id_{{$sku->id}}">{{$sku->sku->sku}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="row mt-20">
                                    <div id="variant_table_div" class="col-xl-12 overflow-auto">
                                        <table class="table table-bordered sku_table">
                                            <thead>
                                            <tr>
                                                <th class="text-center text-nowrap">{{ __('product.variant') }}</th>

                                                <th class="text-center">{{ __('product.selling_price') }}</th>
                                                @if ($product->stock_manage == 1)
                                                    <th class="text-center">{{ __('product.product_stock') }}</th>
                                                @endif
                                                <th class="text-center">{{ __('common.status') }}</th>
                                                <th class="text-center">{{ __('common.delete') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="sku_tbody">
                                            @foreach($product->skus as $key => $item)
                                                <input type="hidden" class="getIncKey" value="{{$key}}">
                                                <tr>
                                                    <input type="hidden" name="product_skus[]" value="{{$item->sku->id}}">
                                                    <td class="text-center product_sku_name">{{$item->sku->sku}}</td>

                                                    <td class="text-center sku_price_td">
                                                        <input class="primary_input_field" type="number" name="selling_price_sku[]" value="{{$item->selling_price}}" min="0" step="{{step_decimal()}}" class="form-control" required>
                                                        @if (isModuleActive('WholeSale'))
                                                            <button type="button" data-toggle="modal" tabindex="-1" data-target="#variant_wholesale_price_modal_{{ $item->sku->sku.$key }}" class="btn btn-sm style_plus_icon mt-1 add_variant_whole_sale_price"> <i class="ti-plus"></i> </button>
                                                            <!-- Append WholeSale Price  -->
                                                            @php
                                                                $wholesalePriceInfo = @$item->wholeSalePrices;
                                                            @endphp
                                                            <ul id="append_w_p{{$item->sku->sku.$key}}">
                                                                @foreach($wholesalePriceInfo as $w_s_p)
                                                                    <li>{{__('wholesale.Range')}}:{{($w_s_p->min_qty.'-'.$w_s_p->max_qty).'  $'.$w_s_p->selling_price}}</li>
                                                                @endforeach
                                                            </ul>
                                                            @include('wholesale::components.seller._edit_variant_wholesale_price_modal', ['modalTargetId'=> $item->sku->sku.$key, 'incKey'=>$key, 'sellerProductSkuInfo'=>$item])
                                                        @endif
                                                    </td>

                                                    @if ($product->stock_manage == 1)
                                                        <td class="text-center sku_price_td">
                                                            <input class="primary_input_field" type="number" name="stock[]" value="{{$item->product_stock}}" min="0" step="0" class="form-control" required>
                                                        </td>
                                                    @endif
                                                    <td class="text-center product_sku_name">
                                                        <label class="switch_toggle" for="checkbox_{{$item->id}}">
                                                            <input type="checkbox" name="status_{{$item->sku->id}}" id="checkbox_{{$item->id}}" {{$item->status?'checked':''}}  value="{{$item->id}}">
                                                            <div class="slider round"></div>
                                                        </label>
                                                    </td>
                                                    <td class="text-center sku_delete_td" data-id="{{$item->id}}" data-unique_id="#badge_id_{{$item->id}}"><p><i class="fa fa-trash"></i></p></td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-12 text-center mt-20">
                                    <div class="d-flex justify-content-center">
                                        <button class="primary-btn semi_large2  fix-gr-bg mr-1" id="save_button_parent"
                                                type="submit"><i class="ti-check"></i>{{__('common.update')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@if($sellerMapsEnabled)
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.map_api_key') }}&callback=initSellerProductAddressAutocomplete&libraries=places&v=weekly" defer></script>
@endif

@push('scripts')
    <script>

        (function ($) {
            "use strict";

            $(document).ready(function () {

                $(document).on('change', '#product_sku', function () {
                    let a_id = $(this).val();
                    var stock_manage = $('#stock_manage').val();
                    let sku = $('#product_sku option:selected').html();
                    let getIncKey = $('.getIncKey:last').val();
                    $('#sku_list_div').append(`<li class="badge_1 mb-10" id="badge_id_${a_id}">${sku}</li>`)
                    $.post('{{ route('seller.product.variant-edit') }}', {
                        _token: '{{ csrf_token() }}',
                        id: a_id,
                        stock_manage: stock_manage,
                        getIncKey: getIncKey
                    }, function (data) {

                        $('#sku_tbody').append(data.variants)

                    });

                });

                $(document).on('change', '#thumbnail_image_seller', function (event) {
                    getFileName($(this).val(), '#thumbnail_image_file_seller');
                    imageChangeWithFile($(this)[0], '#sellerThumbnailImg');
                });

                $(document).on('change', '#checkbox1', function (event) {
                    update_stock_manage_status($(this)[0]);
                });

                $(document).on('click', '.sku_delete_td', function (event) {
                    let id = $(this).data('id');
                    let unique_id = $(this).data('unique_id');

                    deleteRow($(this)[0], id, unique_id);
                });

                $(document).on('click', '.sku_delete_new', function (event) {
                    let unique_id = $(this).data('unique_id');

                    deleteRowNew($(this)[0], unique_id);
                });


                function deleteRow(btn, rowId, id) {

                    var formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('id', rowId);

                    $.ajax({
                        url: "{{ route('seller.product.variant.delete') }}",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (response) {
                            toastr.success("{{__('common.deleted_successfully')}}", "{{__('common.success')}}");
                        },
                        error: function (response) {
                            toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                        }
                    });
                    var row = btn.parentNode;
                    row.parentNode.removeChild(row);

                    $(id).css('display', 'none');
                }

                function deleteRowNew(btn, id) {
                    var row = btn.parentNode;
                    row.parentNode.removeChild(row);
                    $(id).css('display', 'none');

                }

                function update_stock_manage_status(el) {
                    if (el.checked) {
                        var status = 1;
                    } else {
                        var status = 0;
                    }
                    $.post('{{ route('seller.product.update_stock_manage_status') }}', {
                        _token: '{{ csrf_token() }}',
                        id: el.value,
                        status: status
                    }, function (data) {
                        if (data == 1) {
                            toastr.success("{{__('common.updated_successfully')}}", "{{__('common.success')}}");
                            location.reload();
                        } else {
                            toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                        }
                    });
                }


                //Add more Whole-Sale price for Single Product
                $(document).on('click', '.add_single_whole_sale_price', function () {
                    $('#single_product_w_p').append(`<tr class="whole_sale_price_list whole_sale_price_list_child">
                                <td class="p-2 border-0">
                                    <input type="text" class="form-control primary_input_field" placeholder="Min QTY" name="wholesale_min_qty_0[]">
                                </td>
                                <td class="p-2 border-0">
                                    <input type="text" class="form-control primary_input_field" placeholder="Max QTY" name="wholesale_max_qty_0[]">
                                </td>
                                <td class="p-2 border-0">
                                    <input type="text" class="form-control primary_input_field" placeholder="Price per piece" name="wholesale_price_0[]">
                                </td>
                                <td class="p-2 pr-0 remove_whole_sale border-0">
                                    <button type="button" class="btn close style_close_icon">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </td>
                        </tr>`);
                });

                $(document).on('click', '.remove_whole_sale', function () {
                    $(this).parents('.whole_sale_price_list').remove();
                });


                //Add more Whole-Sale price for Variant Product
                $(document).on('click', '.add_variant__whole_sale_price', function () {
                    var targetModalId = $(this).data('id');
                    var incKey = $(this).attr('incKey');

                    $(targetModalId).append(`<div class="col-lg-12 variant_whole_sale_price_list">
                            <div class="row mt-2">
                                <div class="col">
                                    <input type="text" class="form-control primary_input_field" placeholder="Min QTY" name="wholesale_min_qty_v_${incKey}[]">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control primary_input_field" placeholder="Max QTY" name="wholesale_max_qty_v_${incKey}[]">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control primary_input_field" placeholder="Price per piece" name="wholesale_price_v_${incKey}[]">
                                </div>
                                <div class="col">
                                    <button type="button" class="float-left mt-2 style_plus_icon remove_variant_whole_sale border-0">
                                        <i class="ti-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`);
                });

                $(document).on('click', '.remove_variant_whole_sale', function () {
                    $(this).parents('.variant_whole_sale_price_list').remove();
                });

                //Append wholesale price in sku table
                $(document).on('click', '.wholesale_p_save_btn', function (){
                    var append_w_priceId = $(this).attr('append_w_priceId');
                    var w_incKey = $(this).attr('w_incKey');
                    $('#append_w_p'+append_w_priceId).empty();

                    var wholesale_min_qty_v = $('input[name="wholesale_min_qty_v_'+w_incKey+'[]"]').map(function(){return $(this).val();}).get();
                    var wholesale_max_qty_v = $('input[name="wholesale_max_qty_v_'+w_incKey+'[]"]').map(function(){return $(this).val();}).get();
                    var wholesale_price_v = $('input[name="wholesale_price_v_'+w_incKey+'[]"]').map(function(){return $(this).val();}).get();

                    var w_s_p_list=[];
                    for (var w=0; w<wholesale_min_qty_v.length; w++){
                        w_s_p_list[w] = "<li>{{__('wholesale.Range')}}:("+wholesale_min_qty_v[w]+"-"+wholesale_max_qty_v[w]+")     $"+wholesale_price_v[w]+"</li>";
                    }

                    $('#append_w_p'+append_w_priceId).append(w_s_p_list);
                    $('#variant_wholesale_price_modal_'+append_w_priceId).modal('toggle');
                });


            });
            const priceSlider = document.getElementById('price');
        const priceValue = document.getElementById('price_value');

        priceSlider.addEventListener('input', () => {
            priceValue.textContent = priceSlider.value;
        });
        })(jQuery);


    </script>
@include('seller::products.partials.product_address_scripts', ['sellerMapsEnabled' => $sellerMapsEnabled])
@endpush
