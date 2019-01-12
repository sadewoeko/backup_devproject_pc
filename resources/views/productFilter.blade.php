@extends('dashboard')
@section('content')

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

                <!-- <div class="col-md-8 text-right">
                  <div class="show-item">
                    <span class="filter-title">Show:</span>
                    <select id="item-number" data-select-like-alignement="never" class="item-number drop-select">
                      <option value="">12</option>
                      <option value="2">16</option>
                      <option value="3">20</option>
                      <option value="4">24</option>
                    </select>
                  </div>

                  <div class="filter-view">
                    <span class="filter-title">View:</span>
                    <ul role="tablist">
                      <li class="grid-view active" id="grid-top"><a href="#grid" role="tab" data-toggle="tab"><i class="fa fa-th-large"></i></a></li>
                    </ul>
                  </div>
                </div> -->
              </div>
            </div>

            <div class="shop-products">
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in text-center" id="grid">
                @foreach($datas as $data)
                <div role="tabpanel" class="tab-pane fade active in text-left" id="list">
                      <div class="item media">
                        <div class="item-thumbnail media-left">
                          <img src="{{ asset('uploads/product/' . $data->image) }}" height="200px" weight="200px" alt="Item Thumbnail">
                          @if($data->flag == 0)
                            <span class="ribbon sale" style="background: #e32636; !important;">Sell</span>
                          @else
                            <span class="ribbon sale" style="background: #53da37; !important;">Buy</span>
                          @endif
                        </div><!-- /.item-image -->

                        <div class="item-content media-body">
                        
                          <h3 class="item-title">{{ link_to_route('productDetail.detail', substr($data->product_name,0,50), array($data->id), array('class' => 'green')) }}</h3><!-- /.item-title -->                          <div class="item-price">
                            <div class="current-price"><span class="currency">{{ $data->currency }} &nbsp;</span><span class="price">{{ $data->product_price }}</span></div><!-- /.current-price -->
                          </div><!-- /.item-price -->

                          <p class="description">
                          {!! substr($data->product_desc,0,100) !!} 
                          </p><!-- /.description -->
                        

                          <div class="item-bottom">
                            <div class="buttons">
                              @if(empty(session('id')))
                                <a class="btn btn-default contact"  style="background:#fff;color:black !important;height:43px" href="{{ route('auth.sign-in') }}"><p style="padding-top:10px;color:black">Contact Now  <i class="fa fa-envelope"></i></p></a>
                              @else
                                @if($data->user != session('id'))
                                  <a class="btn btn-default contact"  style="background:#fff;color:black !important;height:43px" href="{{ route('messaging.detail',[session('id'), $data->user, $data->id]) }}"><p style="padding-top:10px;color:black">Contact Now  <i class="fa fa-envelope"></i></p></a>
                                @endif
                              @endif
                              <button class="text">{{ $data->company_name }}</button>
                              <button class="text"><img src="http://www.countryflags.io/{{ $data->sortname }}/shiny/64.png" style="width:30px;height:20px;padding-right:5px">{{ $data->name }}</button>
                            </div><!-- /.buttons -->
                          </div><!-- /.item-bottom -->
                        </div><!-- /.item-details -->
                      </div><!-- /.item -->
                </div>
                  
                  @endforeach



                </div>

                <div role="tabpanel" class="tab-pane fade active in text-left" id="list">
                  
                </div><!-- /.tab-pane -->
              </div><!-- /.tab-content -->
            </div><!-- /.shop-products -->
            
            {{ $datas->links() }}
            
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection            
