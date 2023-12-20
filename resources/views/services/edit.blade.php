@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.service_plural')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('services') !!}">{{trans('lang.service_plural')}}</a>
                </li>
                <li class="breadcrumb-item active">{{trans('lang.service_edit')}}</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card pb-4">
            <div class="card-body">

                <div class="error_top"></div>

                <div class="row restaurant_payout_create">
                    <div class="restaurant_payout_create-inner">
                        <fieldset>
                            <legend>{{trans('lang.service_details')}}</legend>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.service_title')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control service_title">
                                    <div class="form-text text-muted">
                                        {{ trans("lang.service_title_help") }}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row width-50">
                                <label class="col-3 control-label global_value_label"></label>
                                <div class="col-7">
                                    <input type="number" class="form-control km_charge" min="0">
                                    <div class="form-text text-muted w-50 global_value_text">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="distanceType"/>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.image')}}</label>
                                <div class="col-7">
                                    <input type="file" onChange="handleFileSelect(event)"
                                           class="form-control image" id="service_image">
                                    <div class="placeholder_img_thumb service_image"></div>
                                    <div id="uploding_image"></div>
                                </div>
                            </div>



                            <div class="form-group row width-50">
                                <div class="form-check">
                                    <input type="checkbox" class="service_active" id="active">
                                    <label class="col-3 control-label" for="active">{{trans('lang.enable')}}</label>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <div class="form-check">
                                    <input type="checkbox" class="intercity_type" id="intercityType">
                                    <label class="col-3 control-label"
                                           for="intercityType">{{trans('lang.service_intercity')}}</label>
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <div class="form-check">
                                    <input type="checkbox" class="offer_rate" id="offer_rate">
                                    <label class="col-3 control-label"
                                           for="offer_rate">{{trans('lang.enable_offer_rate')}}</label>
                                </div>
                            </div>

                             <div class="form-group row width-50">
                                    <div class="form-check">
                                        <input type="checkbox" class="IsglobalAdminComission" id="IsglobalAdminComission"
                                            onclick="ShowHideDiv()">
                                        <label class="col-3 control-label"
                                            for="IsglobalAdminComission">{{ trans('lang.IsglobalAdminComossion') }}</label>
                                    </div>
                            </div>
                            <div class="form-group row width-50" id="comissionType">
                                    <label class="col-4 control-label">{{ trans('lang.commission_type') }}</label>
                                    <div class="col-7">
                                        <select class="form-control commission_type" id="commission_type">
                                            <option value="fix">{{ trans('lang.fixed') }}</option>
                                            <option value="percentage">{{ trans('lang.percentage') }}</option>
                                        </select>
                                    </div>
                            </div>

                                <div class="form-group row width-50" id="comission">
                                    <label class="col-4 control-label">{{ trans('lang.admin_commission') }}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="number" class="form-control commission">
                                    </div>
                                </div>

                        </fieldset>
                    </div>
                </div>

                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary  save_service_btn"><i class="fa fa-save"></i> {{
                        trans('lang.save')}}
                    </button>
                    <a href="{!! route('services') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{
                        trans('lang.cancel')}}</a>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>

    var id = "<?php echo $id;?>";
    var database = firebase.firestore();
    var ref = database.collection('service').where("id", "==", id);
    var storageRef = firebase.storage().ref('images');
    var storage = firebase.storage();
    var photo = "";
    var fileName = "";
    var serviceImageFile = '';
    var append_list = '';
    var placeholderImage = "{{ asset('/images/default_user.png') }}";
    function ShowHideDiv() {
            let enableCommision = $("#IsglobalAdminComission").is(":checked");
            if (enableCommision) {
                $("#comissionType").hide();
                $("#comission").hide();
            } else {
                $("#comissionType").show();
                $("#comission").show();
            }
        }

    $(document).ready(function () {
        $('.ride_sub_menu li').each(function () {
            var url = $(this).find('a').attr('href');
            if (url == document.referrer) {
                $(this).find('a').addClass('active');
                $('.rides_menu').addClass('active').attr('aria-expanded', true);
            }
            $('.ride_sub_menu').addClass('in').attr('aria-expanded', true);
        });

        jQuery("#overlay").show();
        ref.get().then(async function (snapshots) {
            var data = snapshots.docs[0].data();
            console.log(data);
            console.log(data.adminCommission.isEnabled);
            if(data.enable)
            {
                {{-- $("#IsglobalAdminComission").prop('checked',true);
                    $("#comissionType").hide();
                    $("#comission").hide(); --}}
   
            }
            if(data.hasOwnProperty('adminCommission')){
            
                if(data.adminCommission.isEnabled)
                {
                    $("#IsglobalAdminComission").prop('checked',true);
                    $("#comissionType").hide();
                    $("#comission").hide();
                }else{
                    $("#commission_type").val(data.adminCommission.type);
                    $(".commission").val(data.adminCommission.amount);
                }
            }
            $(".service_title").val(data.title);
            $(".km_charge").val(data.kmCharge);
            if (data.offerRate) {
                $('.offer_rate').prop('checked', true);
            }
            if (data.enable) {
                $('.service_active').prop('checked', true);
            }
            $('.intercity_type').prop('checked', data.intercityType ? true : false);
            photo = data.image;
            if (photo != '') {

                $(".service_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + photo + '" alt="image">');
                serviceImageFile = data.image;
            } else {
                photo = "";
                $(".service_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image">');
            }
            jQuery("#overlay").hide();
        });
    });

    async function storeImageData() {
        var newPhoto = '';
        try {
            if (serviceImageFile != "" && photo != serviceImageFile) {
                var serviceOldImageUrlRef = await storage.refFromURL(serviceImageFile);
                imageBucket= serviceOldImageUrlRef.bucket;
                var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                if(imageBucket==envBucket){

                    await serviceOldImageUrlRef.delete().then(() => {
                        console.log("Old file deleted!")
                    }).catch((error) => {
                        console.log("ERR File delete ===", error);
                    });

                }else{
                    console.log('Bucket not matched');
                }

            }
            if (photo != serviceImageFile) {
                photo = photo.replace(/^data:image\/[a-z]+;base64,/, "")
                var uploadTask = await storageRef.child(fileName).putString(photo, 'base64', {contentType: 'image/jpg'});
                var downloadURL = await uploadTask.ref.getDownloadURL();
                newPhoto = downloadURL;
                photo = downloadURL;
            } else {
                newPhoto = photo;
            }
        } catch (error) {
            console.log("ERR ===", error);
        }
        return newPhoto;
    }

    $(".save_service_btn").click(function () {
        
        var title = $(".service_title").val();
        var kmCharge = $(".km_charge").val();

        var enable = false;
        if ($(".service_active").is(':checked')) {
            enable = true;
        }
        var offerRate = false;
        if ($(".offer_rate").is(':checked')) {
            offerRate = true;
        }

        // var admin_comission = $(".commission").val();
        // var comission_type = $("#commission_type").val();
       

        var isGlobalAdminCommission = $("#IsglobalAdminComission").is(":checked")? true:false;
        if(isGlobalAdminCommission == false) {
            var comission_type = $("#commission_type :selected").val();
            var admin_comission = $(".commission").val();
        }else{
            var comission_type = '';
            var admin_comission = '';
        }
        var adminCommission = {'isEnabled': isGlobalAdminCommission, 'type': comission_type, 'amount':admin_comission};

        var intercityType = $(".intercity_type").is(':checked') ? true : false;
        if (title == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.service_title_error')}}</p>");
            window.scrollTo(0, 0);
        } else if (admin_comission == '' && isGlobalAdminCommission == false) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{ trans('lang.commission_help') }}</p>");
                window.scrollTo(0, 0);
            } 
        else if (kmCharge == '' || kmCharge <= 0) {
            $(".error_top").show();
            $(".error_top").html("");
            type = document.getElementById("distanceType").value;
            $(".error_top").append("<p>{{trans('lang.please_enter_valid')}} " + type + " {{trans('lang.charge')}}</p>");
            window.scrollTo(0, 0);
        } else {
            jQuery("#overlay").show();

            storeImageData().then(IMG => {
                database.collection('service').doc(id).update({

                    'title': title,
                    'offerRate': offerRate,
                    'kmCharge': kmCharge,
                    'image': IMG,
                    'enable': enable,
                    'intercityType': intercityType,
                    'adminCommission':adminCommission,
                }).then(function (result) {
                    jQuery("#overlay").hide();

                    window.location.href = '{{ route("services")}}';
                });
            }).catch(function (error) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>" + error + "</p>");
            });
        }
    });

                        {{-- 'adminCommission.isEnabled': comission,
                    'adminCommission.amount': admin_comission,
                    'adminCommission.type': comission_type,
                    'isGlobalAdminCommission':comission --}}

    function handleFileSelect(evt) {

        var f = evt.target.files[0];
        var reader = new FileReader();

        reader.onload = (function (theFile) {
            return function (e) {

                var filePayload = e.target.result;
                var val = f.name;
                var ext = val.split('.')[1];
                var docName = val.split('fakepath')[1];
                var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                var timestamp = Number(new Date());
                var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                photo = filePayload;
                fileName = filename;
                $(".service_image").empty();
                $(".service_image").append('<span class="image-item" ><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + filePayload + '" alt="image"></span>');

            };
        })(f);
        reader.readAsDataURL(f);
    }

    $(document).on('click', '.remove-btn', function () {
        $(".image-item").remove();
        $('#service_image').val('');
    });


</script>
@endsection
