@extends('dashboard')
@section('content')


  
  <section class="login-section">
    <div class="section-padding">
      <div class="container">
        <div class="row" style="margin-top : -130px">
        @if (session('authlog'))
            <div class="alert alert-danger">
              {{ session('authlog') }}
            </div>
        @endif
          

          <div class="col-md-12">
            <div class="sign-up">
              <h1 class="title" style="font-family:Poppins">
                Get Registered
                <span></span></h1>
              <br>
              <h2 class="title">Member Description <span></span></h2><!-- /.title -->

              @if (session('status'))
                 <div class="alert alert-success">
                    {{ session('status') }}
                 </div>
              @endif

              @if (session('error-register'))
                 <div class="alert alert-danger">
                    {{ session('error-register') }}
                 </div>
              @endif

              {{ Form::open(array('class'=> 'sign-up-form','route' => 'auth.register','enctype' => 'multipart/form-data')) }}
              
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label" style="padding-top:20px">Full Name<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Full Name" id="full_name" name="full_name" minlength="5" value="{{ old('full_name') }}" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label" style="padding-top:20px">Email<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:20px">
                    <label for="gender" class="col-sm-3 control-label">Gender<span style="color:red">*</span></label>
                    <div class="col-sm-9" style="margin-bottom:20px">
                        <label class="radio-inline">
                        <input type="radio" name="gender" value="Mr." required> Mr</label>
                      
                        <label class="radio-inline">
                        <input type="radio" name="gender" value="Ms." required> Ms</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" style="margin-left:-277px 0;padding-top:20px" class="col-sm-3 control-label">Password<span style="color:red">*</span></label>
                    <div class="col-sm-9" style="margin-right:-1px">
                      <input type="password" class="form-control" placeholder="Password" id="password" name="password" minlength="8" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label" style="padding-top:20px">Confirm-password<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                    <span id='warning-password' style="color:red;"></span>
                      <input type="password" class="form-control" placeholder="Confirm Password" id="confirm-password" name="repassword" minlength="8" onKeyUp="confirmPassword()" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="country" class="col-sm-3 control-label" style="padding-top:20px">Country<span style="color:red">*</span></label>
                    <div class="col-sm-9" style="margin-bottom:20px">
                      <select name="country_id" class="form-control" style="height:48px" id="country" onChange="getStates()" required>
                        <option value="">--- COUNTRY ---</option>
                        @foreach($countries as $country)
                          <option value="{{ $country->id }}">{{ $country->name }}</option>   
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="city" class="col-sm-3 control-label" style="padding-top:20px">State/Province<span style="color:red">*</span></label>
                    <div class="col-sm-9" style="margin-bottom:20px">
                      <select name="state_id" id="states" class="form-control" style="height:48px" onChange="getCities()" required>
                        <option value="">--- STATE / PROVINCE ---</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="city" class="col-sm-3 control-label" style="padding-top:20px">City<span style="color:red">*</span></label>
                    <div class="col-sm-9" style="margin-bottom:20px">
                      <select name="city_id" id="cities" class="form-control" style="height:48px" required>
                        <option value="">--- CITY ---</option>  
                      </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label" style="padding-top:20px">Cell Phone<span style="color:red">*</span></label>
                    <div class="col-sm-3">
                    <input type="number" class="form-control" placeholder="Cell Phone Code"  id="cellphonecode" name="cellphonecode" readonly>
                    </div>
                    <div class="col-sm-6">
                      <input type="number" class="form-control" placeholder="Cell Phone Number"  id="cellphonenumber" name="cellphonenumber" maxlength="11"  value="{{ old('cellphonenumber') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label" style="padding-top:20px">Cell Phone 2<span style="color:grey">(optional)</span></label>
                    <div class="col-sm-3">
                      <input type="number" class="form-control" placeholder="Cell Phone Number"  id="cellphonecode2" name="cellphonecode2" readonly>
                    </div>
                    <div class="col-sm-6">
                      <input type="number" class="form-control" placeholder="Cell Phone Number "  id="cellphonenumber2" name="cellphonenumber2" maxlength="11" value="{{ old('cellphonenumber2') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label" style="padding-top:20px">Address<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Address"  id="address" name="address"  value="{{ old('address') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="website" class="col-sm-3 control-label" style="padding-top:20px">Website</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="website"  id="website" name="website"  value="{{ old('website') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">I am<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <div class="row" style="margin-left:0">
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                  <input type="radio" name="buyer_seller" value="seller" style="position:absolute;margin-top:2px;margin-left:-69px" required> Seller
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                <input type="radio" name="buyer_seller" value="buyer" style="position:absolute;margin-top:2px;margin-left:-69px" required> Buyer
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                <input type="radio" name="buyer_seller" value="both" style="position:absolute;margin-top:2px;margin-left:-69px" required> Both
                                </label>
                            </div>
                        </div>
                    </div>


                   <h2 class="title" style="margin-bottom:0;margin-top:40px">Company Details <span></span></h2><!-- /.title -->
                <hr>

                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label" style="padding-top:20px">Company</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Company" id="company_name" name="company_name" value="{{ old('company_name') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="company address" class="col-sm-3 control-label" style="padding-top:20px">Address</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Company Address"  id="address_company" name="address_company" value="{{ old('address_company') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="Desc Company" class="col-sm-3 control-label" style="padding-top:20px">Company Description</label>
                    <div class="col-sm-9">
                    <textarea class="form-control" id="desc_company" name="desc_company" placeholder="Company Description">{{ old('company_desc') }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Phone 1" class="col-sm-3 control-label" style="padding-top:40px">Phone</label>
                    <div class="col-sm-3" style="padding-top:20px">
                      <input type="number" class="form-control" placeholder="Phone Code"  id="office_phone" name="office_phone" readonly>
                    </div>
                    <div class="col-sm-6" style="padding-top:20px">
                      <input type="number" class="form-control" placeholder="Phone Number"  id="office_phone" name="office_phone" minlength="10" value="{{ old('office_phone') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="Phone 2" class="col-sm-3 control-label" style="padding-top:20px">Phone 2<span style="color:grey">(optional)</span></label>
                    <div class="col-sm-3">
                      <input type="number" class="form-control" placeholder="Phone Code"  id="office_phone2" name="office_phone2" minlength="10" readonly>
                    </div>  
                    <div class="col-sm-6">
                      <input type="number" class="form-control" placeholder="Phone Number"  id="office_phone2" name="office_phone2" value="{{ old('office_phone2') }}">
                    </div>
                </div>


                    <div class="col-sm-6" style="margin-left:280px">
                      <p class="form-group">
                          <div class="col-sm-20">
                            <img src="{{ captcha_src() }}" height="80px" alt="captcha" id="img-captcha" data-refresh-config="default">
                            <span class="glyphicon glyphicon-refresh" <input type="button" class="refresh-captcha" value="Refresh Captcha" onClick="refreshCaptcha()"></span>                           
                          </div>
                          <br>
                            <input type="text" placeholder="Enter Captcha" name="captcha" required>
                      </p>
                    </div>



                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <input type="submit" class="btn" name="signup-form-submit" id="submit-register" value="Sign up" disabled>

                    </div>
                </div>
              {{ Form::close() }}
            </div><!-- /.sign-up -->

          </div>
        </div><!-- /.row -->
        <div class="alert alert-info">
          <strong>INFORMATION</strong>
          We are pleased to inform you if you meet some trouble when register, please contact our costumer service or you can send email to pahala@pahalakita.com
        </div>
      </div><!--/.container-->
    </div><!-- /.section-padding -->
  </section><!--/.login-section-->

<script>
    var confirmPassword = function() {
        var password = $('#password').val();
        var repassword = $('#confirm-password').val();

        if (password != repassword) {
            $('#warning-password').html('Password tidak sama');
        } else {
            $('#warning-password').html('');
            $('#submit-register').prop("disabled", false);
        }
    }

    var refreshCaptcha = function () {
      console.log('hit');
      var captcha = $('#img-captcha');
      var config = captcha.data('refresh-config');
      $.ajax({
        method: 'GET',
        url: 'api/get/captcha/' + config,
      }).done(function (response) {
        captcha.prop('src', response);
      });
    };

    var getStates = function() {
      var country_id = $('#country').val();
      var urlGetState = 'api/get/state/' + country_id;
      var urlGetPhoneCode = 'api/get/phonecode/' + country_id;

      $.get(urlGetState, function(data) {
          var select = $('#states');
          select.empty();
          select.append('<option value="">Choose Your State</option>');
          $.each(data,function(key, value) {
              select.append('<option value=' + value.id + '>' + value.name + '</option>');
          });
      });

      $.get(urlGetPhoneCode, function(data) {
          $('#office_phone').val(data);
          $('#office_phone2').val(data);
          $('#cellphonecode').val(data);
          $('#cellphonecode2').val(data);
      });
    }

    var getCities = function() {
      var states_id = $('#states').val();
      var url = 'api/get/cities/' + states_id;

      $.get(url, function(data) {
          var select = $('#cities');
          select.empty();

          $.each(data,function(key, value) {
              select.append('<option value=' + value.id + '>' + value.name + '</option>');
          });
      });
    }
    
</script>

@endsection
