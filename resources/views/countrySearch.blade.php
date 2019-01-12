@extends('dashboard')
@section('content')

<section class="shop-contents">
    <div class="section">
      <div class="container">
        <div class="row">
        <h2><center>--COUNTRY SHOW--</center></h2>
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
                            @if (empty($data->img))
                              <div class="col-md-12 col-lg-12 " align="center"> <img src="{{ asset('uploads/photo/pp.png') }}" class="img-circle img-responsive" style="width:200px;height:200px"> </div>
                            @else  
                              <div class="col-md-12 col-lg-12 " align="center"> <img src="{{ asset('uploads/photo/' . $data->img) }}" class="img-circle img-responsive" style="width:200px;height:200px"> </div>
                            @endif
                        </div><!-- /.item-image -->

                        <div class="item-content media-body">
                          <h2 class="item-title">
                              <div class="company"><span class="company">{{ link_to_route('profile.index', $data->company_name, array($data->id), array('class' => 'green')) }}</span></div>  
                          </h2><!-- /.item-title -->

                          <h3 class="item-title">
                            <div class="company"><i class="fa fa-user"></i>  <span class="company">{{ $data->full_name }}</span>
                            </div>
                          </h3>

                          <p class="description">
                            {{ $data->desc_company }}
                          </p><!-- /.description -->

                          <div class="item-bottom">
                            <div class="buttons">
                              {{--  <button class="contact">Contact Now <i class="fa fa-envelope"></i></button>  --}}
                              <p style="padding-top:8px;color:black"><img src="http://www.countryflags.io/{{ $data->sortname }}/shiny/64.png" style="width:30px;height:30px;padding-right:5px">{{ $data->name }}</p>
                             
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
            
            {{ $datas->appends(['flag' => $flag, 'keyword' => $keyword])->links() }}
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection            
