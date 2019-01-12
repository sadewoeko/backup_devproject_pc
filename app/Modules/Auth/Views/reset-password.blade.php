@extends('dashboard')
@section('content')

<section class="login-section">
    <div class="section-padding">
      <div class="container">
        <div class="row" style="margin-top : -130px">

            <div class="col-md-5">
                <div class="sign-in bg-gray">
                    <h2 class="title">Enter your E-mail</h2>

                    @if (session('success-reset'))
                        <div class="alert alert-success">
                        {{ session('success-reset') }}
                        </div>
                    @endif
                    {{ Form::open(array('class'=> 'sign-in-form','route' => 'auth.submit-reset-password','enctype' => 'multipart/form-data')) }}
                    <input type="hidden" name="token" value={{ $token }} >
                    <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Confirm-password</label>
                    <div class="col-sm-9">
                    <span id='warning-password' style="color:red;"></span>
                      <input type="password" class="form-control" placeholder="Confirm Password" id="confirm-password"  name="repassword" onKeyUp="confirmPassword()" required>
                    </div>
                    </div>
                    <p class="form-input">
                        <input type="submit" name="wp-submit" id="wp-submit" class="btn" value="Sign In" />
                    </p>
                    {{ Form::close() }}
                    
                </div><!-- /.sign-in -->

                
            </div>
        </div><!-- /.row -->
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
</script>


@endsection