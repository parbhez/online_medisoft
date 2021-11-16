@extends('Backend.app')

@section('main-content')
				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
						<!-- SELECT2 EXAMPLE -->
						<div class="card card-default" style="margin-top: 10px;">
							<div class="card-header bg-info">
								<h3 class="card-title p-1 mb-1 text-white">Add User</h3>
								 <div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
									</button>
									<button type="button" class="btn btn-tool" data-card-widget="remove">
									<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<!-- /.card-header -->
							<form action="{{route('users.save-user.post')}}" method="POST" id="myForm" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="card-body">


									
									
										
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="exampleInputEmail1">First Name</label>
														<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" >
													</div>
													<div class="form-group">
														<label for="exampleInputPassword1">User Name</label>
														<input type="text" class="form-control" id="exampleInputPassword1" name="user_name" placeholder="Enter User Name">
														@error('user_name')
                            							<span class="text-danger">{{$message}}</span>
                  										@enderror
													</div>
													<div class="form-group">
														<label for="exampleInputPassword1">DOB</label>
														<input type="date" class="form-control" id="dob" name="dob" placeholder="Enter DOB">
													</div>
													<div class="form-group">
														<label for="exampleInputPassword1">Email</label>
														<input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
														@error('email')
                            							<span class="text-danger">{{$message}}</span>
                  										@enderror
													</div>
													<div class="form-group">
														<label for="exampleInputPassword1">Confirmed Password</label>
														<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirmed Password">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="exampleInputEmail1">Last Name</label>
														<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
													</div>
													<div class="form-group">
														<label for="exampleInputEmail1">Gender</label>
														<select class="form-control select2" style="width: 100%;" name="gender">
															<option selected="" disabled="" value="">Please Select a Gender</option>
															<option value="male">Male</option>
															<option value="female">Female</option>
															<option value="others">Others</option>
														</select>
													</div>
													<div class="form-group">
														<label for="exampleInputEmail1">Mobile Number</label>
														<input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number">
													</div>
													<div class="form-group">
														<label for="exampleInputPassword1">Password</label>
														<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter Password">
													</div>
													<div class="form-group">
														<label>User Type</label>
														<select class="form-control select2" style="width: 100%;" name="user_type">
															<option selected="" disabled="" value="">Please Select a Group</option>
															<option value="Super Admin">Super Admin</option>
															<option value="Admin">Admin</option>
															<option value="Co-Admin">Co-Admin</option>
														</select>
														
													</div>
												</div>
												<!-- /.col -->
											</div>

										

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="exampleInputEmail1">Present Address</label>
														<textarea class="form-control" name="present_address" id="present_address"placeholder="Enter Present Address"></textarea>
													</div>
													
													<div class="form-group">
														<label for="exampleInputFile">Profile Image</label>
														<div class="input-group">
															<div class="custom-file">
																<input type="file" class="custom-file-input" id="exampleInputFile" name="profile_image">
																<label class="custom-file-label" for="exampleInputFile">Choose file</label>
															</div>
															<div class="input-group-append">
																<span class="input-group-text">Upload</span>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label for="exampleInputEmail1">Permanent Address</label>
														<textarea class="form-control" name="permanent_address" id="permanent_address" placeholder="Enter Permanent Address"></textarea>
													</div>	
												</div>
												<!-- /.col -->
											</div>
											
											<div class="row justify-content-center">
  											<button type="submit" class="btn btn-success btn-sm btn-block">Submit</button>
											</div>
									
									</div>
								</form>
								</div>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- /.content -->
@endsection


@section('extra-script')
<script>
$(function () {
  $('#myForm').validate({
    rules: {
      first_name: {
        required: true,
        
      },
      last_name: {
        required: true,
        
      },

      user_name: {
        required: true,
        
      },

      gender: {
        required: true,
        
      },
      dob: {
        required: true,
        
      },
      mobile_number: {
        required: true,
        
      },
       email: {
        required: true,
        
      },

       password: {
        required: true,
        minlength: 8
      },
      confirm_password: {
        required: true,
        equalTo: '#password'
      },

      user_type: {
        required: true,
        
      },
      present_address: {
        required: true,
        
      },
    },
    messages: {
      first_name: {
        required: "Please enter a your First Name",
      },
      last_name: {
        required: "Please enter a your Last Name",
      },
      user_name: {
        required: "Please enter a your User Name",
      },

      gender: {
        required: "Please Select Gender",
      },
       dob: {
        required: "Please Select Date Of Birth",
      },
      mobile_number: {
        required: "Please enter a your Mobile Number",
      },
      email: {
        required: "Please enter a your Email",
      },
      
     password: {
        required: "Please enter your Password",
        minlength: "Your password must be at least 8 characters or Numbers"
        
      },
      confirm_password: {
        required: "Please enter again confirmed password",
        equalTo: "Confirm password does not match !!"
      },

      user_type: {
        required: "Please Select User Type",
      },
      present_address: {
        required: "Please enter a your Present Addres",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

@endsection

