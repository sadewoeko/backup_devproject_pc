@extends('dashboard')
@section('content')
<style>
.category-menu{
  border: 1px solid #c0b5b6;
}
.category-menu li{
  border-top: 1px solid #c0b5b6;
}
.category-menu .menu-item-has-children > ul{
  border: 1px solid #c0b5b6;
}
.shop-category{
  height: 537px;
  background: #ffffff;
  border: 1px solid #c0b5b6;
}
</style>
<!-- <section class="shop-contents">
    <div class="section">
      <section class="clients-logo clients-logo-03 text-center">
        <div class="container">
          <div class="row">
            <h2>PREMIUM PRODUCT</h2>
            <hr>
            <br>
            <div id="related-slider" class="related-slider">
            

            <div class="col-sm-4">
              <div class="item">
                <div class="item-top">
                  <div class="item-thumbnail">
                    <a class="fancybox" href="{{ asset('uploads/product/product_default.jpg') }}">
                    <img src="{{ asset('uploads/product/product_default.jpg') }}" class="product" alt="Item Image">
                    </a>
                    
                  </div>
                </div>
                <div class="item-bottom">
                  
                  
                  <h3 class="item-title"><a href="#">Product name here</a></h3>
                  <div class="item-price">
                    <span class="item-title" style="font-size:10px">Company name here</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="item">
                <div class="item-top">
                  <div class="item-thumbnail">
                    <a class="fancybox" href="{{ asset('uploads/product/product_default.jpg') }}">
                    <img src="{{ asset('uploads/product/product_default.jpg') }}" class="product" alt="Item Image">
                    </a>
                    
                  </div>
                </div>
                <div class="item-bottom">
                  
                  
                  <h3 class="item-title"><a href="#">Product name here</a></h3>
                  <div class="item-price">
                    <span class="item-title" style="font-size:10px">Company name here</span>
                  </div>
                </div>
              </div>
            </div> 
            @foreach($products as $data)
                <div class="col-sm-4">
                  <div class="item-thumbnail">
                    <a class="fancybox" href="{{ asset('uploads/product/' . $data->image) }}">
                        <img src="{{ asset('uploads/product/' . $data->image) }}" class="product" alt="Item Thumbnail" style="width:200px;height:200px;margin:0 31 0 0"> 
                    </a>
                  </div>
                  <br>
                  <div class="item-details">
                    <h3 class="item-title">
                      {{ $data->product_name }}
                      <h5>
                        {{ $data->company_name }}
                      </h5>
                    </h3>
                  </div>
                </div>
            @endforeach

            </div>
          </div>
        </div>
      </div>
  </section> -->
  <section id="ads" class="banner banner-11 text-left background-bg" data-image-src="{{ asset('assets/images/home11/banner.jpg') }}">
    <div class="container">
      <div class="row">
        <div class="banner-top">

          <div class="col-sm-3">
            <h3 class="banner-title">inquiry of This Month</h3>
            <div class="shop-category">
              <ul class="category-menu">
                @foreach($inquiry as $inval)
                <li class="menu-item">{{ link_to_route('productDetailBuy.detail', substr($inval->product_name,0,20), array($inval->id), array('class' => 'green')) }}
                  <img style="float:right;margin-top:-50px;width:40px;height:40px;margin-right:16px" src="http://www.countryflags.io/{{ $inval->sortname }}/shiny/64.png"></li>
                @endforeach
              </ul>
            </div><!-- /.shop-category -->
          </div>

          <div class="col-sm-6">
            <div id="banner-slider" class="banner-slider carousel slide background-bg" data-image-src="{{ asset('assets/images/bg_slider2.jpg') }}">

              <ol class="carousel-indicators">
                <li data-target="#banner-slider" data-slide-to="0" class="active"></li>
                <li data-target="#banner-slider" data-slide-to="1"></li>
                <li data-target="#banner-slider" data-slide-to="2"></li>
              </ol>

              <div class="carousel-inner">
                <div class="item active">
                  <div class="col-sm-6">
                    <div class="slider-content">
                      <h4 class="top-title" style="color:black">Advertisement</h4>
                      <h2 class="main-title" style="color:black">Place your product here</h2><!-- /.banner-title -->
                      <h3 class="sub-title" style="color:white">size: 225x450</h3><!-- /.banner-sub-title --> 
                    </div><!-- /.slider-content -->
                  </div>

                  <div class="col-sm-6">
                    <img class="banner-image" src="{{ asset('assets/images/home11/slider/phones.png') }}" alt="Slider Image">
                  </div>
                </div><!-- /.item -->

                <div class="item">
                  <div class="col-sm-6">
                    <img class="banner-image" src="{{ asset('assets/images/home11/slider/phone2.png') }}" alt="Slider Image">
                  </div>

                  <div class="col-sm-6">
                    <div class="slider-content">
                      <h4 class="top-title" style="color:black">Advertisement</h4>
                      <h2 class="main-title" style="color:black">Place your product here</h2><!-- /.banner-title -->
                      <h3 class="sub-title" style="color:white">size: 225x450</h3><!-- /.banner-sub-title --> 
                    </div><!-- /.slider-content -->
                  </div>
                </div><!-- /.item -->

                <div class="item">
                  <div class="col-sm-6">
                    <div class="slider-content">
                      <h4 class="top-title" style="color:black">Advertisement</h4>
                      <h2 class="main-title" style="color:black">Place your product here</h2><!-- /.banner-title -->
                      <h3 class="sub-title" style="color:white">size: 225x450</h3><!-- /.banner-sub-title --> 
                    </div><!-- /.slider-content -->
                  </div>

                  <div class="col-sm-6">
                    <img class="banner-image" src="{{ asset('assets/images/home11/slider/phone3.png') }}" alt="Slider Image">
                  </div>
                </div><!-- /.item -->
              </div>
            </div><!-- /#banner-slider -->
          </div>

          <div class="col-sm-3">
            <h3 class="banner-title">
              <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="left" style="height:5px;width:5px;margin-top:0" title="Paid member will show here">
                <i class="fa fa-question-circle" style="margin-top:-6px;margin-left:-5px"></i>
              </button>
               Our Partner
            </h3><!-- /.banner-title -->

            <div id="top-sell-slider" class="top-sell-slider carousel slide text-center">

              <ol class="carousel-indicators">
                <li data-target="#top-sell-slider" data-slide-to="0" class="active"></li>
                <li data-target="#top-sell-slider" data-slide-to="1"></li>
                <li data-target="#top-sell-slider" data-slide-to="2"></li>
              </ol>

              <div class="carousel-inner">
                <div class="item active">
                  <div class="product-item">
                    <div class="item-thumbnail">
                      <img src="{{ asset('assets/images/home11/slider/2.jpg') }}" alt="Item Thumbnail">
                      
                    </div><!-- /.item-thumbnail -->

                    <div class="item-details">
                      <h3 class="item-title">Company name here</h3><!-- /.item-title -->
                      <div class="item-price"><span class="currency">Their categories</span></div><!-- /.item-price -->
                    </div><!-- /.item-details -->
                  </div><!-- /.product-item -->

                  <div class="product-item">
                    <div class="item-thumbnail">
                      <img src="{{ asset('assets/images/home11/slider/3.jpg') }}" alt="Item Thumbnail">
                      
                    </div><!-- /.item-thumbnail -->

                    <div class="item-details">
                      <h3 class="item-title">Company name here</h3><!-- /.item-title -->
                      <div class="item-price"><span class="currency">Their categories</span></div><!-- /.item-price -->
                    </div><!-- /.item-details -->
                  </div><!-- /.product-item -->
                </div><!-- /.item -->

                <div class="item">
                  <div class="product-item">
                    <div class="item-thumbnail">
                      <img src="{{ asset('assets/images/home11/slider/4.jpg') }}" alt="Item Thumbnail">
                      
                    </div><!-- /.item-thumbnail -->

                    <div class="item-details">
                      <h3 class="item-title">Company name here</h3><!-- /.item-title -->
                      <div class="item-price"><span class="currency">Their categories</span></div><!-- /.item-price -->
                    </div><!-- /.item-details -->
                  </div><!-- /.product-item -->

                  <div class="product-item">
                    <div class="item-thumbnail">
                      <img src="{{ asset('assets/images/home11/slider/5.jpg') }}" alt="Item Thumbnail">
                      
                    </div><!-- /.item-thumbnail -->

                    <div class="item-details">
                      <h3 class="item-title">Company name here</h3><!-- /.item-title -->
                      <div class="item-price"><span class="currency">Their categories</span></div><!-- /.item-price -->
                    </div><!-- /.item-details -->
                  </div><!-- /.product-item -->
                </div><!-- /.item -->

                <div class="item">
                  <div class="product-item">
                    <div class="item-thumbnail">
                      <img src="{{ asset('assets/images/home11/slider/6.jpg') }}" alt="Item Thumbnail">
                      
                    </div><!-- /.item-thumbnail -->

                    <div class="item-details">
                      <h3 class="item-title">Company name here</h3><!-- /.item-title -->
                      <div class="item-price"><span class="currency">Their categories</span></div><!-- /.item-price -->
                    </div><!-- /.item-details -->
                  </div><!-- /.product-item -->

                  <div class="product-item">
                    <div class="item-thumbnail">
                      <img src="{{ asset('assets/images/home11/slider/7.jpg') }}" alt="Item Thumbnail">
                      
                    </div><!-- /.item-thumbnail -->

                    <div class="item-details">
                      <h3 class="item-title">Company name here</h3><!-- /.item-title -->
                      <div class="item-price"><span class="currency">Their categories</span></div><!-- /.item-price -->
                    </div><!-- /.item-details -->
                  </div><!-- /.product-item -->
                </div><!-- /.item -->
              </div>
            </div><!-- /#top-sell-slider -->
          </div>

        </div><!-- /.banner-top -->


      </div>
    </div><!-- /.container -->
  </section><!-- /.banner -->
@include('productCatalogue')
@endsection
<script>
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
  })

  $('#paid').tooltip(options)
</script>