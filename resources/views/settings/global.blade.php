@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.app_setting_global')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.app_setting_global')}}</li>
            </ol>
        </div>
    </div>
   <div class="container-fluid">
        <div class="card">
    <div class="card-body">
        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
        <div class="error_top" style="display:none"></div>

        <div class="row restaurant_payout_create">

            <div class="restaurant_payout_create-inner">

                {{--<fieldset>

                        <legend><i class="mr-3 mdi mdi-settings"></i>{{trans('lang.app_setting_global')}}</legend>

                <div class="form-group row width-100">
                    <label class="col-5 control-label">{{trans('lang.app_setting_number_setting')}}</label>
                    <div class="col-7">
                        <input type="text" class="form-control number_setting">
                        <div class="form-text text-muted">
                            {{ trans("lang.app_setting_number_setting_help") }}
                        </div>
                    </div>
                </div>

                </fieldset>--}}

                <fieldset>
                    <legend>{{trans('lang.general_settings')}}</legend>

                    <div class="form-group row width-100">
                        <label class="col-3 control-label">{{trans('lang.app_version')}}<span class="required-field"></span></label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="app_version" id="app_version">
                        </div>
                    </div>

                    <div class="form-group row width-50">
                        <label class="col-3 control-label">{{trans('lang.app_logo')}}<span class="required-field"></span></label>
                        <div class="col-7">
                            <input type="file" onChange="handleLogoFileSelect(event)" class="form-control image" id="appLogo">
                            <div class="placeholder_img_thumb app_logo_image"></div>
                        </div>
                    </div>

                    <div class="form-group row width-50">
                        <label class="col-3 control-label">{{trans('lang.app_favicon_logo')}}<span class="required-field"></span></label>
                        <div class="col-7">
                            <input type="file" onChange="handleFavIconFileSelect(event)" class="form-control image" id="faviconLogo">
                            <div class="placeholder_img_thumb app_favicon_logo_image"></div>
                        </div>
                    </div>

                </fieldset>

                <fieldset>
                    <legend>{{trans('lang.google_map_api_key_title')}}</legend>

                    <div class="form-group row width-100">
                        <label class="col-3 control-label">{{trans('lang.google_map_api_key')}}</label>
                        <div class="col-7">
                            <input type="password" class="form-control" name="map_key" id="map_key">
                        </div>
                    </div>
                    <div class="form-group row width-100">
                        <label class="col-3 control-label">{{trans('lang.google_map_secret_key')}}</label>
                        <div class="col-7">
                            <input type="password" class="form-control" name="secret_key" id="secret_key">
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>{{trans('lang.wallet_settings')}}</legend>
                    <div class="form-group row width-100">
                        <label class="col-4 control-label">{{ trans('lang.minimum_deposit_amount')}}</label>
                        <div class="col-7">
                            <div class="control-inner">
                                <input type="number" class="form-control minimum_deposit_amount">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row width-100">
                        <label class="col-4 control-label">{{ trans('lang.minimum_withdrawal_amount')}}</label>
                        <div class="col-7">
                            <div class="control-inner">
                                <input type="number" class="form-control minimum_withdrawal_amount">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>{{trans('lang.referral_settings')}}</legend>
                    <div class="form-group row width-100">
                        <label class="col-4 control-label">{{ trans('lang.referral_amount')}}</label>
                        <div class="col-7">
                            <div class="control-inner">
                                <input type="number" class="form-control referral_amount">
                                <span class="currentCurrency"></span>
                                <div class="form-text text-muted">
                                    {{ trans("lang.referral_amount_help") }}
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>{{trans('lang.delivery_distance')}}</legend>
                    <div class="form-group row width-100">
                    <label class="col-4 control-label">{{trans('lang.distance')}}</label>
                    <div class="col-7">
                        <select name="delivery_distance" id="delivery_distance" class="form-control">
                            <option value="Km">{{trans('lang.km')}}</option>
                            <option value="Miles">{{trans('lang.miles')}}</option>

                        </select>
                    </div>
                    </div>
                    <div class="form-group row width-100">
                    <label class="col-4 control-label">{{trans('lang.radius')}}</label>
                    <div class="col-7">
                        <input name="radius" id="radius" class="form-control">
                    </div>
                    </div>
                </fieldset>

                {{--<fieldset>
                    <legend>{{trans('lang.driver_nrar_to_customer_distance')}}</legend>
                    <div class="form-group row width-100">
                    <label class="col-4 control-label">{{trans('lang.distance')}} ({{trans("lang.in_km")}})</label>
                    <div class="col-7">
                      <input  type="text" name="driver_customer_distance" id="driver_customer_distance" class="form-control driver_customer_distance">
                      <div class="form-text text-muted">
                            {{ trans("lang.driver_nrar_to_customer_distance_help") }}
                        </div>  
                    </div>
                    </div>
                </fieldset>--}}

                <fieldset>
                    <legend>{{trans('lang.map_redirection')}}</legend>
                    <div class="form-group row width-100">
                        <label class="col-4 control-label">{{trans('lang.select_map_type')}}</label>
                        <div class="col-7">
                            <select name="map_type" id="map_type" class="form-control map_type">
                                <option value="">{{trans("lang.select_type")}}</option>
                                <option value="google">{{trans("lang.google_map")}}</option>
                                <option value="googleGo">{{trans("lang.google_go_map")}}</option>
                                <option value="waze">{{trans("lang.waze_map")}}</option>
                                <option value="mapswithme">{{trans("lang.mapswithme_map")}}</option>
                                <option value="yandexNavi">{{trans("lang.vandexnavi_map")}}</option>
                                <option value="yandexMaps">{{trans("lang.vandex_map")}}</option>
                                <option value="inappmap">{{trans("lang.inapp_map")}}</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row width-100">
                        <label class="col-4 control-label">{{trans('lang.driver_location_update')}}</label>
                        <div class="col-7">
                            <input name="radius" id="driver_location_update" class="form-control">
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>{{trans('lang.contact_us')}}</legend>
                    <div class="form-group row width-100">
                        <label class="col-3 control-label">{{trans('lang.email_subject')}}<span class="required-field"></span></label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="contact_us_subject" id="contact_us_subject">
                        </div>
                    </div>
                    <div class="form-group row width-50">
                        <label class="col-4 control-label">{{trans('lang.email')}}<span class="required-field"></span></label>
                        <div class="col-7">
                            <input type="text" name="contact_us_email" id="contact_us_email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row width-50">
                        <label class="col-4 control-label">{{trans('lang.contact_us_phone')}}<span class="required-field"></span></label>
                        <div class="col-7">
                            <input type="text" name="contact_us_phone_number" id="contact_us_phone_number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row width-100">
                        <label class="col-4 control-label">{{trans('lang.address')}}<span class="required-field"></span></label>
                        <div class="col-7">
                            <textarea name="contact_us_address" id="contact_us_address" class="form-control"></textarea>
                        </div>
                    </div>

                     <div class="form-group row width-100">
                        <label class="col-4 control-label">{{trans('lang.support_url')}}<span class="required-field"></span></label>
                        <div class="col-7">
                            <input type="text" name="support_url" id="support_url" class="form-control">
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    <div class="form-group col-12 text-center btm-btn">
        <button type="button" class="btn btn-primary save_global_settings_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
        <a href="{{url('/dashboard')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
        </a>
    </div>
</div>
</div>
</div>

@endsection

@section('scripts')

<script>
    var app_logo_image = '';
    var app_favicon_logo_image = '';
    var appLogoImagePath = '';
    var appFavIconImagePath = '';
    var logoFileName = '';
    var favIconFileName = '';
    var storageRef = firebase.storage().ref('images');
    var storage = firebase.storage();

    var database = firebase.firestore();
    var globalKey = database.collection('settings').doc("globalKey");
    var referralAmountRef = database.collection('settings').doc("referral");
    var globalValue = database.collection('settings').doc("globalValue");
    var contactUsRef = database.collection('settings').doc("contact_us");
    var logoRef = database.collection('settings').doc("logo");
                
    // var numberSetting = database.collection('settings').doc("numberSetting");
    var global = database.collection('settings').doc("global");
    var refCurrency = database.collection('currency').where('enable', '==', true);
    refCurrency.get().then(async function(snapshots) {
        var currencyData = snapshots.docs[0].data();
        $(".currentCurrency").text(currencyData.symbol);
    });
    $(document).ready(function() {

        jQuery("#overlay").show();

        globalKey.get().then(async function(snapshots) {
            var globalKeyData = snapshots.data();

            try {
                if (globalKeyData.googleMapKey) {
                    $("#map_key").val(globalKeyData.googleMapKey);
                }
                if (globalKeyData.serverKey) {
                    $("#secret_key").val(globalKeyData.serverKey);
                }
            } catch (error) {

            }
        })

        global.get().then(async function(snapshots) {
            var globalSetting = snapshots.data();
            if (globalSetting.appVersion) {
                $("#app_version").val(globalSetting.appVersion);
            }
            jQuery("#overlay").hide();
        })

        referralAmountRef.get().then(async function(snapshots) {

            var referralAmountData = snapshots.data();

            if (referralAmountData == undefined) {
                database.collection('settings').doc('referral').set({});
            }

            try {
                $(".referral_amount").val(referralAmountData.referralAmount);

            } catch (error) {

            }

            jQuery("#overlay").hide();
        })

        globalValue.get().then( async function(snapshots){
            var globalValueSettings = snapshots.data();
            
            if(globalValueSettings == undefined){
                database.collection('settings').doc('globalValue').set({});
            }else{

              if(globalValueSettings.distanceType){
                $("#delivery_distance").val(globalValueSettings.distanceType);
              }
              if(globalValueSettings.radius){
                $('#radius').val(globalValueSettings.radius);
              }
              if (globalValueSettings.minimumDepositToRideAccept) {
                    $(".minimum_deposit_amount").val(globalValueSettings.minimumDepositToRideAccept);    
                }
                if (globalValueSettings.minimumAmountToWithdrawal) {
                    $(".minimum_withdrawal_amount").val(globalValueSettings.minimumAmountToWithdrawal);
                }

                /*if(globalValueSettings.driverNearestToCustomerDistance){
                    $('#driver_customer_distance').val(globalValueSettings.driverNearestToCustomerDistance);
                }*/

                if (globalValueSettings.mapType) {
                    $('#map_type').val(globalValueSettings.mapType).trigger('change');
                }
                if (globalValueSettings.driverLocationUpdate) {
                    $('#driver_location_update').val(globalValueSettings.driverLocationUpdate);
                }
                
            }
            jQuery("#overlay").hide();
        })
        contactUsRef.get().then(async function(contactusSnap) {
            var contactData = contactusSnap.data();
            $("#contact_us_subject").val(contactData.subject);
            $("#contact_us_email").val(contactData.email);
            $("#contact_us_phone_number").val(contactData.phone);
            $("#contact_us_address").text(contactData.address);
            $("#support_url").val(contactData.supportURL);

        });
        logoRef.get().then(async function(snapshots) {
            var logoRefData = snapshots.data();
            if (logoRefData == undefined) {
                database.collection('settings').doc('logo').set({});
            }
            try {
                if(logoRefData.appLogo){
                    app_logo_image = logoRefData.appLogo;
                    appLogoImagePath = logoRefData.appLogo;
                    $(".app_logo_image").append('<span class="image-item"><span class="remove-btn" data-val="app_logo"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + logoRefData.appLogo + '" alt="image"></span>');
                }
                if(logoRefData.appFavIconLogo) {
                    app_favicon_logo_image = logoRefData.appFavIconLogo;
                    appFavIconImagePath = logoRefData.appFavIconLogo;
                    $(".app_favicon_logo_image").append('<span class="image-item"><span class="remove-btn" data-val="app_favicon_logo"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + logoRefData.appFavIconLogo + '" alt="image"></span>');
                }
            } catch (error) {
            }
            jQuery("#overlay").hide();
        })
       
        async function storeImageData() {
            var newPhoto = [];
            try {
                if(appLogoImagePath != "" && app_logo_image != appLogoImagePath){
                    var appLogoImagePathRef = await storage.refFromURL(appLogoImagePath);
                    imageBucket = appLogoImagePathRef.bucket;
                    var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                    if (imageBucket == envBucket) {

                        await appLogoImagePathRef.delete().then(() => {
                            console.log("Old file deleted!")
                        }).catch((error) => {
                            console.log("ERR File delete ===", error);
                        });
                    } else {
                        console.log('Bucket not matched');
                    }
                    
                }
                if(app_logo_image != appLogoImagePath){
                    app_logo_image = app_logo_image.replace(/^data:image\/[a-z]+;base64,/, "")
                    var uploadTask = await storageRef.child(logoFileName).putString(app_logo_image, 'base64', {contentType:'image/jpg'});
                    var downloadURL = await uploadTask.ref.getDownloadURL();
                    newPhoto['app_logo_image'] = downloadURL;
                    app_logo_image = downloadURL;
                }else{
                    newPhoto['app_logo_image'] = app_logo_image;
                }
                if(appFavIconImagePath != "" && app_favicon_logo_image != appFavIconImagePath){
                    var appFavIconImagePathRef = await storage.refFromURL(appFavIconImagePath);
                    imageBucket = appFavIconImagePathRef.bucket;
                    var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                    if (imageBucket == envBucket) {
                   
                    await appFavIconImagePathRef.delete().then(() => {
                        console.log("Old file deleted!")
                    }).catch((error) => {
                        console.log("ERR File delete ===", error);
                    });
                }else{
                    console.log("Bucket not matched!")
                }
                }
                if(app_favicon_logo_image != appFavIconImagePath){
                    app_favicon_logo_image = app_favicon_logo_image.replace(/^data:image\/[a-z]+;base64,/, "")
                    var uploadTask = await storageRef.child(favIconFileName).putString(app_favicon_logo_image, 'base64', {contentType:'image/jpg'});
                    var downloadURL = await uploadTask.ref.getDownloadURL();
                    newPhoto['app_favicon_logo_image'] = downloadURL;
                    app_favicon_logo_image = downloadURL;
                }else{
                    newPhoto['app_favicon_logo_image'] = app_favicon_logo_image;
                }
            } catch (error) {
                console.log("ERR ===", error);
            }
            return newPhoto;
        }


        $(".save_global_settings_btn").click(function() {
            
            // var numberSetting = $(".number_setting").val();
            var mapKey = $("#map_key").val();
            var secretKey = $("#secret_key").val();
            var app_version = $("#app_version").val();
            var referralAmount = $(".referral_amount").val();
            var distance = $("#delivery_distance :selected").val();
            var radius=$('#radius').val();
            var subject  = $("#contact_us_subject").val();
            var email = $("#contact_us_email").val();
            var phone = $("#contact_us_phone_number").val();
            var address =$("#contact_us_address").text();
            var supportURL=$('#support_url').val();
            var minimumDepositToRideAccept = $(".minimum_deposit_amount").val();
            var minimumAmountToWithdrawal = $(".minimum_withdrawal_amount").val();
            /*var driverNearestToCustomerDistance=$('#driver_customer_distance').val();*/
            var map_type = $('#map_type').val();
            var driver_location_update = $('#driver_location_update').val();

            if (app_version == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.app_version_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (referralAmount == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.enter_referral_amount_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (subject == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.please_enter_subject')}}</p>");
                window.scrollTo(0, 0);
            } else if (email == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.contact_us_email_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (phone == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.contact_us_phone_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (address == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.contact_us_address_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (supportURL == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.support_url_help')}}</p>");
                window.scrollTo(0, 0);
            }else if (app_logo_image == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.app_logo_image_help')}}</p>");
                window.scrollTo(0, 0);
            }  else if (app_favicon_logo_image == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.app_favicon_logo_image_help')}}</p>");
                window.scrollTo(0, 0);
            }else if (minimumDepositToRideAccept == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.enter_minimum_deposit_amount_error')}}</p>");
                window.scrollTo(0, 0);
            }else if (minimumAmountToWithdrawal == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.enter_minimum_withdrawal_amount_error')}}</p>");
                window.scrollTo(0, 0);
            /*}else if(driverNearestToCustomerDistance==''){
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.enter_driver_nrearest_to_customer_distnace')}}</p>");
                window.scrollTo(0, 0);*/
            }else {

                jQuery("#overlay").show();
                // database.collection('settings').doc('numberSetting').update({
                //     'decimalDigit': numberSetting
                // });
                storeImageData().then(IMG => {
                    database.collection('settings').doc('global').update({
                        'appVersion': app_version
                    });
                    database.collection('settings').doc("logo").update({
                        'appLogo': IMG.app_logo_image,
                        'appFavIconLogo': IMG.app_favicon_logo_image
                    }).then(function(result) {
                        window.location.href = '{{ url("settings/globals")}}';
                    })
                    database.collection('settings').doc("globalKey").update({
                        'googleMapKey': mapKey,
                        'serverKey': secretKey
                    }).then(function(result) {
                        window.location.href = '{{ url("settings/globals")}}';
                    })
                    database.collection('settings').doc("referral").update({
                        'referralAmount': referralAmount
                    }).then(function(result) {
                        window.location.href = '{{ url("settings/globals")}}';
                    })
                    database.collection('settings').doc("globalValue").update({
                        'distanceType': distance,
                        'radius':radius,
                        'minimumDepositToRideAccept': minimumDepositToRideAccept,
                        'minimumAmountToWithdrawal': minimumAmountToWithdrawal,
                        /*'driverNearestToCustomerDistance':driverNearestToCustomerDistance*/
                        'mapType': map_type,
                        'driverLocationUpdate': driver_location_update
                    }).then(function(result) {
                        window.location.href = '{{ url("settings/globals")}}';
                    })
                    database.collection('settings').doc("contact_us").update({
                        'subject': subject,
                        'email':email,
                        'phone':phone,
                        'address': address,
                        'supportURL':supportURL,
                    }).then(function(result) {
                        window.location.href = '{{ url("settings/globals")}}';
                    })
                }).catch(err => {
                    jQuery("#overlay").hide();
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + err + "</p>");
                    window.scrollTo(0, 0);
                });
            }
        })
    })

    function handleLogoFileSelect(evt) {
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
                app_logo_image = filePayload;
                logoFileName = filename;
                $(".app_logo_image").empty();
                $(".app_logo_image").append('<span class="image-item"><span class="remove-btn" data-val="app_logo"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + filePayload + '" alt="image"></span>');
            };
        })(f);
        reader.readAsDataURL(f);
    }
    function handleFavIconFileSelect(evt) {
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
                app_favicon_logo_image = filePayload;
                favIconFileName = filename;
                $(".app_favicon_logo_image").empty();
                $(".app_favicon_logo_image").append('<span class="image-item"><span class="remove-btn" data-val="app_favicon_logo"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + filePayload + '" alt="image"></span>');
            };
        })(f);
        reader.readAsDataURL(f);
    }
    $(document).on('click', '.remove-btn', function(){
        if($(this).attr('data-val') == "app_logo"){
            $(".app_logo_image").empty();
            app_logo_image = '';
            logoFileName = '';
        }else{
            $(".app_favicon_logo_image").empty();
            app_favicon_logo_image = '';
            favIconFileName = '';
        }
    }); 
    

</script>

@endsection
