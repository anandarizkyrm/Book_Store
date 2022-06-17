@extends('client.layout.master')
@section('title','E-SHOP || HOME PAGE')
@section('main-content')


<!-- Start Product Area -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>By Genre</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Tab Nav -->
                        <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                            @php
                                $categories=DB::table('category')->get();
                                // dd($categories);
                            @endphp
                            @if($categories)
                            <button class="btn" style="background:black"data-filter="*">
                                All Genre
                            </button>
                                @foreach($categories as $key=>$cat)
                                <button class="btn" style="background:none;color:black;" data-filter=".{{$cat->id}}">
                                    {{$cat->name}}
                                </button>
                                @endforeach
                            @endif
                        </ul>
                        <!--/ End Tab Nav -->
                    </div>
                    <div  class="tab-content d-flex flex-wrap isotope-grid" id="myTabContent">
                         <!-- Start Single Tab -->
                        @if($product_lists)
                            @foreach($product_lists as $key=>$product)
                            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->category_id}}">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{route('product-detail',$product->slug)}}">
                                            @php
                                                $photo=explode(',',$product->image);
                                            // dd($photo);
                                            @endphp
                                            <img class="default-img"  src="{{asset('/storage/images/'.$photo[0])}}" alt="{{$photo[0]}}">
                                            <img class="hover-img"  src="{{asset('/storage/images/'.$photo[0])}}" alt="{{$photo[0]}}">
                                            @if($product->stock<=0)
                                                <span class="out-of-stock">Sale out</span>
                                            @elseif($product->condition=='new')
                                                <span class="new">New</span
                                            @elseif($product->condition=='hot')
                                                <span class="hot">Hot</span>
                                            @else
                                                <span class="price-dec">{{$product->discount}}% Off</span>
                                            @endif


                                        </a>
                                        <div class="button-head">
                                          
                                            <div class="product-action-2">
                                                <a title="Add to cart" href="{{route('add-to-cart',$product->slug)}}">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->name}}</a></h3>
                                        <div class="product-price">
                                            @php
                                                $after_discount=($product->price-($product->price*$product->discount)/100);
                                            @endphp
                                            <span>Rp. {{number_format($after_discount,2)}}</span>
                                            <del style="padding-left:4%;">Rp. {{number_format($product->price,2)}}</del>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                         <!--/ End Single Tab -->
                        @endif

                    <!--/ End Single Tab -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Product Area -->

<!-- Start Shop Home List  -->
<section style="margin-top : 40px;" class="shop-home-list section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>Latest Items</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php
                        $product_lists=DB::table('books')->where('status','active')->orderBy('id','DESC')->limit(6)->get();
                    @endphp
                    @foreach($product_lists as $product)
                        <div class="col-md-4">
                            <!-- Start Single List  -->
                            <div class="single-list">
                                <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="list-image overlay">
                                        @php
                                            $photo=explode(',',$product->image);
                                        @endphp
                                        <img src="{{asset('/storage/images/'.$photo[0])}}" alt="{{$photo[0]}}">
                                        <a href="{{route('add-to-cart',$product->slug)}}" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 no-padding">
                                    <div class="content">
                                        <h4 class="title"><a href="#">{{$product->name}}</a></h4>
                                        <p class="price with-discount">Rp. {{number_format($product->discount,2)}}</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- End Single List  -->
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Home List  -->
@push('styles')
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    <style>
        /* Banner Sliding */
        #Gslider .carousel-inner {
        background: #000000;
        color:black;
        }

        #Gslider .carousel-inner{
        height: 550px;
        }
        #Gslider .carousel-inner img{
            width: 100% !important;
            opacity: .8;
        }

        #Gslider .carousel-inner .carousel-caption {
        bottom: 60%;
        }

        #Gslider .carousel-inner .carousel-caption h1 {
        font-size: 50px;
        font-weight: bold;
        line-height: 100%;
        color: #28a745;
        }

        #Gslider .carousel-inner .carousel-caption p {
        font-size: 18px;
        color: black;
        margin: 28px 0 28px 0;
        }

        #Gslider .carousel-indicators {
        bottom: 70px;
        }
    </style>
@endpush

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script>

        /*==================================================================
        [ Isotope ]*/
        var $topeContainer = $('.isotope-grid');
        var $filter = $('.filter-tope-group');
        console.log($filter, $topeContainer);
        // filter items on button click
        $filter.each(function () {
          
            $filter.on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $topeContainer.isotope({filter: filterValue});
            });

        });

        // init Isotope
        $(window).on('load', function () {
            var $grid = $topeContainer.each(function () {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine : 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });
            });
        });

        var isotopeButton = $('.filter-tope-group button');

        $(isotopeButton).each(function(){
            $(this).on('click', function(){
                for(var i=0; i<isotopeButton.length; i++) {
                    $(isotopeButton[i]).removeClass('how-active1');
                }

                $(this).addClass('how-active1');
            });
        });
    </script>
    <script>
         function cancelFullScreen(el) {
            var requestMethod = el.cancelFullScreen||el.webkitCancelFullScreen||el.mozCancelFullScreen||el.exitFullscreen;
            if (requestMethod) { // cancel full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        function requestFullScreen(el) {
            // Supports most browsers and their versions.
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

            if (requestMethod) { // Native full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
            return false
        }
    </script>

@endpush

@endsection

