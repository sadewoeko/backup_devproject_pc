@extends('dashboard')
@section('content')
  <section class="page-name-sec page-name-sec-01">
      <div class="section-padding">
        <div class="container">
          <h3 class="page-title">Welcome to pahalakita.com : 
            <b>
              {{ session('gender') }}
            </b>
            {{session('full_name')}}</h3><!-- /.page-title -->

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
      <div class="section-padding" style="padding:0">
        <div class="container" style="width:1350px">
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default"> 
                    <div class="panel-heading"> 
                      <h3 class="panel-title">Buying List</h3> 
                    </div> 
                  <div class="panel-body">
                  <a href="{{ route('index') }}" class="btn semi-round btn-xs pull-left" style="width:100px;background:#fff0;border:0"><b style="padding-bottom:16px;font-size:20px;margin-top:15px;margin-right:59px;color:black" class="glyphicon glyphicon-chevron-left">home</b></a></td>
                      <a href="{{ route('dashboard.create_buying') }}" class="btn semi-round btn-xs pull-right" style="margin-right:215px;width:50px;height:50px;background:#fff0;border:0"><b style="padding-top:15px;font-size:20px;color:black" class="glyphicon glyphicon-plus">Display Product</b></a></td>
                      <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Product Category</th>
                            <th>Destination</th>
                            <th>Product Origin</th>
                            <th>Term's Of Payment</th>
                            <th>Quantity</th>
                            <th>Description</th>
                            <th>Product Image</th>
                            <th>Edit</th>
                            <th>Show</th>
                            <th>Remove</th>
                        </thead>
                        <tbody>
                          @if(count($datas) <= 0)
                            <tr>                         
                                <td colspan="8" style="text-align: center">{{ 'Not Display Product' }}</td> 
                            </tr>
                          @else
                            @php $i = ($datas->currentpage()-1) * $datas->perpage() + 1; @endphp
                            @php ($i = 0)
                            @foreach ($datas as $data)  
                            <tr>
                              <td>{{ ++$i }}</td>
                              <td>{{ isset($data->product_name) ? substr($data->product_name,0,30) : '' }}</td>
                              <td>{{ isset($data->category) ? $data->category : '' }}</td>
                              <td>{{ isset($data->destination) ? $data->destination : '' }}</td>
                              <td>{{ isset($data->product_origin) ? $data->product_origin : '' }}</td>
                              <td>{{ isset($data->pay_terms) ? $data->pay_terms : '' }}</td>
                              <td>{{ isset($data->product_stock) ? $data->product_stock : '' }}</td>
                              <td>{!! isset($data->product_desc) ? substr($data->product_desc,0,30) : '' !!}</td>
                              <td><img src="{{ asset('uploads/product/' . $data->image) }}" alt="" title="" width="80px" height="80px"></a></td>
                              <td><a href="{{ route('dashboard.edit_buy', $data->id) }}" class="btn semi-round btn-xs" style="width:50px;height:50px;background:#fff0;border:0"><b style="padding-top:15px;font-size:20px;color:black" class="glyphicon glyphicon-edit"></b></a></td>
                              <td><a href="{{ route('dashboard.productDetailBuy', $data->id) }}" class="btn semi-round btn-xs" style="width:50px;height:50px;background:#fff0;border:0"><b style="padding-top:15px;font-size:20px;color:black" class="glyphicon glyphicon-eye-open"></b></a></td>
                              <td><a href="{{ route('dashboard.delete', $data->id) }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn semi-round btn-xs" style="width:50px;height:50px;background:#fff0;border:0"><b style="padding-top:15px;font-size:20px;color:black" class="glyphicon glyphicon-trash"></b></a></td>
                            </tr>
                            @endforeach
                          @endif  
                        </tbody>
                      </table>

                      <div class="clearfix"></div>
                        
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
