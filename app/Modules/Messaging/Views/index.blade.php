@extends('dashboard')
@section('content')
<div class="page-name-sec page-name-sec-01 section-padding" style="margin-bottom:11px;padding:80px 0">
  <div class="container">
    <h3 class="page-title">inbox</h3><!-- /.page-title -->

    <div class="row">
      <div class="col-sm-7">
        <p class="description">
                         
        </p><!-- /.description -->
      </div>
    </div><!-- /.row -->
  </div><!-- /.container -->
</div><!-- /.section-padding -->

  <section class="list-panels text-center">
      <div class="section-padding" style="padding:0">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default"> 
                    <div class="panel-heading"> 
                      <h3 class="panel-title">Messages</h3> 
                    </div> 
                  <div class="panel-body">
                      <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>From</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>View</th>
                            <th>Remove</th>
                        </thead>
                        <tbody>
                          @if(count($datas) <= 0)
                            <tr>                         
                                <td colspan="8" style="text-align: center">{{ 'No Inbox Today' }}</td> 
                            </tr>
                          @else
                            @php ($i = 0)
                            @foreach ($datas as $data)  
                            <tr>
                              <td>{{ isset($data->full_name) ? $data->full_name : '' }}</td>
                              <td>{{ isset($data->full_name) ? $data->subject : '' }}</td>
                              <td>
                                    {{ isset($data->message) ? substr($data->message, 0, 30) . '...' : '' }}
                                    @if($data->baca == 0)
                                        <span class="label label-danger">New</span>
                                    @endif
                              </td>
                              <td>{{ isset($data->created_at) ? $data->created_at : '' }}</td>
                              <td><a href="{{ route('messaging.detail', [$data->sender, $data->receiver, $data->catalogue_id]) }}"  class="btn semi-round btn-xs" style="width:50px;height:50px;background:#fff0;border:0"><b style="padding-top:15px;font-size:20px;color:black" class="glyphicon glyphicon-eye-open"></b></a></td>
                              <td><a href="{{ route('messaging.delete_message', $data->idm) }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn semi-round btn-xs" style="width:50px;height:50px;background:#fff0;border:0"><b style="padding-top:15px;font-size:20px;color:black" class="glyphicon glyphicon-trash"></b></a><td>
                            </tr>
                            @endforeach
                          @endif  
                        </tbody>
                      </table>

                   </div>
                </div>
                </div> 
              </div>
              </div>
            </div>
          </div>
      </div>
  </section>


<!-- section('javascript') 
  <script src=" asset('assets/assets/datatable/jquery-1.12.4.js') }}"></script> 
  <script src=" asset('assets/assets/datatable/jquery.dataTables.min.js') }}"></script>
  <script src=" asset('assets/assets/datatable/dataTables.bootstrap.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
endsection -->

@endsection
