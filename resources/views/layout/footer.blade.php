<section class="subscribe-03 background-bg" style="margin-top: 50px;" data-image-src="{{ asset('assets/images/home07/footerback.jpeg') }}">
    <div class="container">
      <div class="subscribe-details">
        <div class="row">
          <div class="col-sm-5">
            <div class="section-top">
              <h3 class="section-title">Stay up to date <span></span></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

<div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-4 text-left">
            <div class="copyright">
             Pahala Kita © <a href="">Mei</a> 2018 | Jakarta - Indonesia</a>
            </div><!-- /.copyright -->
          </div>
          <div class="col-sm-3 text-left">
              <div class="widget widget_useful_links">
                <div class="widget-details">
                  <li><a href="{{ route('about') }}">About us</a></li>
                  <br>
                  <li><a href="{{ route('contact') }}">Contact us</a></li>
                  <br>
                  <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                </div><!-- /.widget-details -->
              </div><!-- /.widget -->
          </div>
          <div class="col-sm-3 text-left">
              <div class="widget widget_useful_links">
                <div class="widget-details">
                  <li><a href="{{ route('help') }}">Help!</a></li>
                  <br>
                </div><!-- /.widget-details -->
              </div><!-- /.widget -->
          </div>

          <div class="menu-social pull-right">
          <a href="https://www.facebook.com/pahalakitaaa"><i class="ti-facebook"></i></a>
          
          <!-- <a href="#"><i class="ti-youtube"></i></a> -->
        </div>
        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.footer-bottom -->
</footer>
  

<script src="{{ asset('assets/assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/assets/js/main.js') }}"></script>
<script src="{{ asset('assets/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/assets/js/jquery.matchHeight-min.js') }}"></script>  
<script src="{{ asset('assets/assets/js/bootstrap-rating.min.js') }}"></script>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
@yield('javascript')
