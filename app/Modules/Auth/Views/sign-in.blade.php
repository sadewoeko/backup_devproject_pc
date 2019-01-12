@extends('dashboard')
@section('content')

<style>
.lg-field{
  margin-bottom:15px;
}
</style>
<section class="login-section">
    <div class="section-padding">
      <div class="container">
        <div class="row" style="margin-top : -130px">
        @if (session('authlog'))
            <div class="alert alert-danger">
              {{ session('authlog') }}
            </div>
        @endif
            <div class="col-md-5">
                <div class="sign-in bg-gray">
                    <h2 class="title">Have an account? Log in</h2>
                    

                    @if (session('error-login'))
                        <div class="alert alert-danger">
                        {{ session('error-login') }}
                        </div>
                    @endif

                    @if (session('success-reset'))
                        <div class="alert alert-success">
                        {{ session('success-reset') }}
                        </div>
                    @endif

                    {{ Form::open(array('class'=> 'sign-in-form','route' => 'auth.login','enctype' => 'multipart/form-data')) }}
                    
                    <div class="form-group">
                      <div class="col-md-12 lg-field" style="padding-left:0px;padding-right:0px">
                        <div class="input-group">
                          <div class="input-group-addon" style="width:15%">
                            <i class="fa fa-envelope"></i>
                          </div>
                            <input type="text" name="email" id="user_login" class="form-control input" style="border:solid 1px #ccc;width:345px" value="" placeholder="Email" required/>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-12 lg-field" style="padding-left:0px;padding-right:0px">
                        <div class="input-group">
                          <div class="input-group-addon" style="width:15%">
                            <i class="fa fa-lock"></i>
                          </div>
                        <input type="password" name="password" id="user_pass" class="form-control input" style="border:solid 1px #ccc;width:345px" value="" placeholder="Password" required/>
                        </div>
                      </div>
                    </div>
                    <p class="form-input">
                        <input type="submit" name="wp-submit" id="wp-submit" class="btn" value="Sign In" />
                    </p>
                    <p>Need an account? <a href="{{ route('auth.index') }}">Register / Sign up<a></p>
                    {{ Form::close() }}
                    
                    <h5><a href="{{ route('auth.forgot-password') }}">FORGOT PASSWORD?</a></h5>
                    
                </div><!-- /.sign-in -->

                
            </div>
        </div><!-- /.row -->
      </div><!--/.container-->
    </div><!-- /.section-padding -->
</section><!--/.login-section-->


@endsection