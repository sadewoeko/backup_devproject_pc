<style>
  .menu-form select {
    font-size: 15px;
    padding: 2px;
    width: 120px;
  }
  .menu-form fieldset {
    background-color: #fff0
  }
  .form-control {
    height: 29px;
  }
</style>
<header id="masthead" class="masthead">

    <div class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-sm-5 top-left text-left">
            <p class="top-contact" style="color:#000000;margin-top:17px">
              <i class="ti-email"></i><span style="text-transform:lowercase">pahala@pahalakita.com</span>
              <i class="ti-mobile"></i><span>(+6221) 22845196</span>
            </p><!-- /.top-contact -->

          </div><!-- /.top-left -->

          <div class="col-sm-7 top-right text-right">
            
            @if (session('full_name'))
            <div id="user_nav" class="language dropdown" style="padding-right:0px">
             <i class="glyphicon glyphicon-user"></i> <a href="{{ route('profile.index', session('id')) }}" class="current-title">{{ session('full_name') }} <span class="label label-danger" id="alert-new-messages-profile"></span> </a>
              <ul style="min-width:200px;margin-left:35px" class="unsorted-list">
                <li><a href="{{ route('messaging.index') }}"><i class="glyphicon glyphicon-envelope"></i> Inbox<span class="label label-danger" id="alert-new-messages"></span></a></li>
                <li><a href="{{ route('profile.index',session('id')) }}"><i class="glyphicon glyphicon-user"></i> Profile</li>
                <li><a href="{{ route('member') }}"><i class="glyphicon glyphicon-usd"></i> Membership</li>
                <li><a href="{{ route('auth.logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li> 
              </ul>
            </div>
            @endif
            @if (!session('full_name'))
              <li class="menu-item"><b><a href="{{ route('auth.index') }}">Register / Sign Up</a></b></li>
              <li class="menu-item">|| <b><a href="{{ route('auth.sign-in') }}">SIGN IN</a></b></li>
            @endif

             <span>||</span>

            <div id="language" class="language dropdown">
              <a class="current-title">English</a>
            </div>

            {{--  <div id="faq" class="faq">
              || <b><a href="{{ route('help') }}" class="current-title">Help</a> || </b>
            </div>
            <div id="user_nav" class="language">
              <i class="glyphicon glyphicon-flag"></i> <a href="#" class="current-title">English <span class="label label-danger" id="alert-new-messages-profile"></span></a>
            </div>  --}}
            
          </div>
        </div>
      </div>
    </div>



    <div class="header-middle">
      <div class="container"  style="height:18%">
        <div class="row" style="margin-bottom:30px">
          <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="height:25%">
            <a class="navbar-brand hidden-xs" href="{{ route('index') }}"><img class="img img-responsive" src="{{ asset('assets/images/logopahala.png') }}" style="position:absolute;top:20px;left:0;width:250px" alt="Pahala Kita"></a>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7" style="height:25%">
            <div class="top-search-form">
              {!! Form::open(array('route' => 'search', 'class'=>'menu-form', 'method' => 'GET')) !!}
                <fieldset> 
                  <select class="form-control" name="flag" id="category">
                    <option selected="selected" value="all">All</option>
                    <option value="sell">Sell</option>
                    <option value="buy">Buy</option>
                    <option value="company">Company</option>
                    <option value="name">Country</option>
                  </select>
                </fieldset>
                {!! Form::text('keyword', null,
                           array('required',
                                'class'=>'form-control',
                                'style'=>'height:30px;position:absolute;margin-top:-30px;margin-left:120px;font-size:16px;background-color:#fff0',
                                'placeholder'=>'What are you looking for? ...')) !!}
                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
              {!! Form::close() !!}
  
            </div>
          </div>
          <!-- ShopChart -->
        </div>
      </div>
    </div>
                  
    <div class="header-bottom">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
            <i class="fa fa-bars"></i>
          </button>
          
        </div>

        <nav id="main-menu" class="menu collapse navbar-collapse pull-left">
          <ul class="nav navbar-nav">

          <li class="menu-item menu-item-has-children active">
              <a href="#cat" class="btn" style="padding-bottom:64px">Category</a>
              <ul class="sub-menu children" id="list-categories">
                
                <li class="menu-item"><a href="{{ route('show_category') }}">View More</li>
              </ul>
            </li>
          
          

            <li class="menu-item menu-item-has-children">
              <a href="#" class="btn" style="padding-bottom:64px">For Buyers</a>
              <ul class="sub-menu children">
              <li class="menu-item"><a href="{{ route('dashboard.buy-dash') }}">Post New Buying</a></li>
                <li class="menu-item"><a href="{{ route('product_all', 'buy') }}">All Buying Products</a></li>
              </ul>
            </li>

            <li class="menu-item menu-item-has-children">
              <a href="#" class="btn" style="padding-bottom:64px">For Sellers</a>
              <ul class="sub-menu children">
              <li class="menu-item"><a href="{{ route('dashboard.sell-dash') }}">Post New Selling</a></li>
                <li class="menu-item"><a href="{{ route('product_all', 'sell') }}">All Selling Products</a></li>
              </ul>
            </li>

            <li class="menu-item menu-item-has-children">
              <a href="#" class="btn" style="padding-bottom:64px">Filter By Country</a>
              <ul class="sub-menu children">
                <li class="menu-item">
                  {!! Form::open(array('route' => 'index.filter', 'method' => 'GET')) !!}
                      <input type="text" class="form-control" style="border:solid" id="fetch-country" onKeyUp="fetchCountry()">
                      <div id="list-countries"></div>
                  {!! Form::close() !!}
                </li>
              </ul>
            </li>

            <!-- <li class="menu-item menu-item-has-children">
              <a href="#">Iklan</a>
              <ul class="sub-menu children">
                <li class="menu-item"><a href="{{ route('iklan.iklan_dash') }}">Post New iklan</a></li>
              </ul>
            </li> -->
            
          </ul>
        </nav>
      </div>
    </div>
  </header>
  <br><br>

@if(isset($flag) && $flag != null)
  <div id="data-flag" data-field-id="{{$flag}}" ></div>
@endif

@if (session('id'))
  <div id="data-flag-session" data-field-id="{{ session('id') }}" ></div>
@endif

  <script>
      $(".nav a").on("click", function(){
        $(".nav").find(".active").removeClass("active");
        $(this).parent().addClass("active");
      });

      $( window ).load(function() {
        var sessionID = $('#data-flag-session').data("field-id");

        var urlFetchCheckNewMessages = 'api/check/new/messages/' + sessionID;
        var urlGetCategories = 'api/get/categories/4';
        
        
        $.get(urlFetchCheckNewMessages, function(data) {
          var spanProfile = $('#alert-new-messages-profile');
          spanProfile.empty();
          var span = $('#alert-new-messages');
          span.empty();
          if (data[0].new_messages!= 0) {
            spanProfile.text(data[0].new_messages);
            span.text(data[0].new_messages);
          }
        });

        $.get(urlGetCategories, function(data) {
          $.each(data, function(propName, propVal) {
            console.log(propVal['category']);
            $("#list-categories").prepend('<li><a href=""><span class="tab">' + propVal['category'] + '</span></a></li>');
          });
        });

      });

      var fetchCountry = function() {
        var keyword = $("#fetch-country").val();
        var host = window.location.hostname;
        var urlFetchCountries = '/api/get/countries/' + keyword;
        var dataFlag = $('#data-flag').data("field-id");

        $.get(urlFetchCountries, function(data) {
          var divList = $('#list-countries');
          divList.empty();

          $.each(data, function(key, value) {
              if (dataFlag !== undefined) {
                divList.append('<a href=/filter/' + dataFlag + '/' + value.id + '>' + value.name + '</a>');
              } else {
                divList.append('<a href=/filter/all/' + value.id + '>' + value.name + '</a>');
              }
          });
        });
      }

  </script>
