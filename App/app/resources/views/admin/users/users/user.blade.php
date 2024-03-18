@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ url('/') }}/admin"><i class="f-16 fa fa-home"></i></a></li>
					<li class="breadcrumb-item"><a href="{{ url('/') }}/admin/users-and-permissions">Users & Permissions</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/') }}/admin/users-and-permissions/users">{{$PageTitle}}</a></li>
					<li class="breadcrumb-item">@if($isEdit) Update @else Create @endif</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid mt-40">
	<div class="row d-flex justify-content-center">
		<div class="col-sm-7">
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header text-center">
							<div class="form-row align-items-center">
								<div class="col-md-4">	</div>
								<div class="col-md-4 my-2">
									<h5>{{$PageTitle}}</h5>
								</div>
								<div class="col-md-4 my-2 text-right text-md-right"></div>
							</div>
						</div>
						<div class="card-body">
                            <div class="row  d-flex justify-content-center">
                                <div class="col-sm-4">
                                    <input type="file" id="txtProfileImage" class="dropify" data-max-file-size="{{$Settings['upload-limit']}}" data-default-file="<?php if($isEdit==true){if($EditData[0]->ProfileImage !=""){ echo url('/')."/".$EditData[0]->ProfileImage;}}?>"  data-allowed-file-extensions="jpeg jpg png gif" />
                                    <span class="errors" id="txtProfileImage-err"></span>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstName">First Name <span class="required">*</span></label>
                                        <input type="text" id="txtFirstName" class="form-control" placeholder="First Name" value="<?php if($isEdit==true){ echo $EditData[0]->FirstName;} ?>">
                                        <span class="errors err-sm" id="txtFirstName-err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtLastName">Last Name </label>
                                        <input type="text" id="txtLastName" class="form-control " placeholder="Last Name" value="<?php if($isEdit==true){ echo $EditData[0]->LastName;} ?>">
                                        <span class="errors  err-sm" id="txtLastName-err"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txtAddress">Address </label>
                                        <textarea class="form-control" placeholder="Address" id="txtAddress" name="Address" rows="3" ><?php if($isEdit==true){ echo $EditData[0]->Address;} ?></textarea>
                                        <span class="errors err-sm" id="txtAddress-err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lstCountry">Country <span class="required">*</span></label>
                                        <select class="form-control select2" id="lstCountry" data-selected="<?php if($isEdit){echo $EditData[0]->CountryID;}else{ echo $Company['CountryID'];} ?>">
                                            <option value="">Select a Country</option>
                                        </select>
                                        <span class="errors err-sm" id="lstCountry-err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lstState">State <span class="required">*</span></label>
                                        <select class="form-control select2" id="lstState"  data-selected="<?php if($isEdit){echo $EditData[0]->StateID;}else{ echo $Company['StateID'];} ?>">
                                            <option value="">Select a State</option>
                                        </select>
                                        <span class="errors err-sm" id="lstState-err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lstCity">City <span class="required">*</span></label>
                                        <select class="form-control select2" id="lstCity" data-selected="<?php if($isEdit){ echo $EditData[0]->CityID;}else{echo $Company['CityID'];} ?>">
                                            <option value="">Select a City</option>
                                        </select>
                                        <span class="errors err-sm" id="lstCity-err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lstPostalCode">Postal Code <span class="required">*</span></label>
                                        <select class="form-control select2Tag" id="lstPostalCode"  data-selected="<?php if($isEdit){echo $EditData[0]->PostalCodeID;}else{echo $Company['PostalCodeID'];} ?>">
                                            <option value="">Select a Postal Code Or enter</option>
                                        </select>
                                        <span class="errors err-sm" id="lstPostalCode-err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lstGender">Gender <span class="required">*</span></label>
                                        <select class="form-control select2" id="lstGender" data-selected="<?php if($isEdit){ echo $EditData[0]->GenderID;} ?>">
                                            <option value="">Select a Gender</option>
                                        </select>
                                        <span class="errors err-sm" id="lstGender-err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lstUserRole">Role <span class="required">*</span></label>
                                        <select class="form-control select2Tag" id="lstUserRole" data-selected="<?php if($isEdit){ echo $EditData[0]->RoleID;} ?>">
                                            <option value="">Select a Role</option>
                                        </select>
                                        <span class="errors err-sm" id="lstUserRole-err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtEmail">Email</label>
                                        <input type="email"  id="txtEmail" class="form-control" placeholder="E-Mail" value="<?php if($isEdit==true){ echo $EditData[0]->EMail;} ?>">
                                        <span class="errors err-sm" id="txtEmail-err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtMobileNumber"> MobileNumber  <span class="fs-10 fw-500" style="color:#ab9898">(User Name) </span><span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text" id="CallCode">+91</span></div>
                                            <input type="number" @if($isEdit) disabled @endif id="txtMobileNumber" class="form-control" data-length="0" placeholder="Mobile Number enter without country code"  value="<?php if($isEdit==true){ echo $EditData[0]->MobileNumber;} ?>">
                                        </div>
                                        
                                        <span class="errors err-sm" id="txtMobileNumber-err"></span>
                                    </div>
                                </div>
                                @if($isEdit==false)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtPassword">Password <span class="required">*</span></label>
                                        <input type="password" id="txtPassword" class="form-control" placeholder="Password" value="<?php if($isEdit==true){ echo $EditData[0]->EMail;} ?>">
                                        <span class="errors err-sm" id="txtPassword-err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtConfirmPassword">Confirm Password <span class="required">*</span></label>
                                        <input type="password" id="txtConfirmPassword" class="form-control" placeholder="Confirm Password" value="<?php if($isEdit==true){ echo $EditData[0]->EMail;} ?>">
                                        <span class="errors err-sm" id="txtConfirmPassword-err"></span>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">User Status</label>
                                        <select class="form-control" id="lstActiveStatus">
                                            <option value="1" @if($isEdit==true) @if($EditData[0]->ActiveStatus=="1") selected @endif @endif >Active</option>
                                            <option value="0" @if($isEdit==true) @if($EditData[0]->ActiveStatus=="0") selected @endif @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    @if($crud['view']==1)
                                        <a href="{{ url('/') }}/admin/users-and-permissions/users" class="btn btn-sm btn-outline-dark mr-10">Cancel</a>
                                    @endif
                                    @if($crud['edit']==1 || $crud['add']==1)
                                        <button class="btn btn-sm btn-outline-success btn-air-success" id="btnSave">@if($isEdit) Update @else Create @endif </button>
                                    @endif
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function(){
        const appInit=async()=>{
			getCountry();
			getGender();
			getUserRoles();
		}
        const getUserRoles=async()=>{
            $.ajax({
                type:"post",
                url:"{{url('/')}}/admin/users-and-permissions/users/get/user-roles",
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                dataType:"json",
                async:true,
                error:function(e, x, settings, exception){ajaxErrors(e, x, settings, exception);},
                complete: function(e, x, settings, exception){},
                success:function(response){
                    $('#lstUserRole').select2('destroy');
                    $('#lstUserRole option').remove();
                    $('#lstUserRole').append('<option value="" selected>Select a Role</option>');
                    for(let Item of response){
                        let selected="";
                        if(Item.RoleID==$('#lstUserRole').attr('data-selected')){selected="selected";}
                        $('#lstUserRole').append('<option '+selected+' value="'+Item.RoleID+'">'+Item.RoleName+' </option>');
                    }
                    $('#lstUserRole').select2();
                }
            });
        }
        const getGender=async()=>{
            $.ajax({
                type:"post",
                url:"{{url('/')}}/get/gender",
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                dataType:"json",
                async:true,
                error:function(e, x, settings, exception){ajaxErrors(e, x, settings, exception);},
                complete: function(e, x, settings, exception){},
                success:function(response){
                    $('#lstGender').select2('destroy');
                    $('#lstGender option').remove();
                    $('#lstGender').append('<option value="" selected>Select a Gender</option>');
                    for(let Item of response){
                        let selected="";
                        if(Item.GID==$('#lstGender').attr('data-selected')){selected="selected";}
                        $('#lstGender').append('<option '+selected+' value="'+Item.GID+'">'+Item.Gender+' </option>');
                    }
                    $('#lstGender').select2();
                }
            });
        }
        const getCountry=async()=>{
            $.ajax({
                type:"post",
                url:"{{url('/')}}/get/country",
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                dataType:"json",
                async:true,
                error:function(e, x, settings, exception){ajaxErrors(e, x, settings, exception);},
                complete: function(e, x, settings, exception){},
                success:function(response){
                    $('#lstCountry').select2('destroy');
                    $('#lstCountry option').remove();
                    $('#lstCountry').append('<option value="" selected>Select a Country</option>');
                    for(let Item of response){
                        let selected="";
                        if(Item.CountryID==$('#lstCountry').attr('data-selected')){selected="selected";}
                        $('#lstCountry').append('<option '+selected+' data-phone-code="'+Item.PhoneCode+'" data-phone-length="'+Item.PhoneLength+'" value="'+Item.CountryID+'">'+Item.CountryName+' ( '+Item.sortname+' ) '+' </option>');
                    }
                    $('#lstCountry').select2();
                    if($('#lstCountry').val()!=""){
                        $('#lstCountry').trigger('change');
                    }
                }
            });
        }
        const getStates=async()=>{
            $.ajax({
                type:"post",
                url:"{{url('/')}}/get/states",
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                dataType:"json",
                data:{CountryID:$('#lstCountry').val()},
                async:true,
                error:function(e, x, settings, exception){ajaxErrors(e, x, settings, exception);},
                complete: function(e, x, settings, exception){},
                success:function(response){
                    $('#lstState').select2('destroy');
                    $('#lstState option').remove();
                    $('#lstState').append('<option value="" selected>Select a State</option>');
                    for(let Item of response){
                        let selected="";
                        if(Item.StateID==$('#lstState').attr('data-selected')){selected="selected";}
                        $('#lstState').append('<option '+selected+'  value="'+Item.StateID+'">'+Item.StateName+' </option>');
                    }
                    $('#lstState').select2();
                    if($('#lstState').val()!=""){
                        $('#lstState').trigger('change');
                    }
                }
            });
        }
        const getCity=async()=>{
            $.ajax({
                type:"post",
                url:"{{url('/')}}/get/city",
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                dataType:"json",
                data:{CountryID:$('#lstCountry').val(),StateID:$('#lstState').val()},
                async:true,
                error:function(e, x, settings, exception){ajaxErrors(e, x, settings, exception);},
                complete: function(e, x, settings, exception){},
                success:function(response){
                    $('#lstCity').select2('destroy');
                    $('#lstCity option').remove();
                    $('#lstCity').append('<option value="" selected>Select a City</option>');
                    for(let Item of response){
                        let selected="";
                        if(Item.CityID==$('#lstCity').attr('data-selected')){selected="selected";}
                        $('#lstCity').append('<option '+selected+'  value="'+Item.CityID+'">'+Item.CityName+' </option>');
                    }
                    $('#lstCity').select2();
                }
            });
        }
        const getPostalCode=async()=>{
            $.ajax({
                type:"post",
                url:"{{url('/')}}/get/postal-code",
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                dataType:"json",
                data:{CountryID:$('#lstCountry').val(),StateID:$('#lstState').val()},
                async:true,
                error:function(e, x, settings, exception){ajaxErrors(e, x, settings, exception);},
                complete: function(e, x, settings, exception){},
                success:function(response){
                    $('#lstPostalCode').select2('destroy');
                    $('#lstPostalCode option').remove();
                    $('#lstPostalCode').append('<option value="" selected>Select a Postal Code or Enter</option>');
                    for(let Item of response){
                        let selected="";
                        if(Item.PID==$('#lstPostalCode').attr('data-selected')){selected="selected";}
                        $('#lstPostalCode').append('<option '+selected+'  value="'+Item.PID+'">'+Item.PostalCode+' </option>');
                    }
                    $('#lstPostalCode').select2({tags: true});
                }
            });
        }
        const formValidation=()=>{
            $('.errors').html('')
            let FirstName=$('#txtFirstName').val();
			let LastName=$('#txtLastName').val();
            let Gender=$('#lstGender').val();
            let Password=$('#txtPassword').val();
            let ConfirmPassword=$('#txtConfirmPassword').val();
            let UserRole=$('#lstUserRole').val();
			let EMail=$('#txtEmail').val();

            let Address=$('#txtAddress').val();
            let Country=$('#lstCountry').val();
            let State=$('#lstState').val();
            let City=$('#lstCity').val();
            let PostalCode=$('#lstPostalCode').val();
            let MobileNumber=$('#txtMobileNumber').val();
            let PhoneLength=$('#lstCountry option:selected').attr('data-phone-length');
            let status=true;
            if(FirstName==""){
                $('#txtFirstName-err').html('First Name is required');status=false;
            }else if(FirstName.length<2){
                $('#txtFirstName-err').html('The First Name is must be greater than 2 characters.');status=false;
            }else if(FirstName.length>50){
                $('#txtFirstName-err').html('The First Name is not greater than 50 characters.');status=false;
            }
            if(EMail!=""){
				if(EMail.isValidEMail()==false){
                    $('#txtEmail-err').html('E-Mail is not valid');status=false;
                }
            }
            if(LastName==""){
				if(LastName.length>50){
					$('#txtLastName-err').html('The Last Name is not greater than 50 characters.');status=false;
				}
			}
            if(Gender==""){
                $('#lstGender-err').html('Gender is required');status=false;
            }
            if(UserRole==""){
                $('#lstUserRole-err').html('User Role is required');status=false;
            }
            if(Country==""){
                $('#lstCountry-err').html('Country is required');status=false;
            }
            if(State==""){
                $('#lstState-err').html('State is required');status=false;
            }
            if(City==""){
                $('#lstCity-err').html('City is required');status=false;
            }
            if(PostalCode==""){
                $('#lstPostalCode-err').html('Postal Code is required');status=false;
            }
            if(MobileNumber==""){
                $('#txtMobileNumber-err').html('Mobile Number is required');status=false;
            }else if($.isNumeric(MobileNumber)==false){
                $('#txtMobileNumber-err').html('Mobile Number is must be numeric value');status=false;
            }else if((parseInt(PhoneLength)>0)&&(parseInt(PhoneLength)!=MobileNumber.length)){
                $('#txtMobileNumber-err').html('Mobile Number is not valid');status=false;
            }
            @if($isEdit==false)
				if(Password==""){
					$('#txtPassword-err').html('Password is required');status=false;
				}else if(Password.length<3){
					$('#txtPassword-err').html('Password must be at least 4 characters');status=false;
				}
				if(ConfirmPassword==""){
					$('#txtConfirmPassword-err').html('Confirm Password is required');status=false;
				}else if(ConfirmPassword.length<4){
					$('#txtConfirmPassword-err').html('Confirm Password must be at least 4 characters');status=false;
				}else if(Password!==ConfirmPassword){
					$('#txtConfirmPassword-err').html('Confirm Password does not match with password');status=false;
				}
            @endif
            return status;
        }
		const getData=()=>{
			let formData=new FormData();
			formData.append('FirstName',$('#txtFirstName').val());
			formData.append('LastName',$('#txtLastName').val());
			formData.append('Gender',$('#lstGender').val());
			formData.append('UserRole',$('#lstUserRole').val());
			formData.append('ActiveStatus',$('#lstActiveStatus').val());
			formData.append('Address',$('#txtAddress').val());
			formData.append('City',$('#lstCity').val());
			formData.append('State',$('#lstState').val());
			formData.append('Country',$('#lstCountry').val());
			formData.append('PostalCode',$('#lstPostalCode').val());
			formData.append('PostalCode1',$('#lstPostalCode option:selected').text());
			formData.append('EMail',$('#txtEmail').val());
			formData.append('MobileNumber',$('#txtMobileNumber').val());
            @if($isEdit==false)
                formData.append('Password',$('#txtPassword').val());
                formData.append('ConfirmPassword',$('#txtConfirmPassword').val());
            @endif
			if($('#txtProfileImage').val()!=""){
				formData.append('ProfileImage', $('#txtProfileImage')[0].files[0]);
			}
			return formData;
		}
        $(document).on('change','#lstCountry',function(){
            getStates();
			let CallCode=$('#lstCountry option:selected').attr('data-phone-code');
			if(CallCode!=""){
				$('#CallCode').html(" ( +"+CallCode+" )");
			}
        });
        $(document).on('change','#lstState',function(){
            getCity();
            getPostalCode();
        });
        $(document).on('click','#btnSave',function(){
            let status=formValidation();
            if(status){
                const formData=getData();
                swal({
                    title: "Are you sure?",
                    text: "You want @if($isEdit==true)Update @else Save @endif this User!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-outline-success",
                    confirmButtonText: "Yes, @if($isEdit==true)Update @else Save @endif it!",
                    closeOnConfirm: false
                },
                function(){
                    swal.close();
                    btnLoading($('#nextBtn'));
                    @if($isEdit) let posturl="{{url('/')}}/admin/users-and-permissions/users/edit/{{$UserID}}"; @else let posturl="{{url('/')}}/admin/users-and-permissions/users/create"; @endif
                    $.ajax({
                        type:"post",
                        url:posturl,
                        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                        data:formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = (evt.loaded / evt.total) * 100;
                                    percentComplete=parseFloat(percentComplete).toFixed(2);
                                    $('#divProcessText').html(percentComplete+'% Completed.<br> Please wait for until upload process complete.');
                                    //Do something with upload progress here
                                }
                            }, false);
                            return xhr;
                        },
                        beforeSend: function() {
                            ajaxIndicatorStart("Please wait Upload Process on going.");
                            var percentVal = '0%';
                            setTimeout(() => {
                            $('#divProcessText').html(percentVal+' Completed.<br> Please wait for until upload process complete.');
                            }, 100);
                        },
                        error:function(e, x, settings, exception){ajaxErrors(e, x, settings, exception);},
                        complete: function(e, x, settings, exception){btnReset($('#nextBtn'));ajaxIndicatorStop();},
                        success:function(response){
                            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
                            if(response.status==true){
                                swal({
                                    title: "SUCCESS",
                                    text: response.message,
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonClass: "btn-outline-success",
                                    confirmButtonText: "Okay",
                                    closeOnConfirm: false
                                },function(){
                                    @if($isEdit==true)
                                        window.location.replace("{{url('/')}}/admin/users-and-permissions/users/");
                                    @else
                                        window.location.reload();
                                    @endif
                                });    
                            }else{
                                toastr.error(response.message, "Failed", {
                                    positionClass: "toast-top-right",
                                    containerId: "toast-top-right",
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    progressBar: !0
                                })
                                if(response['errors']!=undefined){
                                    $('.errors').html('');
                                    $.each( response['errors'], function( KeyName, KeyValue ) {
                                        var key=KeyName;
                                        if(key=="FirstName"){$('#txtFirstName-err').html(KeyValue);}
                                        if(key=="LastName"){$('#txtLastName-err').html(KeyValue);}
                                        if(key=="Gender"){$('#lstGender-err').html(KeyValue);}
                                        if(key=="UserRole"){$('#lstUserRole-err').html(KeyValue);}
                                        if(key=="Address"){$('#txtAddress-err').html(KeyValue);}
                                        if(key=="City"){$('#lstCity-err').html(KeyValue);}
                                        if(key=="State"){$('#lstState-err').html(KeyValue);}
                                        if(key=="Country"){$('#lstCountry-err').html(KeyValue);}
                                        if(key=="PostalCode"){$('#lstPostalCode-err').html(KeyValue);}
                                        if(key=="EMail"){$('#txtEmail-err').html(KeyValue);}
                                        if(key=="MobileNumber"){$('#txtMobileNumber-err').html(KeyValue);}
                                        if(key=="ProfileImage"){$('#txtProfileImage-err').html(KeyValue);}
                                        if(key=="ActiveStatus"){$('#lstActiveStatus-err').html(KeyValue);}
                                    });
                                }
                            }
                        }
                    });
                });
            }
        });
        appInit();
    });
</script>
@endsection