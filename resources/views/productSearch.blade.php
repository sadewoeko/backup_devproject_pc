@extends('dashboard')
@section('content')
<style>
.btn.contacts{
  background:#fff;
  color:black !important;
  height:43px;
  width:auto;
  margin-right:5px;
}
.description{
  height: 40px;
}
</style>
<hr>
<section class="shop-contents">
    <div class="section">
      <div class="container">
        <div class="row">
        <h2><center>--PRODUCT SHOW--</center></h2>
          <div class="col-md-13 pull-center">
            <div class="row">
              <div class="product-filter">
                <div class="col-md-4">
                  <span class="filter-text">Showing {{ $datas->count() }} product</span>
                </div>
              </div>
            </div>

            <div class="shop-products">
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in text-center" id="grid">
                @foreach($datas as $data)
                <div role="tabpanel" class="tab-pane fade active in text-left" id="list" style="background:#fff">
                      @if($data->flag == 'buy' ? 0 : 1)
                      <div class="item media">
                        <div class="item-thumbnail media-left" style="border-right:0px">
                          <img src="{{ asset('uploads/product/' . $data->image) }}" class="img-square img-thumbnail" style="max-height:235px;max-width:360px;height:235px;width:360px" alt="Image">
                          @if($data->flag == 0)
                            <span class="ribbon sale" style="background: #e32636; !important;">Sell</span>
                          @else
                            <span class="ribbon sale" style="background: #53da37; !important;">Buy</span>
                          @endif
                        </div><!-- /.item-image -->

                        <div class="item-content media-body">
                          <div class="col-sm-8">
                            <h3 class="item-title" style="margin-left:-15px">{{ link_to_route('productDetailBuy.detail', $data->product_name, array($data->id), array('class' => 'green')) }}</h3><!-- /.item-title -->
                          </div>
                          <div class="col-sm-4">
                            <h3 class="item-title"><i class="fa fa-user" style="margin-right:5px;"></i>{{ $data->full_name }}</h3><!-- /.item-title -->
                          </div>
                          
                          {{-- <div class="item-price">
                            <div class="current-price"><span class="currency">IDR &nbsp;</span><span class="price">{{ $data->product_price }}</span></div><!-- /.current-price -->
                          </div><!-- /.item-price --> --}}

                          <div class="description">
                          {!! substr($data->product_desc,0,50) !!} 
                          </div><!-- /.description -->

                          <div class="item-bottom">
                            <div class="buttons">
                              @if(empty(session('id')))
                              <a class="btn btn-default contacts" href="{{ route('auth.sign-in') }}"><p style="padding:10px;color:black">Contact Now  <i class="fa fa-envelope"></i></p></a>
                              <a class="btn btn-default contacts" href="{{ route('auth.sign-in') }}" class="text"><p style="padding:10px;color:black">{{ $data->company_name }}</p></a>
                              @else
                                @if($data->user != session('id'))
                                  <a class="btn btn-default contacts" href="{{ route('messaging.detail',[session('id'), $data->user, $data->id]) }}"><p style="padding:10px;color:black">Contact Now  <i class="fa fa-envelope"></i></p></a>
                                  <a class="btn btn-default contacts" href="{{ route('profile.index',[$data->user]) }}"><p style="padding:10px;color:black">{{ $data->company_name }}</p></a>
                                @endif
                              @endif
                              <b style="padding:10px;color:black"><img src="http://www.countryflags.io/{{ $data->sortname }}/shiny/64.png" style="width:30px;height:30px;padding-right:5px">{{ $data->name }}</b>
                            </div><!-- /.buttons -->
                          </div><!-- /.item-bottom -->
                        </div><!-- /.item-details -->
                      </div><!-- /.item -->
                      @else
                      <div class="item media">
                        <div class="item-thumbnail media-left" style="margin-right:0px">
                          <img src="{{ asset('uploads/product/' . $data->image) }}" class="img-square img-thumbnail img-responsive" style="max-height:235px;max-width:360px;height:235px;width:360px" alt="Image">
                          @if($data->flag == 0)
                            <span class="ribbon sale" style="background: #e32636; !important;">Sell</span>
                          @else
                            <span class="ribbon sale" style="background: #53da37; !important;">Buy</span>
                          @endif
                        </div><!-- /.item-image -->

                        <div class="item-content media-body">
                          <div class="col-sm-8">
                            <h3 class="item-title" style="margin-left:-15px">{{ link_to_route('productDetail.detail', $data->product_name, array($data->id), array('class' => 'green')) }}</h3><!-- /.item-title -->
                          </div>
                          <div class="col-sm-4">
                            <h3 class="item-title"><i class="fa fa-user" style="margin-right:5px;"></i>{{ $data->full_name }}</h3><!-- /.item-title -->
                          </div>
                          
                          <div class="item-price">
                            <div class="current-price"><span class="currency">IDR &nbsp;</span><span class="price">{{ $data->product_price }}</span></div><!-- /.current-price -->
                          </div><!-- /.item-price -->

                          <div class="description">
                          {!! substr($data->product_desc,0,50) !!} 
                          </div><!-- /.description -->

                          <div class="item-bottom">
                            <div class="buttons">
                              @if(empty(session('id')))
                              <a class="btn btn-default contacts" href="{{ route('auth.sign-in') }}"><p style="padding:10px;color:black">Contact Now  <i class="fa fa-envelope"></i></p></a>
                              <a class="btn btn-default contacts" href="{{ route('auth.sign-in') }}" class="text"><p style="padding:10px;color:black">{{ $data->company_name }}</p></a>
                              @else
                                @if($data->user != session('id'))
                                  <a class="btn btn-default contacts" href="{{ route('messaging.detail',[session('id'), $data->user, $data->id]) }}"><p style="padding:10px;color:black">Contact Now  <i class="fa fa-envelope"></i></p></a>
                                  <a class="btn btn-default contacts" href="{{ route('profile.index',[$data->user]) }}"><p style="padding:10px;color:black">{{ $data->company_name }}</p></a>
                                @endif
                              @endif
                              <b style="padding:10px;color:black"><img src="http://www.countryflags.io/{{ $data->sortname }}/shiny/64.png" style="width:30px;height:30px;padding-right:5px">{{ $data->name }}</b>
                            </div><!-- /.buttons -->
                          </div><!-- /.item-bottom -->
                        </div><!-- /.item-details -->
                      </div><!-- /.item -->
                      @endif
                </div>                  
                @endforeach
                </div>

                {{--  <div role="tabpanel" class="tab-pane fade active in text-left" id="list">  --}}
                  
                </div><!-- /.tab-pane -->
              </div><!-- /.tab-content -->
            </div><!-- /.shop-products -->
            
            {{ $datas->appends(['flag' => $flag, 'keyword' => $keyword])->links() }}
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection            
