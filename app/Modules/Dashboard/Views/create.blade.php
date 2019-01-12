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
    
    .mce-menu{
        position: fixed;
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

        {{ Form::open(array('class'=> 'sign-up-form','route' => 'dashboard.storeSelling','enctype' => 'multipart/form-data')) }}
            {{-- <div class="col-md-5">
                <div class="sign-in bg-gray">
                    <h3 class="title">Upload Your Product Image</h3>
                    @if (session('error-img'))
                        <div class="alert alert-danger">
                            {{ session('error-img') }}
                        </div>
                    @endif
                    <input type='file' id="inputFile" name="upload_image" />
                        <p>File extension should be .jpg, .png. Less than 500kb</p>
                    <img id="image_upload_preview" src="http://placehold.it/300x300" alt="your image" />
                        <p style="color:#f00">*Please click choose file again to replace new image photo</p>
                        <hr>
                        <p style="color:#f00">*if it fails to complete The New Selling Lead Form, immediately send an email to : pahala@pahalakita.com
                        please specify details of your contacts,  then we will call your contact to help</p>
                </div><!-- /.sign-in -->
            </div> --}}
          <div class="col-md-12">
            <div class="sign-up">
              <h2 class="title">Add New Selling Lead </h2>
                <div class="form-group">
                    <label style="margin-top:15px" for="ProductName" class="col-sm-3 control-label">Product Name</label>
                    <div class="col-sm-9">
                        @if ($errors->has('product_name'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('product_name') }}</span>
                        @endif
                      <input type="text" class="form-control" placeholder="Product Name" id="product_name" name="product_name" value="{{ old('product_name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label style="margin-top:15px" for="Category" class="col-sm-3 control-label">Product Category</label>
                    <div  style="margin-bottom: -43px" class="col-sm-9">
                    @if ($errors->has('category'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('category') }}</span>
                    @endif
                    {{ Form::select('category', ([''=>''] + \Models\category::pluck('category', 'id')->all()), null, array('class'=>'form-control', 'id'=>'category')) }}<br><br>
                    </div>
                </div>
                <div class="form-group">
                    <label style="margin-top:15px" for="Price" class="col-sm-3 control-label">Product Price</label>
                    <div style="width:25%" class="col-sm-2">
                    <select class="form-control" name="currency">
                        <option value="0">Currencies</option>
                        @foreach($currency as $val)
                        <option value="{{ $val->code }}">{{ $val->code }}</option> <!-- put actual attribute here... -->
                        @endforeach
                    </select>
                    </div>
                    <div class="col-sm-6">
                    @if ($errors->has('product_price'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('product_price') }}</span>
                    @endif
                      <input type="text" class="form-control" placeholder="INFOB, CNF Basis, Loco Warehouse, Franco Customer" id="product_price" name="product_price" value="{{ old('product_price') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label style="margin-top:15px" for="payment" class="col-sm-3 control-label">Payment</label>
                    <div class="col-sm-9">
                    @if ($errors->has('payment'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('payment') }}</span>
                    @endif
                      <input type="text" class="form-control" placeholder="Cash, T/T, L/C, Credits" id="payment" name="payment" value="{{ old('payment') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label style="margin-top:15px" for="packaging" class="col-sm-3 control-label">Packaging</label>
                    <div class="col-sm-9">
                    @if ($errors->has('packaging'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('packaging') }}</span>
                    @endif
                      <input type="text" class="form-control" placeholder="Bags, Drums, IsoTank, Flexi Bag" id="packaging" name="packaging" value="{{ old('packaging') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label style="margin-top:15px" for="packaging" class="col-sm-3 control-label">Delivery</label>
                    <div class="col-sm-9">
                    @if ($errors->has('packaging'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('delivery') }}</span>
                    @endif
                      <input type="text" class="form-control" placeholder="Soonest, 1 Wekk After Payment" id="delivery" name="delivery" value="{{ old('delivery') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label style="margin-top:15px" for="Stock" class="col-sm-3 control-label">Product Stock</label>
                    <div class="col-sm-9">
                    @if ($errors->has('product_stock'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('product_stock') }}</span>
                    @endif
                      <input type="text" class="form-control" placeholder="Enought For LCL Basis, FCL Basis" id="product_stock" name="product_stock" value="{{ old('product_stock') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label style="margin-top:15px" for="Desc" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                    @if ($errors->has('product_desc'))
                            <span id='warning-password' style="color:red;">{{ $errors->first('product_desc') }}</span>
                    @endif
                      <textarea rows="4" cols="25" class="form-control" placeholder="Must write Email Address, Cellphone No, Country, Yourname" id="product_desc" name="product_desc">{{ old('product_desc') }}</textarea>
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
                        <input type='file' id="inputFile" name="upload_image" />
                            <p>File extension should be .jpg, .png. Less than 500kb</p>
                        <img id="image_upload_preview" src="http://placehold.it/300x300" alt="your image" />
                            <p style="color:#f00">*Please click choose file again to replace new image photo</p>
                            <hr>
                            <p style="color:#f00">*if it fails to complete The New Selling Lead Form, immediately send an email to : pahala@pahalakita.com
                            please specify details of your contacts,  then we will call your contact to help</p>
                    </div>
                </div>
               <br><br>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-3" style="margin-top:50px;margin-left:0px">
                        <input type="submit" class="btn" name="signup-form-submit" id="submit-register" value="Post">
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
