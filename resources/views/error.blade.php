@extends('layout.templateLogin')
@section('title')
	Error Page 
@stop
@section('content')
                <section class="body-error error-outside">
				<div class="center-error">

					<div class="error-header">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<a href="/" class="logo">
											<img src="{{asset('assets/images/telkomsel-logo.png')}}" height="54" alt="Telkomsel Merah Putih" />
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="main-error mb-xlg">
								<h2 class="error-code text-dark text-center text-weight-semibold m-none">404 <i class="fa fa-file"></i></h2>
								<p class="error-explanation text-center">We're sorry, but the page you were looking for doesn't exist.</p>
							</div>
						</div>
						<div class="col-md-4">
							<h4 class="text">Here are some useful links</h4>
							<ul class="nav nav-list primary">
								<li>
									<a href="{{ Url('/') }}"><i class="fa fa-caret-right text-dark"></i> Dashboard</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
@stop