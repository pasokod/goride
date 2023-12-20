@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.driver_plural')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('drivers') !!}">{{trans('lang.driver_plural')}}</a>
                </li>
                <li class="breadcrumb-item active">{{trans('lang.driver_edit')}}</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card  pb-4">
            <div class="card-body">

                <div class="error_top"></div>
                <div class="row restaurant_payout_create">
                    <div class="restaurant_payout_create-inner">
                        <fieldset>
                            <legend>{{trans('lang.driver_details')}}</legend>
                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.user_name')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control user_name">
                                    <div class="form-text text-muted">
                                        {{ trans("lang.user_name_help") }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.email')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control user_email">
                                    <div class="form-text text-muted">
                                        {{ trans("lang.user_email_help") }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row width-50" id="phone-box">
                                <label class="col-3 control-label">{{trans('lang.country_code')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <select name="country" id="country_selector" class="form-control country_code">
                                        <option value="">{{ trans("lang.user_country_code_help") }}</option>
                                        @foreach($countries_data as $country)
                                        <option value="{{$country->phoneCode}}">{{$country->countryName}}
                                            (+{{$country->phoneCode}})
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text text-muted">
                                        {{ trans("lang.user_country_code_help") }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.user_phone')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control user_phone">
                                    <div class="form-text text-muted w-50">
                                        {{ trans("lang.user_phone_help") }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.user_service')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <select id='user_service' class="form-control" required>
                                        <option value="">{{trans('lang.user_service_help')}}</option>
                                    </select>
                                    <div class="form-text text-muted">
                                        {{ trans("lang.user_service_help") }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <div class="col-12">
                                    <h6>{{ trans("lang.know_your_cordinates") }} <a target="_blank"
                                                                                    href="https://www.latlong.net/">{{
                                            trans("lang.latitude_and_longitude_finder") }}</a></h6>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.user_latitude')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="number" class="form-control user_latitude">
                                    <div class="form-text text-muted">{{trans('lang.user_latitude_help')}}</div>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.user_longitude')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="number" class="form-control user_longitude">
                                    <div class="form-text text-muted">{{trans('lang.user_longitude_help')}}</div>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.profile_image')}}</label>
                                <div class="col-7">
                                    <input type="file" onChange="handleFileSelect(event)" class="" id="userImage">
                                    <div class="form-text text-muted">{{trans('lang.profile_image_help')}}</div>
                                </div>
                                <div class="placeholder_img_thumb user_image"></div>
                                <div id="uploding_image"></div>
                            </div>

                            <div class="form-check width-100">
                                <input type="checkbox" class="col-7 form-check-inline is_active" id="is_active">
                                <label class="col-3 control-label"
                                       for="is_active">{{trans('lang.document_verification')}}</label>
                            </div>
                        </fieldset>
                        <!-- <fieldset>
                          <legend>{{trans('driver')}} {{trans('lang.active_deactive')}}</legend>
                          <div class="form-group row">
                            <div class="form-group row width-50">
                                <div class="form-check width-100">
                                  <input type="checkbox" id="is_active">
                                  <label class="col-3 control-label" for="is_active">{{trans('lang.active')}}</label>
                                </div>
                            </div>
                          </div>
                        </fieldset> -->
                        <fieldset>
                            <legend>{{trans('lang.vehicle_information')}}</legend>
                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.seats')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control vehicle_seats">
                                    <div class="form-text text-muted">{{trans('lang.vehicle_seats_help')}}</div>
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.type')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <select id='vehicle_type' class="form-control" required>
                                        <option value="">{{trans('lang.vehicle_type_help')}}</option>
                                    </select>
                                    <div class="form-text text-muted">
                                        {{ trans("lang.vehicle_type_help") }}
                                    </div>
                                </div>
                            </div>
                            @php
                            $colorArray = ['Red', 'Black', 'White', 'Blue', 'Green', 'Orange', 'Silver', 'Gray',
                            'Yellow', 'Brown', 'Gold', 'Beige', 'Purple'];
                            @endphp
                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.vehicle_color')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <select name="vehicle_color" id="colorPicker"
                                            class="form-control vehicle_color">
                                        @foreach($colorArray as $color)
                                        <option value="{{$color}}">{{$color}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-text text-muted">{{trans('lang.vehicle_color_help')}}</div>
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.vehicle_number')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control vehicle_number" name="vehicle_number">
                                    <div class="form-text text-muted">{{trans('lang.vehicle_number_help')}}</div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>{{trans('lang.bank_details')}}</legend>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.bank_name')}}<span
                                    ></span></label>
                                <div class="col-7">
                                    <input type="text" id='bank_name' class="form-control bank_name" required>
                                    <div class="form-text text-muted">
                                        {{ trans("lang.bank_name_help") }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.branch_name')}}<span
                                    ></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control branch_name" name="branch_name">
                                    <div class="form-text text-muted">{{trans('lang.branch_name_help')}}</div>
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.holder_name')}}<span
                                    ></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control holder_name" name="holder_name">
                                    <div class="form-text text-muted">{{trans('lang.holder_name_help')}}</div>
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.account_number')}}<span
                                    ></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control account_number">
                                    <div class="form-text text-muted">{{trans('lang.account_number_help')}}</div>
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.other_info')}}<span
                                    ></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control other_info" name="other_info">
                                    <div class="form-text text-muted">{{trans('lang.other_info_help')}}</div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary save_driver_btn"><i class="fa fa-save"></i> {{
                        trans('lang.save')}}
                    </button>
                    <a href="{!! route('drivers') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{
                        trans('lang.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>


    var database = firebase.firestore();
    var photo = "";
    var fileName = "";
    var userImageFile = "";
    var service_list = [];
    var vehicle_type = [];
    var is_active_deactivate = false;
    var id = "{{$id}}";
    var placeholderImage = "{{ asset('/images/default_user.png') }}";
    var ref = database.collection('driver_users').where("id", "==", id);
    var bankRef = database.collection('bank_details').where("userId", "==", id);
    var storageRef = firebase.storage().ref('images');
    var storage = firebase.storage();
    console.log(storage.app.options_.storageBucket);
    var stringToColour = function (str) {
        var hash = 0;
        for (var i = 0; i < str.length; i++) {
            hash = str.charCodeAt(i) + ((hash << 5) - hash);
        }
        var colour = '#';
        for (var i = 0; i < 3; i++) {
            var value = (hash >> (i * 8)) & 0xFF;
            colour += ('00' + value.toString(16)).substr(-2);
        }
        return colour;
    };

    async function storeImageData() {
        var newPhoto = '';
        try {
            if (userImageFile != "" && photo != userImageFile) {
                var userOldImageUrlRef = await storage.refFromURL(userImageFile);
                imageBucket= userOldImageUrlRef.bucket;
                var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";
                if (imageBucket == envBucket) {

                await userOldImageUrlRef.delete().then(() => {
                    console.log("Old file deleted!")
                }).catch((error) => {
                    console.log("ERR File delete ===", error);
                });
             }else{
                        console.log('Bucket not matched');
                  }

            }
            if (photo != userImageFile) {
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

    $(document).ready(function () {
        $('.driver_menu').addClass('active');
        //  $('.all_driver_menu').addClass('active');
        jQuery("#country_selector").select2({
            placeholder: "Select Country",
            allowClear: true
        });
        jQuery("#overlay").show();
        database.collection('service').where('enable', '==', true).get().then(async function (snapshots) {
            snapshots.docs.forEach((listval) => {
                var data = listval.data();
                service_list.push(data);
                $('#user_service').append($("<option></option>")
                    .attr("value", data.id)
                    .text(data.title));
            })
        });
        database.collection('vehicle_type').where('enable', '==', true).get().then(async function (snapshots) {
            snapshots.docs.forEach((listval) => {
                var data = listval.data();
                vehicle_type.push(data);
                $('#vehicle_type').append($("<option></option>")
                    .attr("value", data.id)
                    .attr("data-name", data.name)
                    .text(data.name));
            })

            $('.driver_sub_menu li').each(function () {

                var url = $(this).find('a').attr('href');

                if (url == document.referrer) {
                    $(this).find('a').addClass('active');
                    $('.driver_menu').addClass('active').attr('aria-expanded', true);

                }
                $('.driver_sub_menu').addClass('in').attr('aria-expanded', true);

            });
        });

        bankRef.get().then(async function (snapshots) {

            if (snapshots.docs.length > 0) {
                var bankData = snapshots.docs[0].data();
                $('.bank_name').val(bankData.bankName);
                $('.branch_name').val(bankData.branchName);
                $('.holder_name').val(bankData.holderName);
                $('.account_number').val(bankData.accountNumber);
                $('.other_info').val(bankData.otherInformation);
            }
        })
        ref.get().then(async function (snapshots) {
            var driverUser = snapshots.docs[0].data();
            $(".user_name").val(driverUser.fullName);
            $(".user_email").val(driverUser.email);
            var countryCode = driverUser.countryCode.includes('+') ? driverUser.countryCode.slice(1) : driverUser.countryCode;
            $("#country_selector").val(countryCode).trigger('change');
            $(".user_phone").val(driverUser.phoneNumber);
            $("#user_service option[value='" + driverUser.serviceId + "']").attr("selected", "selected");
            $(".user_latitude").val(driverUser.location && driverUser.location.latitude ? driverUser.location.latitude : '');
            $(".user_longitude").val(driverUser.location && driverUser.location.longitude ? driverUser.location.longitude : '');
            if (driverUser.documentVerification) {
                $("#is_active").prop("checked", true);
            }
            if (driverUser.vehicleInformation) {
                $(".vehicle_seats").val(driverUser.vehicleInformation.seats ? driverUser.vehicleInformation.seats : '');
                if (driverUser.vehicleInformation.vehicleTypeId) {
                    $("#vehicle_type option[value='" + driverUser.vehicleInformation.vehicleTypeId + "']").attr("selected", "selected");
                }
                if (driverUser.vehicleInformation.vehicleColor) {
                    $(".vehicle_color option[value='" + driverUser.vehicleInformation.vehicleColor + "']").attr("selected", "selected");
                }
                // $(".vehicle_color").val(driverUser.vehicleInformation.vehicleColor ? (driverUser.vehicleInformation.vehicleColor.includes('#') ? driverUser.vehicleInformation.vehicleColor : stringToColour(driverUser.vehicleInformation.vehicleColor)) : '');
                $(".vehicle_number").val(driverUser.vehicleInformation.vehicleNumber ? driverUser.vehicleInformation.vehicleNumber : '');
            }
            if (driverUser.profilePic != '' && driverUser.profilePic != null) {
                $(".user_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + driverUser.profilePic + '" alt="image"></span>');
                photo = driverUser.profilePic;
                userImageFile = driverUser.profilePic;
                //console.log(storage.refFromURL(userImageFile));

            } else {
                photo = "";
                $(".user_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image"></span>');
            }
            jQuery("#overlay").hide();
        })

        $(".save_driver_btn").click(function () {

            var userName = $(".user_name").val();
            var email = $(".user_email").val();
            var countryCode = $("#country_selector :selected").val();
            var userPhone = $(".user_phone").val();
            var userService = $("#user_service :selected").val();
            var userLatitude = parseFloat($(".user_latitude").val());
            var userLongitude = parseFloat($(".user_longitude").val());
            var active = $(".is_active").is(":checked");
            var bankName = $('.bank_name').val();
            var branchName = $('.branch_name').val();
            var holderName = $('.holder_name').val();
            var accountNumber = $('.account_number').val();
            var otherInfo = $('.other_info').val();
            is_active_deactivate = false;
            if ($("#is_active").is(':checked')) {
                is_active_deactivate = true;
            }
            var vehicleSeats = $(".vehicle_seats").val();
            var vehicleType = $("#vehicle_type :selected").val();
            var vehicleTypeName = $("#vehicle_type :selected").attr('data-name');
            var vehicleColor = $(".vehicle_color :selected").val();
            var vehicleNumber = $(".vehicle_number").val();
            if (userName == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_name_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (email == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_email_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (countryCode == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_country_code_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (userPhone == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_phone_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (userService == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_service_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (isNaN(userLatitude) || userLatitude == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_latitude_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (isNaN(userLongitude) || userLongitude == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_longitude_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (vehicleSeats == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.vehicle_seats_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (vehicleType == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.vehicle_type_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (vehicleColor == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.vehicle_color_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (vehicleNumber == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.vehicle_number_help')}}</p>");
                window.scrollTo(0, 0);
            } else {
                jQuery("#overlay").show();
                storeImageData().then(IMG => {
                    database.collection('driver_users').doc(id).update({
                        'documentVerification': is_active_deactivate,
                        'location.longitude': userLongitude,
                        'location.latitude': userLatitude,
                        'profilePic': IMG,
                        'email': email,
                        'serviceId': userService,
                        'countryCode': '+' + countryCode,
                        'fullName': userName,
                        'vehicleInformation.vehicleTypeId': vehicleType,
                        'vehicleInformation.vehicleColor': vehicleColor,
                        'vehicleInformation.vehicleNumber': vehicleNumber,
                        'vehicleInformation.vehicleType': vehicleTypeName,
                        'vehicleInformation.seats': vehicleSeats,
                        'phoneNumber': userPhone,
                    }).then(function (result) {
                        bankRef.get().then(async function (snapshots) {
                            if (snapshots.docs.length > 0) {
                                database.collection('bank_details').doc(id).update({
                                    'bankName': bankName,
                                    'branchName': branchName,
                                    'holderName': holderName,
                                    'accountNumber': accountNumber,
                                    'holderName': holderName,
                                    'otherInformation': otherInfo
                                }).then(function (result) {
                                    jQuery("#overlay").hide();
                                    window.location.href = '{{ route("drivers") }}';
                                })
                            } else {
                                database.collection('bank_details').doc(id).set({
                                    'bankName': bankName,
                                    'branchName': branchName,
                                    'holderName': holderName,
                                    'accountNumber': accountNumber,
                                    'holderName': holderName,
                                    'otherInformation': otherInfo,
                                    'userId': id
                                }).then(function (result) {
                                    jQuery("#overlay").hide();
                                    window.location.href = '{{ route("drivers") }}';
                                })
                            }
                        })

                    }).catch(err => {
                        jQuery("#overlay").hide();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + err + "</p>");
                        window.scrollTo(0, 0);
                    });
                }).catch(err => {
                    jQuery("#overlay").hide();
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + err + "</p>");
                    window.scrollTo(0, 0);
                });
            }
        })
    });

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
                $(".user_image").empty();
                $(".user_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + filePayload + '" alt="image"></span>');
            };
        })(f);
        reader.readAsDataURL(f);
    }

    $(document).on('click', '.remove-btn', function () {
        $(".user_image").empty();
        photo = '';
    });
    
</script>
@endsection
