@extends('layouts.app')
@section('content')
@php $GalleryCount=1; @endphp
<style>
#divGallery .dropify-clear1 {
    display: none !important;
}

.modal-title {
    position: relative;
}
</style>
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}/admin">Home</a></li>
                    <li class="breadcrumb-item">Master</li>
                    <li class="breadcrumb-item"><a href="{{url('/')}}/admin/master/services">{{$PageTitle}}</a></li>
                    <li class="breadcrumb-item">@if($isEdit) Update @else create @endif</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt-40">
    <div class="row  d-flex justify-content-center">
        <div class="col-sm-8 ">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="form-row align-items-center">
                                <div class="col-md-4"> </div>
                                <div class="col-md-4 my-2">
                                    <h5 id="pageTitle">{{$PageTitle}}</h5>
                                </div>
                                <div class="col-md-4 my-2 text-right text-md-right"></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row   d-flex justify-content-center">
                                <div class="col-sm-12">
                                    <form class="form-wizard" id="frmUsers" action="#" method="POST">
                                        <div class="tab" data-page="Project Info">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="txtProjectName">Project Name <span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control" id="txtProjectName"
                                                            value="<?php if ($isEdit) {echo $EditData[0]->ProjectName;}?>">
                                                        <div class="errors err-sm ProjectInfo" id="txtProjectName-err">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="txtSlug">Slug <span
                                                                class="required">*</span></label>
                                                        <input type="text" disabled class="form-control" id="txtSlug"
                                                            value="<?php if ($isEdit) {echo $EditData[0]->Slug;}?>">
                                                        <div class="errors err-sm ProjectInfo" id="txtSlug-err"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="lstCategory">Category <span
                                                                class="required">*</span></label>
                                                        <select class="form-control select2" id="lstCategory"
                                                            data-selected="<?php if ($isEdit) {echo $EditData[0]->CID;}?>">
                                                            <option value="">Select a Category</option>
                                                        </select>
                                                        <div class="errors err-sm ProjectInfo" id="lstCategory-err">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="txtHSNSAC">HSN / SAC <span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control" id="txtHSNSAC"
                                                            value="<?php if ($isEdit) {echo $EditData[0]->HSNSAC;}?>">
                                                        <div class="errors err-sm ProjectInfo" id="txtHSNSAC-err"></div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="txtPrice">Price <span
                                                                class="required">*</span></label>
                                                        <input type="number"
                                                            step="{{NumberSteps($Settings['price-decimals'])}}"
                                                            class="form-control" id="txtPrice"
                                                            value="<?php if ($isEdit) {echo NumberFormat($EditData[0]->Price, $Settings['price-decimals']);} else {echo NumberFormat(0, $Settings['price-decimals']);}?>">
                                                        <div class="errors err-sm ProjectInfo" id="txtPrice-err"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="lstUOM">UOM <span
                                                                class="required">*</span></label>
                                                        <select class="form-control select2" id="lstUOM"
                                                            data-selected="<?php if ($isEdit) {echo $EditData[0]->UID;}?>">
                                                            <option value="">Select a UOM</option>
                                                        </select>
                                                        <div class="errors err-sm ProjectInfo" id="lstUOM-err"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="lstTax">Tax <span
                                                                class="required">*</span></label>
                                                        <select class="form-control select2" id="lstTax"
                                                            data-selected="<?php if ($isEdit) {echo $EditData[0]->TaxID;}?>">
                                                            <option value="">Select a Tax</option>
                                                        </select>
                                                        <div class="errors err-sm ProjectInfo" id="lstTax-err"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="lstTaxType">Tax Type <span
                                                                class="required">*</span></label>
                                                        <select class="form-control select2" id="lstTaxType">
                                                            <option value="Exclude" @if($isEdit) @if($EditData[0]->
                                                                TaxType=="Exclude") selected @endif @endif>Exclude
                                                            </option>
                                                            <option value="Include" @if($isEdit) @if($EditData[0]->
                                                                TaxType=="Include") selected @endif @endif>Include
                                                            </option>
                                                        </select>
                                                        <div class="errors err-sm ProjectInfo" id="lstTaxType-err">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">Short Description <span
                                                                class="required">*</span></label>
                                                        <textarea id="txtShortDescription"
                                                            class="form-control"><?php if ($isEdit) {echo $EditData[0]->ShortDescription;}?></textarea>
                                                        <div class="errors err-sm ProjectInfo"
                                                            id="txtShortDescription-err"></div>
                                                    </div>
                                                </div>
                                                 <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Active Status</label>
                                                        <select class="form-control" id="lstActiveStatus">
                                                            <option value="1" @if($isEdit && $EditData[0]->ActiveStatus
                                                                == "1") selected @endif>Active</option>
                                                            <option value="0" @if($isEdit && $EditData[0]->ActiveStatus
                                                                == "0") selected @endif>Inactive</option>
                                                        </select>

                                                        <div class="errors err-sm ProjectInfo" id="lstActiveStatus-err">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab mb-20" data-page="Project Description">
                                            <div class="row">
                                                <div class="col-sm-12 col-12">
                                                    <div id="editor" data-height="250">
                                                        <?php if ($isEdit) {echo $EditData[0]->Description;}?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab mb-20" data-page="Project Images">
                                            <div class="row  d-flex justify-content-center">
                                                <div class="col-sm-4 text-center">
                                                    <labe>Cover Image </label>
                                                        <input type="file" id="txtCoverImg" class="dropify imageScrop"
                                                            data-slno="" data-is-cover-image="1"
                                                            data-max-file-size="{{$Settings['upload-limit']}}"
                                                            data-default-file="<?php if ($isEdit == true) {if ($EditData[0]->ProjectImage != "") {echo url('/') . "/" . $EditData[0]->ProjectImage;}}?>"
                                                            data-allowed-file-extensions="jpeg jpg png gif" />
                                                        <span class="errors" id="txtCoverImg-err"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">Gallery Images</div>
                                            </div>
                                            <div class="row mt-10" id="divGallery">
                                                @if($isEdit)
                                                @for($i=0;$i<count($EditData[0]->GalleryImages);$i++)
                                                    <div class="col-sm-3 p-10 text-center"
                                                        id="divGallery{{$GalleryCount}}"
                                                        data-slno="{{$EditData[0]->GalleryImages[$i]->SLNO}}">
                                                        <input type="file" id="txtGalleryImg{{$GalleryCount}}"
                                                            data-is-cover-image="0"
                                                            data-slno="{{$EditData[0]->GalleryImages[$i]->SLNO}}"
                                                            data-new="0" data-index="{{$GalleryCount}}"
                                                            class="dropify GalleryItem imageScrop"
                                                            data-default-file="<?php if ($isEdit == true) {if ($EditData[0]->GalleryImages[$i]->ImageUrl != "") {echo url('/') . "/" . $EditData[0]->GalleryImages[$i]->ImageUrl;}}?>"
                                                            data-max-file-size="{{$Settings['upload-limit']}}"
                                                            data-allowed-file-extensions="jpeg jpg png gif" />
                                                        <div class="errors" id="txtGalleryImg{{$GalleryCount}}-err">
                                                        </div>
                                                    </div>
                                                    @php $GalleryCount++; @endphp
                                                    @endfor
                                                    @endif

                                            </div>
                                            <div class="row d-flex justify-content-center mt-20">
                                                <div class="col-sm-2"><button type="button"
                                                        class="btn btn-outline-info btn-sm" id="btnAddImages">add
                                                        Gallery Image</button></div>
                                            </div>

                                            <div id="galleryContainer"></div>


                                        </div>
                                        <div class="text-center" id="divStepIndicator">
                                            <span class="step active"></span>
                                            <span class="step"></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    @if($crud['view']==true)
                                    <a href="{{url('/')}}/admin/master/services/" class="btn btn-sm btn-outline-dark"
                                        id="btnCancel">Back</a>
                                    @endif
                                </div>
                                <div class="col-sm-6 text-right">

                                    @if((($crud['add']==true) && ($isEdit==false))||(($crud['edit']==true) &&
                                    ($isEdit==true)))
                                    <button class="btn btn-outline-secondary btn-sm" id="prevBtn" type="button"
                                        style="display: none;">Previous</button>
                                    <button class="btn btn-outline-success btn-sm" id="nextBtn"
                                        type="button">Next</button>
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
<div class="modal  medium " tabindex="-1" role="dialog" id="ImgCrop">
    <div class="modal-dialog modal-dialog-centered max-width-50" role="document ">
        <div class="modal-content">
            <div class="modal-header pt-10 pb-10">
                <h5 class="modal-title">Image Crop</h5>
                <button type="button" class="close display-none" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <img style="width:100%" src="" id="ImageCrop" data-id="">
                    </div>
                </div>
                <div class="row mt-10 d-flex justify-content-center">
                    <div class="col-sm-12 docs-buttons d-flex justify-content-center">
                        <div class="btn-group">
                            <button class="btn btn-outline-primary" type="button" data-method="rotate" data-option="-45"
                                title="Rotate Left"><span class="docs-tooltip" data-bs-toggle="tooltip"
                                    data-animation="false" title="$().cropper(&quot;rotate&quot;, -45)"><span
                                        class="fa fa-rotate-left"></span></span>
                                <div class="fs-12"></div>
                            </button>
                            <button class="btn btn-outline-primary" type="button" data-method="rotate" data-option="45"
                                title="Rotate Right"><span class="docs-tooltip" data-bs-toggle="tooltip"
                                    data-animation="false" title="$().cropper(&quot;rotate&quot;, 45)"><span
                                        class="fa fa-rotate-right"></span></span>
                                <div class="fs-12"> </div>
                            </button>
                            <button class="btn btn-outline-primary" type="button" data-method="scaleX" data-option="-1"
                                title="Flip Horizontal"><span class="docs-tooltip" data-bs-toggle="tooltip"
                                    data-animation="false" title="$().cropper(&quot;scaleX&quot;, -1)"><span
                                        class="fa fa-arrows-h"></span></span>
                                <div class="fs-12"></div>
                            </button>
                            <button class="btn btn-outline-primary" type="button" data-method="scaleY" data-option="-1"
                                title="Flip Vertical"><span class="docs-tooltip" data-bs-toggle="tooltip"
                                    data-animation="false" title="$().cropper(&quot;scaleY&quot;, -1)"><span
                                        class="fa fa-arrows-v"></span></span>
                                <div class="fs-12"></div>
                            </button>
                            <button class="btn btn-outline-primary" type="button" data-method="reset"
                                title="Reset"><span class="docs-tooltip" data-bs-toggle="tooltip" data-animation="false"
                                    title="$().cropper(&quot;reset&quot;)"><span class="fa fa-refresh"></span></span>
                                <div class="fs-12"></div>
                            </button>
                            <button class="btn btn-outline-warning btn-upload" id="btnUploadImage"
                                title="Upload image file"><span class="docs-tooltip" data-bs-toggle="tooltip"
                                    data-animation="false" title="Import image with Blob URLs"><span
                                        class="fa fa-upload"></span></span>
                                <div class="fs-12"></div>
                            </button>
                            <input class="sr-only display-none" id="inputImage" type="file" name="file"
                                accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" id="btnCropCancel">Cancel</button>
                <button type="button" class="btn btn-outline-info" id="btnCropApply">Apply</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    let GalleryCount = parseInt("{{$GalleryCount}}");
    var currentTab = 0;
    showTab(currentTab);
    let isProjectName = false;
    let isSlug = false;
    let DeletedGalleryImg = [];

    function showTab(n) {
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = @if($isEdit)
            "Update"
            @else "Submit"
            @endif;
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        fixStepIndicator(n);
        let page = x[currentTab].getAttribute('data-page');
        console.log(page)
        $('#pageTitle').html(page);
    }
    async function nextPrev(n) {
        var x = document.getElementsByClassName("tab");
        if (n == 1 && !validateForm()) return false;
        if ((parseInt(currentTab) + parseInt(n)) >= x.length) {
            Save();
            return false;
        }
        x[currentTab].style.display = "none";
        currentTab = currentTab + n;
        showTab(currentTab);

    }

    function validateForm() {
        let status = true;
        let x = document.getElementsByClassName("tab");
        let page = x[currentTab].getAttribute('data-page');
        if (page == "Project Info") {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            $('.errors.ProjectInfo').html('');
            let ProjectName = $('#txtProjectName').val();
            let HSNSAC = $('#txtHSNSAC').val();
            let Slug = $('#txtSlug').val();
            let Category = $('#lstCategory').val();
            let Price = $('#txtPrice').val();
            let UOM = $('#lstUOM').val();
            let TaxType = $('#lstTaxType').val();
            let Tax = $('#lstTax').val();
            let ActiveStatus = $('#lstActiveStatus').val();
            let ShortDescription = $('#txtShortDescription').val();

            if (ProjectName == "") {
                $('#txtProjectName-err').html('Project name is required');
                status = false;
            } else if (ProjectName.length < 3) {
                $('#txtProjectName-err').html('The Project name is must be greater than 3 characters.');
                status = false;
            } else if (ProjectName.length > 100) {
                $('#txtProjectName-err').html('The Project name is not greater than 100 characters.');
                status = false;
            } else if (isProjectName == true) {
                $('#txtProjectName-err').html('Project Name is not available. Already taken').removeClass(
                    'success');
                status = false
            } else if (isProjectName == false) {
                $('#txtProjectName-err').html('Project Name is available').addClass('success');
            }
            if (ShortDescription == "") {
                $('#txtShortDescription-err').html('Short Description is required');
                status = false;
            } else if (ShortDescription.length < 20) {
                $('#txtShortDescription-err').html(
                    'The Short Description is must be greater than 20 characters.');
                status = false;
            } else if (ShortDescription.length > 300) {
                $('#txtShortDescription-err').html('The Short Description is not greater than 300 characters.');
                status = false;
            }
            if (Slug == "") {
                $('#txtSlug-err').html('Slug  is required');
                status = false;
            } else if (isSlug == true) {
                $('#txtSlug-err').html('Slug is not available. Already taken').removeClass('success');
                status = false
            } else if (isSlug == false) {
                $('#txtSlug-err').html('Slug is available').addClass('success');
            }

            if (HSNSAC == "") {
                $('#txtHSNSAC-err').html('HSN / SAC is required');
                status = false;
            }

            if (Category == "") {
                $('#lstCategory-err').html('Category is required');
                status = false;
            }

            if (Price == "") {
                $('#txtPrice-err').html('Price is required');
                status = false;
            } else if (!$.isNumeric(Price)) {
                $('#txtPrice-err').html('The Price is not numeric value');
                status = false;
            } else if (parseFloat(Price) < 0) {
                $('#txtPrice-err').html('The Price must be equal or greater than zero.');
                status = false;
            }
            if (UOM == "") {
                $('#lstUOM-err').html('Unit of measurement is required');
                status = false;
            }
            if (Tax == "") {
                $('#lstTax-err').html('Tax is required');
                status = false;
            }
            if (TaxType == "") {
                $('#lstTaxType-err').html('Tax type is required');
                status = false;
            }

            if (ActiveStatus == "") {
                $('#lstActiveStatus-err').html('Active status is required');
                status = false;
            }
        }
        return status;
        //return true;
    }

    function fixStepIndicator(n) {
        $('#divStepIndicator').html('');
        var tabs = document.getElementsByClassName("tab");
        for (let i = 0; i < tabs.length; i++) {
            $('#divStepIndicator').append('<span class="step"></span>');
        }

        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        x[n].className += " active";
    }
    $('#prevBtn').click(function() {
        nextPrev(-1);
    });
    $('#nextBtn').click(function() {
        nextPrev(1);
    });
    const appInit = async () => {
        getCategory();
        getTax();
        getUOM();
        initCKEditor();
    }
    const getCategory = async () => {
        $('#lstCategory').select2('destroy');
        $('#lstCategory option').remove();
        $('#lstCategory').append('<option value="" selected>Select a Category</option>');
        $.ajax({
            type: "post",
            url: "{{url('/')}}/admin/master/services/get/category",
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            },
            dataType: "json",
            async: true,
            error: function(e, x, settings, exception) {
                ajaxErrors(e, x, settings, exception);
            },
            complete: function(e, x, settings, exception) {},
            success: function(response) {
                for (let Item of response) {
                    let selected = "";
                    if (Item.CID == $('#lstCategory').attr('data-selected')) {
                        selected = "selected";
                    }
                    $('#lstCategory').append('<option ' + selected + ' value="' + Item.CID +
                        '">' + Item.CName + ' </option>');
                }
                if ($('#lstCategory').val() != "") {
                    $('#lstCategory').trigger('change');
                }
            }
        });
        $('#lstCategory').select2();
    }

    const getTax = async () => {
        $('#lstTax').select2('destroy');
        $('#lstTax option').remove();
        $('#lstTax').append('<option value="" selected>Select a Tax</option>');
        $.ajax({
            type: "post",
            url: "{{url('/')}}/admin/master/services/get/tax",
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            },
            dataType: "json",
            async: true,
            error: function(e, x, settings, exception) {
                ajaxErrors(e, x, settings, exception);
            },
            complete: function(e, x, settings, exception) {},
            success: function(response) {
                for (let Item of response) {
                    let selected = "";
                    if (Item.TaxID == $('#lstTax').attr('data-selected')) {
                        selected = "selected";
                    }
                    $('#lstTax').append('<option ' + selected + ' value="' + Item.TaxID +
                        '">' + Item.TaxName + ' ( ' + NumberFormat(Item.TaxPercentage,
                            'percentage') + '% ) </option>');
                }
            }
        });
        $('#lstTax').select2();
    }
    const getUOM = async () => {
        $('#lstUOM').select2('destroy');
        $('#lstUOM option').remove();
        $('#lstUOM').append('<option value="" selected>Select a UOM</option>');
        $.ajax({
            type: "post",
            url: "{{url('/')}}/admin/master/services/get/uom",
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            },
            dataType: "json",
            async: true,
            error: function(e, x, settings, exception) {
                ajaxErrors(e, x, settings, exception);
            },
            complete: function(e, x, settings, exception) {},
            success: function(response) {
                for (let Item of response) {
                    let selected = "";
                    if (Item.UID == $('#lstUOM').attr('data-selected')) {
                        selected = "selected";
                    }
                    $('#lstUOM').append('<option ' + selected + ' value="' + Item.UID +
                        '">' + Item.UName + ' ( ' + Item.UCode + ' ) </option>');
                }
            }
        });
        $('#lstUOM').select2();
    }
   const getData = async () => {
    let tmp = await UploadImages();
    let formData = new FormData();
    formData.append('ProjectName', $('#txtProjectName').val());
    formData.append('HSNSAC', $('#txtHSNSAC').val());
    formData.append('Slug', $('#txtSlug').val());
    formData.append('Category', $('#lstCategory').val());
    formData.append('Price', $('#txtPrice').val());
    formData.append('UOM', $('#lstUOM').val());
    formData.append('TaxType', $('#lstTaxType').val());
    formData.append('Tax', $('#lstTax').val());
    formData.append('ActiveStatus', $('#lstActiveStatus').val());
    formData.append('ShortDescription', $('#txtShortDescription').val());
    formData.append('Description', CKEDITOR.instances.editor.getData());
    
    // Append dynamically added images
    $('.gallery-item input[type="file"]').each(function(index, element) {
        var files = $(element)[0].files;
        if (files.length > 0) {
            $.each(files, function(i, file) {
                formData.append('gallery_images[]', file);
            });
        }
    });
    
    formData.append('Images', JSON.stringify(tmp));
    formData.append('DeletedGalleryImg', JSON.stringify(DeletedGalleryImg));
    return formData;
}

    const Save = async () => {
        swal({
            title: "Are you sure?",
            text: "You want @if($isEdit==true)Update @else Save @endif this Project!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-outline-success",
            confirmButtonText: "Yes, @if($isEdit==true)Update @else Save @endif it!",
            closeOnConfirm: false
        }, async function() {

            let formData = await getData();
            swal.close();
            btnLoading($('#nextBtn'));
            @if($isEdit) let posturl =
                "{{url('/')}}/admin/master/services/edit/{{$ProjectID}}";
            @else
            let posturl = "{{url('/')}}/admin/master/services/create";
            @endif
            $.ajax({
                type: "post",
                url: posturl,
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                },
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#divProcessText').html(
                        ' upload completed.<br> Please wait for until upload process complete.'
                    );
                },
                error: function(e, x, settings, exception) {
                    ajaxErrors(e, x, settings, exception);
                    btnReset($('#nextBtn'));
                    ajaxIndicatorStop();
                },
                success: function(response) {
                    document.documentElement.scrollTop =
                        0; // For Chrome, Firefox, IE and Opera
                    if (response.status == true) {
                        swal({
                            title: "SUCCESS",
                            text: response.message,
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn-outline-success",
                            confirmButtonText: "Okay",
                            closeOnConfirm: false
                        }, function() {
                            @if($isEdit == true)
                            window.location.replace(
                                "{{url('/')}}/admin/master/services/"
                            );
                            @else
                            window.location.reload();
                            @endif
                        });
                    } else {
                        ajaxIndicatorStop();
                        $('#nextBtn').html('next')
                        $('.tab').hide();
                        currentTab = 0;
                        showTab(currentTab);
                        toastr.error(response.message, "Failed", {
                            positionClass: "toast-top-right",
                            containerId: "toast-top-right",
                            showMethod: "slideDown",
                            hideMethod: "slideUp",
                            progressBar: !0
                        })
                        if (response['errors'] != undefined) {
                            $('.errors').html('');
                            $.each(response['errors'], function(KeyName,
                                KeyValue) {
                                var key = KeyName;
                                if (key == "ProjectName") {
                                    $('#txtProjectName-err').html(
                                        KeyValue);
                                }
                                if (key == "HSNSAC") {
                                    $('#txtHSNSAC-err').html(KeyValue);
                                }
                                if (key == "Slug") {
                                    $('#txtSlug-err').html(KeyValue);
                                }
                                if (key == "Category") {
                                    $('#lstCategory-err').html(
                                        KeyValue);
                                }
                                if (key == "Price") {
                                    $('#txtPrice-err').html(KeyValue);
                                }
                                if (key == "UOM") {
                                    $('#lstUOM-err').html(KeyValue);
                                }
                                if (key == "TaxType") {
                                    $('#lstTaxType-err').html(KeyValue);
                                }
                                if (key == "Tax") {
                                    $('#lstTax-err').html(KeyValue);
                                }
                                if (key == "ActiveStatus") {
                                    $('#lstActiveStatus-err').html(
                                        KeyValue);
                                }
                                if (key == "Description") {
                                    $('#txtDescription-err').html(
                                        KeyValue);
                                }
                            });
                        }
                    }
                }
            });
        });
    }
    const UploadImages = async () => {
        let uploadImages = await new Promise((resolve, reject) => {
            ajaxIndicatorStart("% Completed. Please wait for until upload process complete.");
            setTimeout(() => {
                let count = $("input.imageScrop").length;
                let completed = 0;
                let rowIndex = 0;
                let images = {
                    coverImg: {
                        uploadPath: "",
                        fileName: ""
                    },
                    gallery: []
                };
                const uploadComplete = async (e, x, settings, exception) => {
                    completed++;
                    let percentage = (100 * completed) / count;
                    $('#divProcessText').html(percentage +
                        '% Completed. Please wait for until upload process complete.'
                    );
                    checkUploadCompleted();
                }
                const checkUploadCompleted = async () => {
                    if (count <= completed) {
                        ajaxIndicatorStop();
                        resolve(images);
                    }
                }
                const upload = async (formData) => {
                    $.ajax({
                        type: "post",
                        url: "{{url('/')}}/admin/tmp/upload-image",
                        headers: {
                            'X-CSRF-Token': $('meta[name=_token]').attr(
                                'content')
                        },
                        data: formData,
                        dataType: "json",
                        error: function(e, x, settings, exception) {
                            ajaxErrors(e, x, settings, exception);
                        },
                        complete: uploadComplete,
                        success: function(response) {
                            if (response.referData.isCoverImage ==
                                1) {
                                images.coverImg = {
                                    uploadPath: response
                                        .uploadPath,
                                    fileName: response.fileName
                                };
                            } else {
                                images.gallery.push({
                                    uploadPath: response
                                        .uploadPath,
                                    fileName: response
                                        .fileName,
                                    slno: response.referData
                                        .slno
                                });
                            }
                            console.log(images)
                        }
                    });
                }
                $("input.imageScrop").each(function(index) {
                    let id = $(this).attr('id');
                    if ($('#' + id).val() != "") {
                        rowIndex++;
                        let formData = {};
                        formData.image = $('#' + id).attr('src');
                        formData.referData = {
                            index: rowIndex,
                            id: id,
                            slno: $('#' + id).attr('data-slno'),
                            isCoverImage: $('#' + id).attr(
                                'data-is-cover-image')
                        };
                        upload(formData);
                    } else {
                        completed++;
                        let percentage = (100 * completed) / count;
                        $('#divProcessText').html(percentage +
                            '% Completed. Please wait for until upload process complete.'
                        );
                        checkUploadCompleted();
                    }
                });
            }, 200);


        });
        return uploadImages;
    }
    const checkProjectName = async (serviceName) => {
        $.ajax({
            type: "post",
            url: "{{url('/')}}/admin/master/services/check/service-name",
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            },
            data: {
                ProjectName: serviceName,
                serviceID: "<?php if ($isEdit) {echo $ProjectID;}?>"
            },
            dataType: "json",
            async: true,
            error: function(e, x, settings, exception) {
                ajaxErrors(e, x, settings, exception);
            },
            complete: function(e, x, settings, exception) {},
            success: function(response) {
                if (response.status == true) {
                    isProjectName = true;
                    $('#txtProjectName-err').html(response.message).removeClass('success');
                } else {
                    isProjectName = false;
                    $('#txtProjectName-err').html(response.message).addClass('success');
                }
            }
        });
    }
    const checkSlug = async (Slug) => {
        $.ajax({
            type: "post",
            url: "{{url('/')}}/admin/master/services/check/slug",
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            },
            data: {
                Slug: Slug,
                serviceID: "<?php if ($isEdit) {echo $ProjectID;}?>"
            },
            dataType: "json",
            async: true,
            error: function(e, x, settings, exception) {
                ajaxErrors(e, x, settings, exception);
            },
            complete: function(e, x, settings, exception) {},
            success: function(response) {

                if (response.status == true) {
                    isSlug = true;
                    $('#txtSlug-err').html(response.message).removeClass('success');
                } else {
                    isSlug = false;
                    $('#txtSlug-err').html(response.message).addClass('success');
                }
            }
        });
    }
    $(document).on('keyup', '#txtProjectName', async function() {
        let serviceName = $('#txtProjectName').val();
        if (serviceName == "") {
            $('#txtProjectName-err').html('Project name is required');
            status = false;
        } else if (serviceName.length < 3) {
            $('#txtProjectName-err').html('The service name is must be greater than 3 characters.');
            status = false;
        } else if (serviceName.length > 100) {
            $('#txtProjectName-err').html('The service name is not greater than 100 characters.');
            status = false;
        } else {
            $('#txtProjectName-err').html('');
            let slug = await serviceName.toString().slugify()
            await $('#txtSlug').val(slug);
            checkProjectName(serviceName);
            checkSlug(slug);
        }
    });
    $(document).on('change', '#txtProjectName', async function() {
        let serviceName = $('#txtProjectName').val();
        if (serviceName == "") {
            $('#txtProjectName-err').html('Project name is required');
            status = false;
        } else if (serviceName.length < 3) {
            $('#txtProjectName-err').html('The service name is must be greater than 3 characters.');
            status = false;
        } else if (serviceName.length > 100) {
            $('#txtProjectName-err').html('The service name is not greater than 100 characters.');
            status = false;
        } else {
            $('#txtProjectName-err').html('');
            let slug = await serviceName.toString().slugify()
            await $('#txtSlug').val(slug);
            checkProjectName(serviceName);
            checkSlug(slug);
        }
    });

    $(document).on('keyup', '#txtHSNSAC', async function() {
        let HSNSAC = $('#txtHSNSAC').val();
        $('#txtHSNSAC-err').html('');
        if (HSNSAC == "") {
            $('#txtHSNSAC-err').html('HSN / SAC is required');
            status = false;
        }
    });
    $(document).on('keyup', '#txtPrice', async function() {
        let Price = $('#txtPrice').val();
        $('#txtPrice-err').html('');
        if (Price == "") {
            $('#txtPrice-err').html('Price is required');
            status = false;
        } else if (!$.isNumeric(Price)) {
            $('#txtPrice-err').html('The Price is not numeric value');
            status = false;
        } else if (parseFloat(Price) < 0) {
            $('#txtPrice-err').html('The Price must be equal or greater than zero.');
            status = false;
        }
    });

    $(document).on('change', '#lstUOM', async function() {
        let UOM = $('#lstUOM').val();
        $('#lstUOM-err').html('');
        if (UOM == "") {
            $('#lstUOM-err').html('Unit of measurement is required');
            status = false;
        }
    });
    $(document).on('change', '#lstTax', async function() {
        let Tax = $('#lstTax').val();
        $('#lstTax-err').html('');
        if (Tax == "") {
            $('#lstTax-err').html('Tax is required');
            status = false;
        }
    });
    $(document).on('change', '#lstTaxType', async function() {
        let TaxType = $('#lstTaxType').val();
        $('#lstTaxType-err').html('');
        if (TaxType == "") {
            $('#lstTaxType-err').html('Tax type is required');
            status = false;
        }
    });
    $(document).on('change', '#lstCategory', function() {
        let Category = $('#lstCategory').val();
        $('#lstCategory-err').html('');
        if (Category == "") {
            $('#lstCategory-err').html('Category is required');
            status = false;
        }

    });


$(document).on('click', '#btnAddImages', function() {
    var uploadLimit = '{{ $Settings["upload-limit"] }}';
    var galleryCount = $('.gallery-item').length + 1; // Count existing gallery items

    var newGalleryItem = `
        <div class="row d-flex justify-content-center mt-20 gallery-item" id="galleryItem${galleryCount}">
            <div class="col-sm-4 text-center">
                <label>Gallery Image</label>
                <input type="file" name="gallery_images[]" id="txtGalleryImg${galleryCount}" class="dropify imageScrop"
                    data-slno="" data-is-cover-image="0" data-max-file-size="${uploadLimit}"
                    data-allowed-file-extensions="jpeg jpg png gif" required />
                <span class="errors" id="txtGalleryImg${galleryCount}-err"></span>
                <button type="button" class="btn btn-outline-danger btn-sm btnRemoveGallery mt-2"
                    data-index="${galleryCount}">Remove</button>
            </div>
        </div>`;

    $('#galleryContainer').append(newGalleryItem);

    // Initialize Dropify for the newly added input field
    setTimeout(function() {
        $('#txtGalleryImg' + galleryCount).dropify();
    }, 0);
});

$(document).on('click', '.btnRemoveGallery', function() {
    var indexToRemove = $(this).data('index');
    $('#galleryItem' + indexToRemove).remove();
});




    $(document).on('change', '.GalleryItem', function(e) {
        $(this).attr('data-new', 1);
        let slno = $(this).attr('data-slno');
        if ((slno != "") && (slno != undefined)) {
            if (jQuery.inArray(slno, DeletedGalleryImg) !== -1) {
                DeletedGalleryImg.splice(DeletedGalleryImg.indexOf(slno), 1);
            }
        }
    });
    $(document).on('click', '#divGallery .dropify-clear', function(e) {
        let slno = $(this).parent().parent().attr('data-slno');
        if ((slno != "") && (slno != undefined)) {
            DeletedGalleryImg[DeletedGalleryImg.length] = slno;
        }
    });
    appInit();
});

$(document).ready(function() {
    var uploadedImageURL;
    var URL = window.URL || window.webkitURL;
    var $dataRotate = $('#dataRotate');
    var $dataScaleX = $('#dataScaleX');
    var $dataScaleY = $('#dataScaleY');
    var options = {
        aspectRatio: 1 / 1,
        preview: '.img-preview'
    };
    var $image = $('#ImageCrop').cropper(options);
    $('#ImgCrop').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#ImgCrop').modal('hide');
    $(document).on('change', '.imageScrop', function() {
        let id = $(this).attr('id');
        $image.attr('data-id', id);
        var files = this.files;
        if (files && files.length) {

            $('#ImgCrop').modal('show');
            file = files[0];
            if (/^image\/\w+$/.test(file.type)) {
                uploadedImageName = file.name;
                uploadedImageType = file.type;
                if (uploadedImageURL) {
                    URL.revokeObjectURL(uploadedImageURL);
                }
                uploadedImageURL = URL.createObjectURL(file);
                $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
            } else {
                window.alert('Please choose an image file.');
            }
        }
    });
    $('.docs-buttons').on('click', '[data-method]', function() {
        var $this = $(this);
        var data = $this.data();
        var cropper = $image.data('cropper');
        var cropped;
        var $target;
        var result;
        if (cropper && data.method) {
            data = $.extend({}, data);
            if (typeof data.target !== 'undefined') {
                $target = $(data.target);
                if (typeof data.option === 'undefined') {
                    try {
                        data.option = JSON.parse($target.val());
                    } catch (e) {
                        console.log(e.message);
                    }
                }
            }
            cropped = cropper.cropped;
            switch (data.method) {
                case 'rotate':
                    if (cropped && options.viewMode > 0) {
                        $image.cropper('clear');
                    }
                    break;
                case 'getCroppedCanvas':
                    if (uploadedImageType === 'image/jpeg') {
                        if (!data.option) {
                            data.option = {};
                        }
                        data.option.fillColor = '#fff';
                    }
                    break;
            }
            result = $image.cropper(data.method, data.option, data.secondOption);
            switch (data.method) {
                case 'rotate':
                    if (cropped && options.viewMode > 0) {
                        $image.cropper('crop');
                    }
                    break;
                case 'scaleX':
                case 'scaleY':
                    $(this).data('option', -data.option);
                    break;
                case 'getCroppedCanvas':
                    if (result) {
                        $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);
                        if (!$download.hasClass('disabled')) {
                            download.download = uploadedImageName;
                            $download.attr('href', result.toDataURL(uploadedImageType));
                        }
                    }
                    break;
            }
        }
    });
    $('#inputImage').change(function() {
        var files = this.files;
        var file;
        if (!$image.data('cropper')) {
            return;
        }
        if (files && files.length) {
            file = files[0];
            if (/^image\/\w+$/.test(file.type)) {
                uploadedImageName = file.name;
                uploadedImageType = file.type;
                if (uploadedImageURL) {
                    URL.revokeObjectURL(uploadedImageURL);
                }
                uploadedImageURL = URL.createObjectURL(file);
                $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
                $('#inputImage').val('');
            } else {
                window.alert('Please choose an image file.');
            }
        }
    });
    $(document).on('click', '#btnUploadImage', function() {
        $('#inputImage').trigger('click')
    });
    $("#btnCropApply").on('click', function() {
        btnLoading($('#btnCropApply'));
        setTimeout(() => {
            var base64 = $image.cropper('getCroppedCanvas').toDataURL();
            var id = $image.attr('data-id');
            $('#' + id).attr('src', base64);
            $('#' + id).parent().find('img').attr('src', base64)

            $('#ImgCrop').modal('hide');
            setTimeout(() => {
                btnReset($('#btnCropApply'));
            }, 100);
        }, 100);
    });
    $('#btnCropCancel').on('click', function() {
        var id = $image.attr('data-id');
        $('#' + id).val("");
        $('#' + id).parent().find('button.dropify-clear').trigger('click');
        $('#ImgCrop').modal('hide');
    });
});
</script>
@endsection