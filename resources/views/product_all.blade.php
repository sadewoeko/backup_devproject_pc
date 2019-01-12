@extends('dashboard')

@section('content') 
<link rel="stylesheet" href="{{ asset('assets/assets/css/product_all.css') }}">
<section class="shop-contents">
    <div class="container">
        <div class="shop-products">
          <div class="row">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in text-center" id="grid">

              @foreach($products as $product)
                <div class="pict-space col-sm-2">
                  <div class="item">
                    <div class="item-thumbnail">
                      <!-- <a class="fancybox" href="{{ asset('uploads/product/' . $product->image) }}"> -->
                        <img class="item-img" src="{{ asset('uploads/product/' . $product->image) }}" alt="Item Thumbnail">
                        @if($product->flag == 0)
                            <span class="ribbon sale">Sell</span>
                        @else
                            <span class="ribbon buy">Buy</span>
                        @endif
                      </a>
                    </div><!-- /.item-thumbnail -->

                    <div class="item-content">
                        @if($product->flag == 'sell' ? 1 : 0)
                        <h3 class="item-title">{{ link_to_route('productDetail.detail', substr($product->product_name,0,30), array($product->id), array('class' => 'green')) }}</h3><!-- /.item-title -->
                        <div class="item-price">
                          @if(empty($product->company_name) || $product->company_name == '0' )
                            <label class="flag-label"><img class="flag-sortname" src="http://www.countryflags.io/{{ $product->sortname }}/shiny/64.png"></label><span>&nbsp;</span>
                            <strong class="company-name">{{ $product->full_name }}</strong>
                          @else
                          <label class="flag-label"><img class="flag-sortname" src="http://www.countryflags.io/{{ $product->sortname }}/shiny/64.png"></label><span>&nbsp;</span>
                          <strong class="company-name">{{ $product->company_name }}</strong>
                          @endif
                        </div>
                        @else
                        <h3 class="item-title">{{ link_to_route('productDetailBuy.detail', substr($product->product_name,0,30), array($product->id), array('class' => 'green')) }}</h3><!-- /.item-title -->
                        <div class="item-price">
                            @if(empty($product->company_name) || $product->company_name == '0' )
                              <label class="flag-label"><img class="flag-sortname" src="http://www.countryflags.io/{{ $product->sortname }}/shiny/64.png"></label><span>&nbsp;</span>
                              <strong>{{ $product->full_name }}</strong>
                            @else
                            <label class="flag-label"><img class="flag-sortname" src="http://www.countryflags.io/{{ $product->sortname }}/shiny/64.png"></label><span>&nbsp;</span>
                            <strong class="company-name">{{ $product->company_name }}</strong>
                            @endif
                        </div>             
                        @endif
                    </div><!-- /.item-content -->
                  </div><!-- /.item -->
                </div>
               @endforeach
               {{ $products->links() }}

            </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
          </div><!-- /.row -->
        </div><!-- /.shop-products -->
        </div><!-- /.container -->
    
  </section><!-- /.shop-contents -->
 @endsection