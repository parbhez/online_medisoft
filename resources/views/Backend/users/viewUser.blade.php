@extends('Backend.app')

@section('main-content')

 <div class="card" style="margin-top: 10px; margin-left: 10px;">
              <div class="card-header bg-info">
                <h3 class="card-title  p-1 mb-1 text-white">View All Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="5%">SL NO</th>
                    <th width="10%">Name</th>
                    <th width="10%">User Name</th>
                    <th width="10%">Image</th>
                    <th width="10%">Email</th>
                    <th width="10%">Gender</th>
                    <th width="10%">Mobile Number</th>
                    <th width="10%">User Type</th>
                    <th width="10%">Address</th>
                    <th width="10%">Status</th>
                    <th width="10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(count($users) > 0)
                    @foreach($users as $key=>$user)
                  <tr>
                    <td width="5%">{{$key+1}}</td>
                    <td width="10%">{{$user->first_name}}{{$user->last_name}}</td>
                    <td width="10%">{{$user->user_name}}</td>
                    <td width="10%">
                      <img src="{{URL::to('public/images/users',$user->profile_image)}}" width="50px" height="50px" alt="Image">
                    </td>
                    <td width="10%">{{$user->email}}</td>
                    <td width="10%">{{$user->gender}}</td>
                    <td width="10%">{{$user->mobile_number}}</td>
                    <td width="10%">{{$user->user_type}}</td>
                    <td width="10%">{{$user->present_address}}</td>

                    <td>
                        <label class="btn btn-warning btn-xs" style="@if($user->status==1) display: none; @endif">
                        Inactive
                        </label>
                        <label class="btn btn-success btn-xs" style="@if($user->status==0) display: none; @endif">
                          active
                        </label>
                      </td>

                            <td>
                              <a href="javascript:;" class="btn btn-success btn-xs" style="@if($user->status == 1) display:none; @endif" onclick="updateStatus('user', 'active', {{$user->user_id}})">
                                 
                                <i class="fa fa-toggle-on" aria-hidden="true" title="Active"></i>
                              </a>
                              <a href="javascript:;" class="btn btn-warning btn-xs" style="@if($user->status == 0) display: none;@endif" onclick="updateStatus('user', 'inactive', {{$user->user_id}})">
                                 <i class="fa fa-toggle-off" aria-hidden="true" title="Inactive"></i> 
                              </a>


                              <a href="{{route('users.edit-user',$user->user_id)}}" class="btn btn-info btn-xs edit-user" id="reference_{{$user->user_id}}">
                                <i class="fa fa-edit" title="Edit"></i> 
                              </a>

                              <a href="javascript:;" class="btn btn-success btn-xs save-update-user" id="saveUpdate_{{$user->user_id}}" style="display: none;">
                                <i class="fa fa-save" title="Save"></i> 
                              </a>
                              <a href="javascript:;" class="btn btn-primary btn-xs reset" id="refresh_{{$user->user_id}}" style="display: none;">
                                <i class="fa fa-refresh fa-spin" title="Reset"></i> 
                              </a>
                              <a href="javascript:;" class="btn btn-danger btn-xs" style="@if($user->status == 2) display: none;@endif" onclick="updateStatus('user', 'delete', {{$user->user_id}})">
                                <i class="fa fa-trash" title="Delete"></i>  
                              </a>
                            </td>
                  </tr>
                  @endforeach
                  @endif
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th width="5%">SL NO</th>
                    <th width="10%">Name</th>
                    <th width="10%">User Name</th>
                    <th width="10%">Image</th>
                    <th width="10%">Email</th>
                    <th width="10%">Gender</th>
                    <th width="10%">Mobile Number</th>
                    <th width="10%">User Type</th>
                    <th width="10%">Address</th>
                    <th width="10%">Status</th>
                    <th width="10%">Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
@endsection

@section('extra-script')

<script type="text/javascript">
    function updateStatus(modelReference,action,id)
  {
      var reference = $("#reference_" + id);
      if(action == 'delete'){
        if(!confirm("Do you Want to delete ??")){
          return false;
        }
      }
      $.ajax({
        url: "update-status/"+modelReference+"/"+action+"/"+id,
        method: "GET",
        dataType: "json",
        success: function(data){
          //console.log(data);
          if(data.success == true){
            if(action == 'active'){
            reference.prev().show().prev().hide();
              reference.parent().prev().children().next().show().prev().hide();
            }else if(action == 'inactive'){
              reference.prev().hide().prev().show();
              reference.parent().prev().children().next().hide().prev().show();
            }else if(action == 'delete'){
              reference.parent().parent().hide(1000).remove();
            }
            $(".box-body-second").show();
            $(".messageBodySuccess").slideDown(1000).delay(3000).slideUp(1000).children().next().html(data.message);
          }else {
            $(".box-body-second").show();
            $(".messageBodyError").slideDown(1000).delay(3000).slideUp(1000).children().next().html(data.message);
          }
        },
        error: function(data){
            $(".box-body-second").show();
            $(".messageBodyError").slideDown(1000).delay(3000).slideUp(1000).children().next().html(data.message);
        }
      });
  }
</script>
@endsection