@extends('layouts.home')
@section('content')
    <section id="contact" class="contact">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="section-header">
                <h2 style="margin-bottom:20px">Contact</h2>
                <p>Need Help? <span>Contact Us</span></p>
            </div>
            @if($CompanySettings['goole-map-status']==true)
            <div class="mb-3 mt-3">
                <iframe style="border:0; width: 100%; height: 500px;" src="{{$CompanySettings['goole-embed-map']}}" frameborder="0" allowfullscreen=""></iframe>
            </div>
            <!-- End Google Maps -->
            @endif
            <div class="row gy-4">
                <div class="col-12 col-sm-4 col-md-4">
                    <div class="info-item  d-flex align-items-center">
                        <i class="icon bi bi-map flex-shrink-0"></i>
                        <div>
                            <h3>Our Address</h3>
                            <p style="font-size:16px;font-weight:600;">{{$CompanySettings['NAME']}}</p>
                            <p>{{$CompanySettings['FullAddress']}}</p>
                        </div>
                    </div>
                </div>
                <!-- End Info Item -->
                <div class="col-12 col-sm-4 col-md-4">
                    <div class="info-item d-flex align-items-center">
                        <i class="icon bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h3>Email Us</h3>
                            <p>{{$CompanySettings['E-Mail']}}</p>
                        </div>
                    </div>
                </div>
                <!-- End Info Item -->
                <div class="col-12 col-sm-4 col-md-4">
                    <div class="info-item  d-flex align-items-center">
                        <i class="icon bi bi-telephone flex-shrink-0"></i>
                        <div>
                            <h3>Call Us</h3>
                            <p>+91 {{$CompanySettings['Phone-Number']}}</p>
                            <p>+91 {{$CompanySettings['Mobile-Number']}}</p>
                        </div>
                    </div>
                </div>
                <!-- End Info Item -->
            </div>
            <form action="#" method="post" role="form" class="php-email-form p-3 p-md-4">
                <div class="row">
                    <div class="col-12 col-sm-4 col-xl-4">
                        <div class="form-group">
                            <input type="text" class="form-control" id="txtName" placeholder="Your Name" required="">
                            <div class="errors err-sm" id="txtName-err"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-xl-4">
                        <div class="form-group">
                            <input type="email" class="form-control" id="txtEmail" placeholder="Your Email" required="">
                            <div class="errors err-sm" id="txtEmail-err"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-xl-4">
                        <div class="form-group">
                            <input type="text" class="form-control"  id="txtMobileNumber" placeholder="Your Mobile Number" required="">
                            <div class="errors err-sm" id="txtMobileNumber-err"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-xl-12">
                        <div class="form-group">
                            <input type="text" class="form-control"  id="txtSubject" placeholder="Subject" required="">
                            <div class="errors err-sm" id="txtSubject-err"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-xl-12">
                        <div class="form-group">
                            <textarea class="form-control" id="txtMessage" rows="5" placeholder="Message" required=""></textarea>
                            <div class="errors err-sm" id="txtMessage-err"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 mb-4 d-flex justify-content-center">
                    <div class="col-12 col-sm-6" id="divmessage">

                    </div>
                </div>
                <div class="text-center"><button id="submit"  type="submit">Submit</button></div>
            </form>
            <!--End Contact Form -->
        </div>
    </section>

    <script src="https://www.google.com/recaptcha/api.js?onload=onloadContactCallback&render=explicit" async defer></script>
    <script>
        const getContactData=()=>{
            let formData={}
            formData.Name=$('#txtName').val();
            formData.Email=$('#txtEmail').val();
            formData.MobileNumber=$('#txtMobileNumber').val();
            formData.Subject=$('#txtSubject').val();
            formData.Message=$('#txtMessage').val();
            return formData;
        }
        const clearContactData=async()=>{
            $('#txtName').val('');
            $('#txtEmail').val('');
            $('#txtMobileNumber').val('');
            $('#txtSubject').val('');
            $('#txtMessage').val('');
            $('#txtName').val('');
        }
        const contactFormValidation=(formData)=>{
            let status=true;
            $('.errors').html('');
            if(formData.Name==""){
                $('#txtName-err').html(' Name is required');status=false;
            }
            if(formData.Email==""){
                $('#txtEmail-err').html(' Email is required');status=false;
            }else if(formData.Email.isValidEMail()==false){
                $('#txtEmail-err').html(' Email not valid');status=false;
            }

            if(formData.MobileNumber==""){
                $('#txtMobileNumber-err').html(' Mobile Number is required');status=false;
            }else if(!$.isNumeric(formData.MobileNumber)){
                $('#txtMobileNumber-err').html('The Moile Number must be a numeric value');status=false;
            }else if(formData.MobileNumber.length!=10){
                $('#txtMobileNumber-err').html('The Mobile Number required 10 digit number.');status=false;
            }

            if(formData.Subject==""){
                $('#txtSubject-err').html(' Subject is required');status=false;
            }
            if(formData.Message==""){
                $('#txtMessage-err').html(' Message is required');status=false;
            }
            return status;
        }
        var onContactSubmit = function(token) {
            let formData=getContactData();
            let status=contactFormValidation(formData);
            if(status){
                $.ajax({
                    type:"post",
                    url:"{{url('/')}}/save/contact-enquiry",
                    data:formData,
                    dataType:"json",
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                    success:function(response){
                        if(response.status==true){
                            $('#divmessage').html('<div class="alert alert-success" role="alert">Your message has been sent. Thank you!</div>');
                            setTimeout(() => {
                                $('#divmessage').html('');
                            }, 4000);
                            clearContactData();
                        }else{
                            grecaptcha.reset();
                            $('#divmessage').html('<div class="alert alert-danger" role="alert">Your message not sent. please try again later</div>');
                            if(response['errors']!=undefined){
								$('.errors').html('');
								$.each( response['errors'], function( KeyName, KeyValue ) {
									if(KeyName=="Name"){$('#txtName-err').html(KeyValue);}
									if(KeyName=="Email"){$('#txtEmail-err').html(KeyValue);}
									if(KeyName=="MobileNumber"){$('#MobileNumber-err').html(KeyValue);}
									if(KeyName=="Subject"){$('#txtSubject-err').html(KeyValue);}
									if(KeyName=="Message"){$('#txtMessage-err').html(KeyValue);}
								});
							}
                        }
                    }
                });
            }else{
                grecaptcha.reset();
            }
        };
        var onloadContactCallback = function() {
          grecaptcha.render('submit', {
            'sitekey' : '6LevXs4nAAAAAEz6aDge943m-mG1xnzjJg99x1bI',
            'callback' : onContactSubmit
          });
        };
    </script>
@endsection
