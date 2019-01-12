@extends('dashboard')
@section('content')

<hr>
<section class="shop-contents">
    <div class="section">
      <div class="container">
        <div class="row">
        <h2><center>--Products--</center></h2>
          <div class="col-md-13 pull-center">
            <div class="row">
              <div class="product-filter">
                <div class="col-md-4">
                  <span class="filter-text">Showing product</span>
                </div>

                <div class="col-md-8 text-right">
                  <div class="show-item">
                    <span class="filter-title">Show:</span>
                    <select id="item-number" data-select-like-alignement="never" class="item-number drop-select">
                      <option value="">12</option>
                      <option value="2">16</option>
                      <option value="3">20</option>
                      <option value="4">24</option>
                    </select>
                  </div>

                  <div class="filter-view">
                    <span class="filter-title">View:</span>
                    <ul role="tablist">
                      <li class="grid-view active" id="grid-top"><a href="#grid" role="tab" data-toggle="tab"><i class="fa fa-th-large"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="shop-products">
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in text-center" id="grid">
                
                <div role="tabpanel" class="tab-pane fade active in text-left" id="list">
                      <div class="item media">
                        <div class="item-thumbnail media-left">
                          <img src="#" height="200px" weight="200px" alt="Item Thumbnail">
                          
                        </div><!-- /.item-image -->

                        <div class="item-content media-body">
                          <h3 class="item-title">deskrip</h3><!-- /.item-title -->

                          <div class="item-price">
                            <div class="current-price"><span class="currency">idr</span><span class="price">product price</span></div><!-- /.current-price -->
                          </div><!-- /.item-price -->

                          <p class="description">
                          data desc detail 
                          </p><!-- /.description -->

                          <div class="item-bottom">
                            <div class="buttons">
                              <button class="contact">Contact Now  <i class="fa fa-envelope"></i></button>
                              <button class="text">company</button>
                              <button class="text">users</button>
                            </div><!-- /.buttons -->
                          </div><!-- /.item-bottom -->
                        </div><!-- /.item-details -->
                      </div><!-- /.item -->
                </div>
                  
                  



                </div>

                <div role="tabpanel" class="tab-pane fade active in text-left" id="list">
                  
                </div><!-- /.tab-pane -->
              </div><!-- /.tab-content -->
            </div><!-- /.shop-products -->
            
            
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection            
