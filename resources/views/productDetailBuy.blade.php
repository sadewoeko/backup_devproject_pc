@extends('dashboard')
@section('content')
<section class="shop-contents">
    <div class="section-padding" style="margin-top:-100px">
      <div class="container">
        <div class="product-details">

          <div class="row">
            <div class="col-md-6">
              <div class="item-gallery vertical">                    
                <div class="tabs">
                  <div role="tabpanel" class="tabpanel">

                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane in active" id="item1">
                        <img src="{{ asset('uploads/product/' . $data->image) }}" class="img-square img-thumbnail img-responsive" style="width:300px;height:300px" alt="Product Image"> 
                      </div>
                    </div>

                  </div>
                </div><!-- /.item-gallery -->
              </div>
            </div>

            <div class="col-md-6">
              <div class="about-product">
                <h3 class="item-title">{{ $data->product_name }}</h3>
                <!-- <div class="top-meta">
                  <a href="#">20 reviews</a>
                  <a href="#">Write a review</a>
                </div> -->
              @if($data->user_id != session('id'))
                <div class="buttons">
                @if (empty(session('full_name')))
                <a href="{{ route('auth.sign-in') }}"><button class="btn bg-blue btn-radius btn-xs">Contact Now<i class="fa fa-comment-o"></i></button></a>
                @else
                <a href="{{ route('messaging.detail', [session('id'), $data->user_id, $data->id]) }}"><button class="btn bg-blue btn-radius btn-xs">Contact Now<i class="fa fa-comment-o"></i></button></a>
                @endif
                </div>
              @endif
                <div class="product-meta">
                  <span class="meta-id">Category : <span class="meta-about"><a href="#">{{ $data->category }}</a></span></span>
                  <span class="meta-id">Product Origin : <span class="meta-about">{{ $data->product_origin }}</span></span>
                  <span class="meta-id">Product Destination : <span class="meta-about">{{ $data->destination }}</span></span>
                  <span class="meta-id">Quantity : <span class="meta-about">{{ $data->product_stock }}</span></span>
                  <span class="meta-id">Term's of Payment : <span class="meta-about">{{ $data->pay_terms }}</span></span>
                  <span class="meta-id">Tags : <span class="meta-about">{{ $data->category }}</a></span></span>
                </div>
              </div><!-- /.about-product -->
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="product-tabs" style="margin-top:20px">
            @if (empty(session('full_name')))
            <h4 class="alert alert-danger">Sorry! You need to <a href="{{ route('auth.sign-in') }}">sign in</a> to see more details and contact information</h4>
            @else
            <div class="tabs">
              <div role="tabpanel">

                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" aria-expanded="true">Descripton</a></li>
                  <li role="presentation" class=""><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab" aria-expanded="true">Company Profile</a></li>
                </ul>

                <div class="tab-content" style="background-color:#fff;padding:2px;height:auto">
                  <div role="tabpanel" class="tab-pane fade in active" id="tab1">
                    <p class="description">
                      <div class="panel panel-info" style="margin:0;border-color:aliceblue">
                        <div class="panel-heading" style="height:42px">
                          <p>Product Description</p>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                              <strong>{!! $data->product_desc !!}</strong>
                          </div>
                        </div>
                      </div>
                      
                    </p>
                    <br><br>
                  </div>

                  <div role="tabpanel" class="tab-pane fade" id="tab2">
                    <p class="description">
                    <div class="panel panel-info" style="margin:0;border-color:aliceblue">
                      <div class="panel-heading" style="height:42px">
                        <div class="col-md-6">
                          <p style="padding-left:325px" class="panel-title"><strong>DETAILS</strong></p>
                        </div>
                        <div class="col-md-6">
                          <p style="padding-left:170px" class="panel-title"><strong>CONTACT</strong></p>
                       </div>
                      </div>
                      <div class="panel-body">
                        <div class="row">
                        @if (empty($data->foto))
                          <div class="col-md-3 col-lg-3 " align="center">
                            <img src="{{ asset('uploads/photo/pp.png') }}" class="img-thumbnail img-circle img-responsive" style="width:150px;height:150px">
                          </div>
                        @else  
                          <div class="col-md-3 col-lg-3 " align="center">
                            <img src="{{ asset('uploads/photo/' . $data->foto) }}" class="img-thumbnail img-circle img-responsive" style="width:150px;height:150px">
                          </div>
                        @endif
                          <div class=" col-md-9 col-lg-9 "> 
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="col-sm-4">
                                  <strong for="Company">Co. Name</strong>
                                </div>
                                <div class="col-sm-6" style="float:left">
                                  : {{ $data->company_name }}
                                </div>

                                <div class="col-sm-4">
                                  <strong for="Company">Co. Address</strong>
                                </div>
                                <div class="col-sm-6">
                                  : {{ $data->address_company }}
                                </div>

                                <div class="col-sm-4">
                                  <strong for="Company">Country</strong>
                                </div>
                                <div class="col-sm-6">
                                  : {{ $data->negara }}
                                </div>

                                <div class="col-sm-4">
                                  <strong for="Company">State</strong>
                                </div>
                                <div class="col-sm-6">
                                  : {{ $data->negaraa }}
                                </div>

                                <div class="col-sm-4">
                                  <strong for="Company">City</strong>
                                </div>
                                <div class="col-sm-6">
                                  : {{ $data->kota }}
                                </div>
                              </div>
                              
                              <div class="col-md-6 col-sm-6 col-xs-12">
                              
                                <div class="col-sm-4">
                                  <strong for="Company">Cellphone</strong>
                                </div>
                                <div class="col-sm-8">
                                  : +{{ $data->cellphone }}
                                </div>

                                <div class="col-sm-4">
                                  <strong for="Company">Cellphone2</strong>
                                </div>
                                <div class="col-sm-8">
                                  : +{{ $data->cellphone2 }}
                                </div>
                                    
                                <div class="col-sm-4">
                                  <strong for="Company">Phone</strong>
                                </div>
                                <div class="col-sm-8">
                                  : +{{ $data->office_phone }}
                                </div>

                                <div class="col-sm-4">
                                  <strong for="Company">Phone2</strong>
                                </div>
                                <div class="col-sm-8">
                                  : +{{ $data->office_phone2 }}
                                </div>

                                <div class="col-sm-4">
                                  <strong for="Company">Email</strong>
                                </div>
                                <div class="col-sm-8">
                                  : {{ $data->email }}
                                </div>
                                <div class="col-sm-4">
                                  <strong for="Company">Website</strong>
                                </div>
                                <div class="col-sm-8" style="padding-right:0">
                                  : {{ $data->website }}
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="col-sm-12">
                                <strong for="Company">Company Descripton</strong>
                              </div>
                              <div class="col-sm-12">
                                {{ $data->desc_company }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    </p>
                    <br><br>
                  </div><!-- /.tab-pane -->

                  <div role="tabpanel" class="tab-pane fade" id="tab3">

                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.tab-panel -->
            </div><!-- /.tabs -->
            @endif
          </div><!-- /.product-tabs --> 
        </div><!-- /.product-details -->
      </div><!-- /.container -->
    </div><!-- /.section-padding -->
  </section><!-- /.shop-contents -->
  @endsection 