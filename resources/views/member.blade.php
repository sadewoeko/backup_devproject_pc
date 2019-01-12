@extends('dashboard')
@section('content')
<style>
.vip{
	margin-right: -324px;
    margin-left: 123px;
}

</style>
<section class="page-name-sec page-name-sec-01">
		<div class="section-padding">
			<div class="container">
				<h3 class="page-title">Membership</h3><!-- /.page-title -->

				<div class="row">
					<div class="col-sm-6">
						<p class="description">
                            Join our membership to get more features 
						</p><!-- /.description -->
					</div>
				</div><!-- /.row -->
			</div><!-- /.container -->
		</div><!-- /.section-padding -->
	</section><!-- /.page-name-sec -->


	<section class="pricing-table text-center">
		<div class="pricing-table-1">
			<div class="section-padding" style="padding:20px">
				<div class="container">
					<div class="row vip">						
						<div style="width:22%" class="col-md-3">
							<div class="item" style="border: 1px solid black">
								<div class="item-top" style="background:black">
									<h3 class="item-title">Free Member</h3><!-- /.item-title -->
									<div class="item-price">
										<span class="price">FREE</span>
									</div><!-- /.item-price -->
									<div class="top-bottom"></div><!-- /.top-botom -->
								</div><!-- /.item-top -->
								<div class="item-middle" style="height: 348px">
									<span>Find goods : 10 Products perday</span>
									<span>Never audited by our admin</span>
									<span>Limited time only 1 years</span>
									<span>Can not used advertising services</span>
									<span>Very seldom recommended by other members</span>
									<span>Profile member less known</span>
								</div><!-- /.item-middle -->
								<div class="item-bottom" style="border-color: black">
									<a href="#" class="btn" style="background:black">..</a>
								</div><!-- /.item-bottom -->
							</div><!-- /.item -->
						</div>
						
						<div style="width:22%" class="col-md-3">
							<div class="item active" style="border: 1px solid #e0d2a2">
								<div class="item-top">
									<h3 class="item-title">Paid Member</h3><!-- /.item-title -->
									<div class="item-price">
										<span class="currency">$</span>
										<span class="price">300</span>
										<span class="duration">Year</span>
									</div><!-- /.item-price -->
									<div class="top-bottom"></div><!-- /.top-botom -->
								</div><!-- /.item-top -->
								<div class="item-middle" style="height: 348px">
									<span>Display 100 Product</span>
									<span>Find goods 100 Products</span>
								</div><!-- /.item-middle -->
								<div class="item-bottom">
									<a href="#" class="btn">Order</a>
								</div><!-- /.item-bottom -->
							</div><!-- /.item -->
                        </div>
                        
                        <div style="width:22%" class="col-md-3">
							<div class="item" style="border: 1px solid #d4d6d9">
								<div class="item-top" style="background:#aeaeae66">
									<h3 class="item-title">Advertisement</h3><!-- /.item-title -->
									<div class="item-price">
                                        <span class="currency">$</span>
										<span class="price">300</span>
										<span class="duration">Year</span>
									</div><!-- /.item-price -->
									<div class="top-bottom"></div><!-- /.top-botom -->
								</div><!-- /.item-top -->
								<div class="item-middle" style="height: 348px">
									<span>Display products in front page</span>
									<span>1 Products For 1 Year</span>
								</div><!-- /.item-middle -->
								<div class="item-bottom" style="border-color: #d4d6d9">
									<a href="#" class="btn" style="background:#d4d6d9;color:black">Order</a>
								</div><!-- /.item-bottom -->
							</div><!-- /.item -->
						</div>
                        						
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.section-padding -->
		</div><!-- /.pricing-->
	</section>



@endsection