@extends('dashboard')
@section('content')


<style>
.input-group .form-control:last-child, .input-group-addon:last-child, .input-group-btn:first-child > .btn-group:not(:first-child) > .btn, .input-group-btn:first-child > .btn:not(:first-child), .input-group-btn:last-child > .btn, .input-group-btn:last-child > .btn-group > .btn, .input-group-btn:last-child > .dropdown-toggle{
  border: solid 1px #eee;
}
</style>
  <section class="list-panels text-center">

  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default"> 
          <div class="panel-heading"> 
            <h3 class="panel-title">Edit Your Profile</h3> 
          </div> 
          <br>
          
            
            {{ Form::open(array('class'=> 'form-horizontal','route' => 'profile.update','enctype' => 'multipart/form-data')) }}
            <input type="hidden" name="id" value="{{ $result[0]->id }}">
                    <div class="form-group">
                      <div class="col-md-12" align="center">
                        <div class="input-group">
                          
                            <img id="image_upload_preview" src="http://placehold.it/200x200" alt="your image" style="width:200px;height:200px;margin-left:84px"/>
                            <input type='file' id="inputFile" name="image" />
                            <p class="help-block">File extension should be .jpg, .jpeg, .png. Less than 3Mb</p>
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

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="email">Email</label>  
                        <div class="col-md-4">
                          <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-envelope-o"></i>
                              </div>
                                <input id="email" name="email" type="text" value="{{ $result[0]->email }}" class="form-control input-md"  >
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
                              <input id="Phone number " name="cellphone" type="text" value="{{ ($result[0]->cellphone != NULL) ? $result[0]->cellphone : '' }}" class="form-control input-md"  >                       
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
                          <textarea class="form-control" rows="5"  id="Overview (max 200 words)" name="address"  >{{ ($result[0]->address != NULL) ? $result[0]->address : '' }}</textarea>
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
                              <input id="company" name="company" type="text" value="{{ $result[0]->company }}" class="form-control input-md"  >
                          </div>                                  
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Overview (max 200 words)">Address</label>
                        <div class="col-md-4">                     
                          <textarea class="form-control" rows="5"  id="Overview (max 200 words)" name="address"  >{{ ($result[0]->address != NULL) ? $result[0]->address : '' }}</textarea>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Phone number ">Phone</label>  
                        <div class="col-md-4">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-phone"></i>
                            </div>
                              <input id="Phone number " name="phone" type="text" value="{{ ($result[0]->phone != NULL) ? $result[0]->phone : '' }}" class="form-control input-md"  >                       
                          </div>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Phone number">Phone 2</label>  
                      <div class="col-md-4">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                          </div>
                              <input id="Phone number" name="phone2" type="text" value="{{ ($result[0]->phone2 != NULL) ? $result[0]->phone2 : '' }}" class="form-control input-md"  >
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
          </div> 
        </div>
      </div>
    </div>
  </section>

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

@endsection