@extends('dashboard')
@section('content')

<style>
.login-section input {
	border: 1px solid #e0d2a2;
    margin-bottom: 26px;
}

.login-section select {
	background: #fff;
	border: 1px solid #e0d2a2;
	border-radius: 0;
	box-shadow: none;
	color: #545454;
	font-family: 'Poppins';
	font-size: 13px;
	font-weight: 600;
	height: initial;
	margin-bottom: 20px;
	padding: 18px 15px;
	width: 100%;
}
</style>
  <section class="login-section">
    <div class="section-padding">
      <div class="container">
        <div class="row" style="margin-top : -130px">
            @if (session('failed'))
                 <div class="alert alert-danger">
                    {{ session('failed') }}
                 </div>
            @endif

            @if (session('success'))
                 <div class="alert alert-success">
                    {{ session('success') }}
                 </div>
            @endif

        {{ Form::open(array('class'=> 'sign-up-form','route' => 'dashboard.update_buy','enctype' => 'multipart/form-data')) }}
        <input type="hidden" name="id" value="{{ $content->id }}">
          <div class="col-md-12">
            <div class="sign-up">
              <h2 class="title">Edit Buying Lead </h2>
                <div class="form-group">
                    <label style="margin-top:15px" for="ProductName" class="col-sm-3 control-label">Product Name</label>
                    <div class="col-sm-9">
                        @if ($errors->has('product_name'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('product_name') }}</span>
                        @endif
                      <input type="text" class="form-control" placeholder="Product Name" id="product_name" name="product_name" value="{{ $content->product_name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label style="margin-top:15px" for="Category" class="col-sm-3 control-label">Product Category</label>
                    <div  style="margin-bottom: -43px" class="col-sm-9">
                    @if ($errors->has('category'))
                        <span id='warning-password' style="color:red;">{{ $errors->first('category') }}</span>
                    @endif
                    <select name="product_category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"  
                            @php
                                if ($category->id  == $content->product_category) {
                                echo "selected";
                                }
                            @endphp
                            >
                            {{ $category->category }}
                            </option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="form-group">
                    <label style="margin-top:102px;margin-left:-1110px" for="Stock" class="col-sm-3 control-label">Destination</label>
                    <div class="col-sm-9" style="margin-top:50px">
                    @if ($errors->has('destination'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('destination') }}</span>
                    @endif
                        <input type="text" class="form-control" placeholder="Destination" id="destination" name="destination" value="{{ $content->destination }}">
                    </div>
                </div>

                <div class="form-group">
                    <label style="margin-top:15px" for="Stock" class="col-sm-3 control-label">Product's Origin</label>
                    <div class="col-sm-9">
                    @if ($errors->has('origin'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('origin') }}</span>
                    @endif
                        <input type="text" class="form-control" placeholder="Product's Origin" id="product_origin" name="product_origin" value="{{ $content->product_origin }}">
                    </div>
                </div>

                <div class="form-group">
                    <label style="margin-top:15px" for="Stock" class="col-sm-3 control-label">Term's of Payment</label>
                    <div class="col-sm-9">
                    @if ($errors->has('pay_terms'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('pay_terms') }}</span>
                    @endif
                        <input type="text" class="form-control" placeholder="Term's of Payment" id="pay_terms" name="pay_terms" value="{{ $content->pay_terms }}">
                    </div>
                </div>

                <div class="form-group">
                    <label style="margin-top:15px" for="Stock" class="col-sm-3 control-label">Quantity</label>
                    <div class="col-sm-9">
                    @if ($errors->has('product_stock'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('product_stock') }}</span>
                    @endif
                      <input type="text" class="form-control" placeholder="Enought For LCL Basis, FCL Basis" id="product_stock" name="product_stock" value="{{ $content->product_stock }}">
                    </div>
                </div>

                <div class="form-group">
                    <label style="margin-top:15px" for="Desc" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                    @if ($errors->has('product_desc'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('product_desc') }}</span>
                    @endif
                      <textarea class="form-control" id="product_desc" name="product_desc">
                      {{ $content->product_desc }}
                      </textarea>
                      <p style="color:red">*Shift+Enter for new paragraphs</p>
                    </div>
                </div>
                
                <div class="form-group">
                    <label style="margin-top:47px" for="upload_image" class="col-sm-3 control-label">Upload your image</label>
                    <div class="col-sm-9" style="margin-top:30px">
                        @if (session('error-img'))
                            <div class="alert alert-danger">
                                {{ session('error-img') }}
                            </div>
                        @endif
                        <input type='file' id="inputFile" name="image" />
                            <p>File extension should be .jpg, .png. Less than 500kb</p>
                        <img id="image_upload_preview" src="{{ asset('uploads/product/' . $content->image) }}" alt="your image" />
                            <p style="color:#f00">*Please click choose file again to replace new image photo</p>
                            <hr>
                            <p style="color:#f00">*if it fails to complete The New Selling Lead Form, immediately send an email to : pahala@pahalakita.com
                            please specify details of your contacts,  then we will call your contact to help</p>
                    </div>
                </div>
               <br><br>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3" style="margin-top:50px">
                        <input type="submit" class="btn" name="signup-form-submit" id="submit-register" value="update">
                    </div>
                </div>
              {{ Form::close() }}
            </div><!-- /.sign-up -->
          </div>
        </div><!-- /.row -->
      </div><!--/.container-->
    </div><!-- /.section-padding -->
  </section><!--/.login-section-->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> 
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

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugin: 'link code',
    });
</script>

@endsection
