@extends('dashboard')
@section('content')
  <section class="page-name-sec page-name-sec-01">
      <div class="section-padding">
        <div class="container">
          <h3 class="page-title">Welcome to Pahala.com : {{session('full_name')}}</h3><!-- /.page-title -->

          <div class="row">
            <div class="col-sm-7">
              <p class="description">
                {{ $title }}
              </p>
            </div>
          </div>
        </div>
      </div>
  </section>
  <section class="list-panels text-center">
      <div class="section-padding" style="margin-top: -100px">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default"> 
                    <div class="panel-heading"> 
                      <h3 class="panel-title">Advertisement List</h3> 
                    </div> 
                  <div class="panel-body">
                  <a href="{{ route('index') }}" class="btn btn-warning green-border semi-round btn-xs pull-left">Back To Home</a></td>
                      <a href="{{ route('iklan.create_iklan') }}" class="btn btn-warning green-border semi-round btn-xs pull-right">Post New Advertisement</a></td>
                      <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Product Category</th>
                            <th>Product Price</th>
                            <th>Product Stock</th>
                            <th>Description</th>
                            <th>Product Image</th>
                            <th>Edit</th>
                            <th>Remove</th>
                        </thead>
                        <tbody>
                          @if(count($datas) <= 0)
                            <tr>                         
                                <td colspan="8" style="text-align: center">{{ 'Data Tidak Ditemukan' }}</td> 
                            </tr>
                          @else
                            @php ($i = 0)
                            @foreach ($datas as $data)  
                            <tr>
                              <td>{{ ++$i }}</td>
                              <td>{{ isset($data->product_name) ? $data->product_name : '' }}</td>
                              <td>{{ isset($data->category) ? $data->category : '' }}</td>
                              <td>{{ isset($data->product_price) ? $data->product_price : '' }}</td>
                              <td>{{ isset($data->product_stock) ? $data->product_stock : '' }}</td>
                              <td>{!! isset($data->product_desc) ? substr($data->product_desc,0,30) : '' !!}</td>
                              <td><img src="{{ asset('uploads/product/' . $data->image) }}" alt="" title="" width="80px" height="80px"></a></td>
                              <td><a href="#" class="btn btn-warning green-border semi-round btn-xs">Edit</a></td>
                              <td><a href="#" class="btn  btn-danger green-border semi-round btn-xs">Remove</a></td>
                            </tr>
                            @endforeach
                          @endif  
                        </tbody>
                      </table>

                      <div class="clearfix"></div>
                        <ul class="pagination pull-right">
                          <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                          <li class="active"><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">5</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                        </ul>
                      </div>
                   </div>
                </div>
                </div> 
              </div>
              </div>
            </div>
          </div>
      </div>
  </section>



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
