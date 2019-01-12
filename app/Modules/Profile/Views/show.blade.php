@extends('dashboard')
@section('content')

          <section class="page-name-sec page-name-sec-01">
              <div class="section-padding">
                <div class="container">
                  <h3 class="page-title">{{ $result[0]->company_name }}</h3><!-- /.page-title -->

                  <div class="row">
                    <div class="col-sm-7">
                      <p class="description">
                         
                      </p><!-- /.description -->
                    </div>
 
                    <div class="col-sm-5">
                      <ol class="breadcrumb text-right">
                        <li><a href="{{ route('profile.index', $result[0]->id) }}">Company Profile</a></li>
                        <li class="active">Products</li>
                      </ol><!-- /.breadcrumb -->
                    </div>

                  </div><!-- /.row -->
                </div><!-- /.container -->
              </div><!-- /.section-padding -->
            </section><!-- /.page-name-sec -->
            <section class="list-panels text-center">
          <br>

        <section class="shop-contents">
          
            <div class="container">
              <div class="shop-products">
                <div class="row">
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in text-center" id="grid">
                    @foreach($products as $product)
                      <div class="col-sm-3">
                        <div class="item">
                          <div class="item-thumbnail">
                            
                              <img src="{{ asset('uploads/product/' . $product->image) }}" height="200px" weight="200px" alt="Item Thumbnail">
                            
                            @if($product->flag == 0)
                              <span class="ribbon sale" style="background: #e32636; !important;">Sell</span>
                            @else
                              <span class="ribbon sale" style="background: #53da37; !important;">Buy</span>
                            @endif  
                          </div><!-- /.item-thumbnail -->

                          <div class="item-content">
                            <h3 class="item-title">
                                {{ link_to_route('productDetail.detail', $product->product_name, array($product->id), array('class' => 'green')) }}
                            </h3><!-- /.item-title -->
                          </div><!-- /.item-content -->
                        </div><!-- /.item -->
                      </div>
                      @endforeach
                    </div><!-- /.tab-pane -->
                  </div><!-- /.tab-content -->
                </div><!-- /.row -->
            </div><!-- /.shop-products -->
          </div>
        
      </div>



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

@endsection
