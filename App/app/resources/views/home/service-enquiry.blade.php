<div class="contact service-enquiry">
    <form action="#" id="frmServiceEnquiry" method="post" role="form" class="php-email-form p-3 p-md-4">
        <div class="row">
            <div class="col-12 col-sm-12 col-xl-12 d-none">
                <div class="form-group">
                    <input type="text" class="form-control" id="txtServiceName" placeholder="Service Name"  value="{{$ServiceName}}" disabled>
                    <input type="hidden" class="form-control" id="txtServiceID" value="{{$ServiceID}}" >
                    <div class="errors err-sm" id="txtServiceName-err"></div>
                </div>
            </div>
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
        <div class="text-center"><button id="submit"  type="submit">Submit</button></div>
    </form>
</div>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
