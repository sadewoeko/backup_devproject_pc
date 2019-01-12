@extends('dashboard')
@section('content')

<style>
.form-control{
  height: 35px;
  border: 1px solid #000;
}
.form-control:focus{
  border: 1px solid #000;
}
.input-group-addon{
  border: 1px solid #000
}
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

.tbl-cell{
  padding-top: 30px;
}

.profile-aside{
  margin: 0 0 20px;
  position: relative;
}
.font-icon{
  padding-left: 35px;
}

</style>
<section class="list-panels text-center">
  
<div class="row">
<div class="container-fluid" style="width:100%;padding:15px 15px">
  <div class="row" style="display:flex">
    <div class="col-xl-3 col-lg-4">
      <aside class="profile-aside">
        <section class="box-typical profile-side-user">
            @if (empty($result[0]->image))
            <img class="img-circle" style="width:150px;height:150px" src="{{ asset('uploads/photo/pp.png') }}">
            @else
            <img class="img-circle" style="width:150px;height:150px" src="{{ asset('uploads/photo/' . $result[0]->image) }}">
            @endif
              @if (empty($result[0]->company_name) || $result[0]->company_name== '0')             
              @else
                <h4>{{ $result[0]->company_name }}</h4>
              @endif
                <p>{{ $result[0]->gender }} {{ $result[0]->full_name }}<p>
        </section>
        <section class="box-typical profile-side-stat">
          <div class="tbl">
            <div class="tbl-row">
              <div class="tbl-cell">
                <span class="number">{{ $products->count() }}</span>
                Products
              </div>
            </div>
          </div>
        </section>
        <section class="box-typical">
          <header class="box-typical-header-sm bordered">Description</header>
          <div class="box-typical-inner">
            {{ $result[0]->desc_company }}
            <p class="line-with-icon">
              <i class="font-icon font-icon-pin-2"></i>
              {{ $result[0]->address_company }}
            </p>
            <p class="line-with-icon">
              <i class="font-icon font-icon-phone"></i>
              {{ $result[0]->office_phone }}
            </p>
            <p class="line-with-icon">
              <i class="font-icon font-icon-phone"></i>
              {{ $result[0]->office_phone2 }}
            </p>
          </div>
        </section>
        {{-- <section class="box-typical">
          <header class="box-typical-header-sm bordered">Category</header>
          <div class="box-typical-inner">
            <p>All stream</p>
            <p>Connected Apps</p>
            <p>Photos</p>
            <p>Most recent</p>
          </div>
        </section> --}}
      </aside>
    </div>

    <div class="col-xl-9 col-lg-8">
      <section class="tabs-section">
        <div class="tabs-section-nav tabs-section-nav-left">
          <ul class="nav" role="tablist">
            <li class="nav-item active">
              <a class="nav-link" href="#tabs-2-tab-1" role="tab" data-toggle="tab">
                <span class="nav-link-in">
          @if (session('id')!=$result[0]->id)
          About
          @else
          About me
          @endif
                </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tabs-2-tab-2" role="tab" data-toggle="tab">
                <span class="nav-link-in">Product</span>
              </a>
            </li>
            @if($result[0]->id != session('id'))
            @else
            <li class="nav-item">
              <a class="nav-link" href="#tabs-2-tab-3" role="tab" data-toggle="tab">
                <span class="nav-link-in">Settings</span>
              </a>
            @endif
            </li>
          </ul>
        </div><!--.tabs-section-nav-->

        <div class="tab-content no-styled profile-tabs">
          <div role="tabpanel" class="tab-pane active" id="tabs-2-tab-1">
            <section class="box-typical box-typical-padding">
              <h4>About me</h4>
              <article class="box-typical profile-post">
                <div class="profile-post-header">
                  <div class="user-card-row">
                    <div class="tbl-row">
                    <input type="hidden" name="id" value="{{ $result[0]->id }}">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="Name (Full name)">Full Name</label>  
                          <div class="col-md-4">
                            <div class="input-group">
                              <div class="input-group-addon" style="width:20px">
                                <i class="fa fa-user" style="width:20px"></i>
                              </div>
                              <input style="width:240px" id="full_name" name="full_name" type="text" value="{{ $result[0]->full_name }}" class="form-control input-md" readonly>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="user-card-row">
                    <div class="tbl-row">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="email">Email</label>  
                        <div class="col-md-4">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-envelope-o" style="width:20px"></i>
                            </div>
                              <input style="width:240px" id="email" name="email" type="text" value="{{ $result[0]->email }}" class="form-control input-md" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="user-card-row">
                    <div class="tbl-row">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="country">Country</label>  
                        <div class="col-md-4">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-flag" style="width:20px"></i>
                            </div>
                                <select style="width:240px" class="form-control" disabled>
                                  <option>{{ $result[0]->country }}</option>
                                </select>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="user-card-row">
                    <div class="tbl-row">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="Phone number">State/Province</label>  
                        <div class="col-md-4">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-flag" style="width:20px"></i>
                            </div>
                                <select style="width:240px" class="form-control" disabled>
                                  <option>{{ $result[0]->state }}</option>
                                </select>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="user-card-row">
                    <div class="tbl-row">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="Phone number">City</label>  
                        <div class="col-md-4">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-home" style="width:20px"></i>
                            </div>
                                <select style="width:240px" class="form-control" disabled>
                                  <option>{{ $result[0]->city }}</option>
                                </select>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="user-card-row">
                    <div class="tbl-row">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="Phone number ">Cell Phone </label>  
                          <div class="col-md-4">
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-mobile" style="width:20px"></i>
                              </div>
                                <input style="width:240px" id="Phone number " name="cellphone" type="text" value="{{ ($result[0]->cellphone != NULL) ? $result[0]->cellphone : '' }}" class="form-control input-md" disabled>                       
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="user-card-row">
                    <div class="tbl-row">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="Phone number">Cell Phone 2</label>  
                        <div class="col-md-4">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-mobile" style="width:20px"></i>
                            </div>
                                <input style="width:240px" id="Phone number" name="cellphone2" type="text" value="{{ ($result[0]->cellphone2 != NULL) ? $result[0]->cellphone2 : '' }}" class="form-control input-md" disabled>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="user-card-row">
                    <div class="tbl-row">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="Overview (max 200 words)">Address</label>
                          <div class="col-md-4">                     
                            <textarea style="width:285px" class="form-control" rows="5"  id="Overview (max 200 words)" name="address" disabled>{{ ($result[0]->address != NULL) ? $result[0]->address : '' }}</textarea>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="user-card-row">
                    <div class="tbl-row">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="website">Website</label>  
                        <div class="col-md-4">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-globe" style="width:20px"></i>
                            </div>
                                <a style="width:240px" id="website" name="website" type="button" href="http://{{ ($result[0]->website != NULL) ? $result[0]->website : '' }}" class="form-control input-md">{{ ($result[0]->website != NULL) ? $result[0]->website : '' }}</a>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>           
                </div>
              </article>
            </section>
          </div><!--.tab-pane-->
          <div role="tabpanel" class="tab-pane" id="tabs-2-tab-2">         
            <section class="box-typical box-typical-padding">
              <h4>List of Product</h4>
              <article class="box-typical profile-post">
                  <div class="container">
                    <div class="shop-products">
                      <div class="row">
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in text-center" id="grid">
                            <div class="col-sm-12" style="width:813px">
                            @foreach($products as $product)
                            <div class="col-sm-3" style="padding:0">
                              <div class="item" style="height:225px;margin:0">
                                <div class="item-thumbnail" style="height:150px;width:195px">
                                  
                                    <img src="{{ asset('uploads/product/' . $product->image) }}" style="height:155px;width:190px" class="img-responsive" alt="Item Thumbnail">
                                  
                                  @if($product->flag == 0)
                                    <span class="ribbon sale" style="background: #e32636 !important;top:3px;right:5px">Sell</span>
                                  @else
                                    <span class="ribbon sale" style="background: #53da37 !important;top:3px;right:5px">Buy</span>
                                  @endif  
                                </div><!-- /.item-thumbnail -->

                                <div class="item-content">
                                  @if($product->flag == 'sell' ? 1 : 0)
                                    <h3 class="item-title">{{ link_to_route('productDetail.detail', $product->product_name, array($product->id), array('class' => 'green')) }}</h3><!-- /.item-title -->                      
                                  @else
                                    <h3 class="item-title">{{ link_to_route('productDetailBuy.detail', $product->product_name, array($product->id), array('class' => 'green')) }}</h3><!-- /.item-title -->                 
                                  @endif                                
                                </div><!-- /.item-content -->
                              </div><!-- /.item -->
                            </div>
                            @endforeach
                          </div>
                          </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                      </div><!-- /.row -->
                  </div><!-- /.shop-products -->
                </div>
              </article>
            </section>
          </div><!--.tab-pane-->
          <div role="tabpanel" class="tab-pane" id="tabs-2-tab-3">
            @if($result[0]->id != session('id'))
            @else
            <section class="box-typical box-typical-padding">
                <h4>Settings</h4>
              <article class="box-typical profile-post">
                {{ Form::open(array('class'=> 'form-horizontal','route' => 'profile.update','enctype' => 'multipart/form-data')) }}
                  <input type="hidden" name="id" value="{{ $result[0]->id }}">
                          <div class="form-group">
                            <div class="col-md-12" align="center">
                              <div class="input-group">
                                
                                  <img id="image_upload_preview" src="http://placehold.it/200x200" alt="your image" style="width:200px;height:200px;margin-left:84px"/>
                                  <input type='file' id="inputFile" name="image" />
                                  <p class="help-block">File extension should be .jpg, .png. Less than 1Mb</p>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label" for="Name (Full name)">Full Name</label>  
                            <div class="col-md-4">
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-user"></i>
                                </div>
                                  <input id="full_name" name="full_name" type="text" value="{{ $result[0]->full_name }}" class="form-control input-md"  >
                                </div>
                            </div>
                          </div>                    

                          <div class="form-group">
                            <label class="col-md-4 control-label" for="country">Country</label>  
                            <div class="col-md-4">
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-flag"></i>
                                </div>
                                    <select name="country_id" class="form-control" id="country" onChange="getStates()" required>
                                      @foreach($countries as $country)
                                        <option value="{{ $country->id }}"  
                                          @php
                                            if ($country->name == $result[0]->country) {
                                              echo "selected";
                                            }
                                          @endphp
                                        >
                                          {{ $country->name }}
                                        </option>
                                      @endforeach
                                    </select>

                                </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label" for="Phone number">State/Province</label>  
                            <div class="col-md-4">
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-flag"></i>
                                </div>
                                <select name="state_id" id="states" class="form-control" onChange="getCities()" required>
                                      @foreach($states as $state)
                                        <option value="{{ $state->id }}"  
                                          @php
                                            if ($state->name == $result[0]->state) {
                                              echo "selected";
                                            }
                                          @endphp
                                        >
                                          {{ $state->name }}
                                        </option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label" for="Phone number">City</label>  
                            <div class="col-md-4">
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-home"></i>
                                </div>
                                <select name="city_id" id="cities" class="form-control" required>
                                      <option value="{{ $result[0]->city_id }}">{{ $result[0]->city }}</option>
                                </select>
                                </div>
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="Phone number ">Cell Phone </label>  
                              <div class="col-md-4">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-mobile"></i>
                                  </div>
                                    <input id="Phone number" name="cellphone" type="text" value="{{ ($result[0]->cellphone != NULL) ? $result[0]->cellphone : '' }}" class="form-control input-md"  >                       
                                </div>
                              </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="Phone number">Cell Phone 2</label>  
                            <div class="col-md-4">
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-mobile"></i>
                                </div>
                                    <input id="Phone number" name="cellphone2" type="text" value="{{ ($result[0]->cellphone2 != NULL) ? $result[0]->cellphone2 : '' }}" class="form-control input-md"  >
                                </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label" for="Overview (max 200 words)">Address</label>
                              <div class="col-md-4">                     
                                <textarea class="form-control" rows="5"  id="Overview (max 200 words)" name="address">{{ ($result[0]->address != NULL) ? $result[0]->address : '' }}</textarea>
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label" for="website">Website</label>  
                            <div class="col-md-4">
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-globe"></i>
                                </div>
                                    <input id="website" name="website" type="text" value="{{ ($result[0]->website != NULL) ? $result[0]->website : '' }}" class="form-control input-md"  >
                                </div>
                            </div>
                          </div>
          
                          <div class="panel-heading" style="background-color:#eee;margin-bottom:20px"> 
                            <h3 class="panel-title">Company Profile</h3> 
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="company">Company</label>  
                              <div class="col-md-4">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                  </div>
                                    <input id="company_name" name="company_name" type="text" value="{{ $result[0]->company_name }}" class="form-control input-md"  >
                                </div>                                  
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label" for="Overview (max 200 words)">Address</label>
                              <div class="col-md-4">                     
                                <textarea class="form-control" rows="5"  id="Overview (max 200 words)" name="address_company">{{ ($result[0]->address_company != NULL) ? $result[0]->address_company : '' }}</textarea>
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label" for="Overview (max 200 words)">Description Company</label>
                              <div class="col-md-4">                     
                                <textarea class="form-control" rows="5"  id="Overview (max 200 words)" name="desc_company">{{ ($result[0]->desc_company != NULL) ? $result[0]->desc_company : '' }}</textarea>
                              </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="office_phone ">Office Phone</label>  
                              <div class="col-md-4">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                  </div>
                                    <input id="office_phone" name="office_phone" type="text" value="{{ ($result[0]->office_phone) }}" class="form-control input-md"  >                       
                                </div>
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label" for="office_phone2 ">Office Phone2</label>  
                              <div class="col-md-4">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                  </div>
                                    <input id="office_phone2 " name="office_phone2" type="text" value="{{ ($result[0]->office_phone2) }}" class="form-control input-md"  >                       
                                </div>
                              </div>
                          </div>


                            <div class="form-group">
                              <label class="col-md-4 control-label" ></label>  
                                <div class="col-md-4">                            
                                  <input type="submit" class="btn btn-danger" value="Update Profile" style="padding-top:0">
                              </div>
                            </div>
                  {{ Form::close() }}
              </article>
            </section>
            @endif
          </div><!--.tab-pane-->
        </div><!--.tab-content-->
      </section><!--.tabs-section-->
    </div>

  </div><!-- /-row -->
</div>
</div>
</section>

<!-- @section('javascript') 
  <script src="{{ asset('assets/assets/datatable/jquery-1.12.4.js') }}"></script> 
  <script src="{{ asset('assets/assets/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/assets/datatable/dataTables.bootstrap.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
@endsection -->

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputFile").change(function () {
        readURL(this);
    });
</script>

  <script type="text/javascript">
      function changeData() {
          $("#form :input").removeAttr(" ");
      }
  
    var getStates = function() { 
      var country_id = $('#country').val();
      var host = "{{ env("APP_URL") }}"
      var urlGetState = host + '/api/get/state/' + country_id;
      var urlGetPhoneCode = host + '/api/get/phonecode/' + country_id;

      $.get(urlGetState, function(data) {
          var select = $('#states');
          select.empty();

          $.each(data,function(key, value) {
              select.append('<option value=' + value.id + '>' + value.name + '</option>');
          });
      });

      $.get(urlGetPhoneCode, function(data) {
          $('#phonecode').val(data);
          $('#phonecode2').val(data);
          $('#cellphonecode').val(data);
          $('#cellphonecode2').val(data);
      });
    }

    var getCities = function() {
      var states_id = $('#states').val();
      var host = "{{ env("APP_URL") }}"
      var url = host + '/api/get/cities/' + states_id;

      $.get(url, function(data) {
          var select = $('#cities');
          select.empty();

          $.each(data,function(key, value) {
              select.append('<option value=' + value.id + '>' + value.name + '</option>');
          });
      });
    }
    
</script>

 
<script src="{{ asset('assets/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/assets/js/tether.min.js') }}"></script>
<script src="{{ asset('assets/assets/js/plugins.js') }}"></script>

<script src="{{ asset('assets/assets/js/salvattore.min.js') }}"></script>
<script src="{{ asset('assets/assets/js/ion.rangeSlider.js') }}"></script>
<script src="{{ asset('assets/assets/js/jquery.fancybox.pack.js') }}"></script>
<script>
  $(".nav-item").on("click", function(){
        $(".nav-item").find(".active").removeClass("active");
        $(this).parent().addClass("active");
      });
      
  $(document).ready(function() {
    $(".fancybox").fancybox({
      padding: 0,
      openEffect	: 'none',
      closeEffect	: 'none'
    });

    $("#range-slider-1").ionRangeSlider({
      min: 0,
      max: 100,
      from: 30,
      hide_min_max: true,
      hide_from_to: true
    });

    $("#range-slider-2").ionRangeSlider({
      min: 0,
      max: 100,
      from: 30,
      hide_min_max: true,
      hide_from_to: true
    });

    $("#range-slider-3").ionRangeSlider({
      min: 0,
      max: 100,
      from: 30,
      hide_min_max: true,
      hide_from_to: true
    });

    $("#range-slider-4").ionRangeSlider({
      min: 0,
      max: 100,
      from: 30,
      hide_min_max: true,
      hide_from_to: true
    });

  });
</script>

<script src="{{ asset('assets/assets/js/app.js') }}"></script>
  <script type="text/javascript">
      function changeData() {
          $("#form :input").removeAttr("disabled");
      }
  </script>

   @endsection

          