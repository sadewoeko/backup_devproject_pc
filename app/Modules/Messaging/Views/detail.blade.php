@extends('dashboard')
@section('content')
<style>
.bubble{
  display:inline;
  width:50%;
  white-space:inherit;
  text-align:left;
  padding:8px 8px 8px 8px;
  margin:8px 8px 8px 8px;
  border-radius:12.5px;
  font-size:100%;
  font-weight:700;
  color:#ffff;
  vertical-align:baseline;
}

</style>
  <section class="list-panels text-center">
      <div class="section-padding" style="margin-top: -200px">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
              {{ Form::open(array('class'=> 'messaging-form','route' => 'messaging.send','enctype' => 'multipart/form-data')) }}

                <div class="panel panel-default"> 
                    <div class="panel-heading"> 
                      <h3 class="panel-title">Inbox with <a href="{{ route('profile.index', $profile_id) }}">{{ $sender }}</a></h3>
                    </div> 

                    <!-- COMMENT -->
                    
                  <div class="panel-body">
                    <div class="form-group">
                        @if(session('id') == $sender_id)
                            <label for="sender" style="float:left;margin-top:3px">To :</label><input style="width:90%;margin-left:70px" type="text" class="form-control" name="sender" id="sender" value="{{ $sender }}" readonly>
                        @else
                            <label for="sender" style="float:left;margin-top:3px">From :</label><input style="width:90%;margin-left:70px" type="text" class="form-control" name="sender" id="sender" value="{{ $sender }}" readonly>
                        @endif
                      
                      <label for="subject" style="float:left;margin-top:3px">Subject :</label><input style="width:90%;margin-left:70px" type="text" class="form-control" name="subject" id="subject" value="{{ isset($subject) ? $subject : '' }}" 
                      @if (isset($subject))
                        readonly
                      @endif
                      >
                    </div>
                    <!-- <div class="form-group">
                      <label for="subject" style="float:left;margin-top:3px">Subject :</label><input style="width:90%;margin-left:70px;border:1px solid #ccc" type="text" class="form-control" name="subject" id="subject" value="{{ $subject }}">
                    </div> -->
                    <hr style="border-top:2px solid #cec3c3;width:100%">
                    
                      @foreach($result as $message)

                        <br><br>

                        @if($message->sender_id != session('id'))
                            <span class="bubble label-default pull-left">{{ $message->message }}</span>  <span style="font-size:12px" class="pull-right">{{ $message->created_at }}</span>
                        @else
                            <span class="bubble label-success pull-right">You: {{ $message->message }}</span> <span style="font-size:12px" class="pull-left">{{ $message->created_at }}</span>
                        @endif

                      @endforeach

                   </div>
                </div>
                @if(session('id') == $sender_id)
                  <input type="hidden" name="sender_id" value={{ $sender_id }}>
                  <input type="hidden" name="receiver_id" value={{ $receiver_id }}>
                @else
                  <input type="hidden" name="sender_id" value={{ $receiver_id }}>
                  <input type="hidden" name="receiver_id" value={{ $sender_id }}>
                @endif
                <input type="hidden" name="product_id" value={{ $product_id }}>

                    <div class="form-group">
                        <textarea class="form-control" style="border:1px solid #ccc;height:200px" name="message" placeholder="When you write a message, Please inform your: Email address, Office Phone no, Cellphone no, Full Address. That info is important, to have a good response from The Client Or Customers."></textarea> <br>
                        <input type="submit" class="form-control btn-warning" value="Send" style="height:50px">
                    </div>
                    
                </div> 
              {{ Form::close() }}
                
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
