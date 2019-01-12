@extends('dashboard')
@section('content')
<style>
.scrollable-menu {
    height: auto;
    max-height: 500px;
    overflow-x: hidden;
}
.item-title{
  font-size:12px;
}
</style>
<section class="shop-contents">
    <div class="container">
    <h2><center>--Category All--</center></h2>
        <div class="shop-products">
          <div class="row">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in text-center" id="grid">
                <div class="col-sm-12">
                  <div class="item">

                    <ul class="scrollable-menu item-content list-unstyled" style="text-align:left">

                      @foreach($categories as $category)
                      <li style="height:2px"><h5 class="item-title"><a href="{{ route('categoryProduct.detail', $category->id) }}">{{ $category->category }}</a></h5></li>
                      @endforeach
                    </ul>
                    
                  </div>
                </div>

                <!-- <div class="col-sm-6">
                  <div class="item">
                    <ul class="scrollable-menu item-content list-unstyled" style="text-align:left">
                      <li><h5 class="item-title"><a href="#">Food & Beverage,Food Ingredients,Health Food,Others</a></h5></li>
                      <li><h5 class="item-title"><a href="#">Furniture & Furnishings,Furniture Hardware,Metal Furniture,Accesories Furniture</a></h5></li>
                      <li><h5 class="item-title"><a href="#">Health & Beauty,Medicine, Health Products,Personal Care,Others</a></h5></li>
                      <li><h5 class="item-title"><a href="#">Textile & Leather, Yarn, Chemical Fabrics,Textile Products,Textile Materials</a></h5></li>
                      <li><h5 class="item-title"><a href="#">Transportation, Logistic Services,Transportation Facilities,Others</a></h5></li>
                      <li><h5 class="item-title"><a href="#">Office Supplies, Scanner, Printer, Toner & Ink Cartridge</a></h5></li>
                      <li><h5 class="item-title"><a href="#">Packaging & Paper, Packaging Materials, Bottles, Waste Paper, Others</a></h5></li>
                      <li><h5 class="item-title"><a href="#">Home Appliances, indoor & outdoor equipment, Home Accessories, Others</a></h5></li>
                      <li><h5 class="item-title"><a href="#">Industrial Supplies & Machinery,Pharmaceutical Machinery,Chemical,Industrial Supplies</a></h5></li>
                      <li><h5 class="item-title"><a href="#">Lights & Lighting, Parts Lighting, Accesories Lighting</a></h5></li>
                    </ul>
                  </div>
                </div> -->

            </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
          </div><!-- /.row -->
        </div><!-- /.shop-products -->
        </div><!-- /.container -->
    
  </section><!-- /.shop-contents -->
 @endsection