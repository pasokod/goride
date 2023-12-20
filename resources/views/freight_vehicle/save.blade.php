@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{ trans('lang.freight_vehicle_details') }}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('lang.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('freight-vehicle') !!}">{{ trans('lang.freight_vehicles') }}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ $id == '' ? trans('lang.freight_vehicle_add') : trans('lang.freight_vehicle_edit') }}</li>
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
                                <legend>{{ trans('lang.freight_vehicle_details') }}</legend>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{ trans('lang.name') }}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control name">
                                        <div class="form-text text-muted">
                                            {{ trans('lang.name_help') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{ trans('lang.kmCharge') }}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="number" class="form-control kmCharge">
                                        <div class="form-text text-muted">
                                            {{ trans('lang.kmCharge_help') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{ trans('lang.length') }}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="number" class="form-control length">
                                        <div class="form-text text-muted">
                                            {{ trans('lang.length_help') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{ trans('lang.width') }}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="number" class="form-control width">
                                        <div class="form-text text-muted">
                                            {{ trans('lang.width_help') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{ trans('lang.height') }}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="number" class="form-control height">
                                        <div class="form-text text-muted">
                                            {{ trans('lang.height_help') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{ trans('lang.image') }}</label>
                                    <div class="col-7">
                                        <input type="file" onChange="handleFileSelect(event)" class="form-control image"
                                            id="image">
                                        <div class="placeholder_img_thumb user_image"></div>
                                        <div id="uploding_image"></div>
                                        <div class="form-text text-muted w-50">
                                            {{ trans('lang.image_help') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <div class="form-check">
                                        <input type="checkbox" class="active" id="active">
                                        <label class="col-3 control-label"
                                            for="active">{{ trans('lang.enable') }}</label>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{ trans('lang.description') }}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <textarea rows="6" id="description" class="description form-control"></textarea>
                                        <div class="form-text text-muted">
                                            {{ trans('lang.description_help') }}
                                        </div>
                                    </div>
                                </div>

                              {{--  <div class="form-group row width-50">
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
--}}


                            </fieldset>
                        </div>
                    </div>

                    <div class="form-group col-12 text-center btm-btn">
                        <button type="button" class="btn btn-primary  create_user_btn"><i class="fa fa-save"></i>
                            {{ trans('lang.save') }}</button>
                        <a href="{!! route('freight-vehicle') !!}" class="btn btn-default"><i
                                class="fa fa-undo"></i>{{ trans('lang.cancel') }}</a>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        /*function ShowHideDiv() {
            var check_global_admin_comission = $("#IsglobalAdminComission").is(":checked");
            if (check_global_admin_comission) {
                $("#comissionType").hide();
                $("#comission").hide();
            } else {
                $("#comissionType").show();
                $("#comission").show();
            }
        }*/
        var database = firebase.firestore();

        var requestId = "{{ $id }}";
        var id = (requestId == '') ? database.collection("tmp").doc().id : requestId;
        var storageRef = firebase.storage().ref('images');
        var storage = firebase.storage();
        var photo = "";
        var fileName = "";
        var ImageFile = '';
        var placeholderImage = "{{ asset('/images/default_user.png') }}";
        $(document).ready(function() {

            $('.freight_menu').addClass('active');
            $(document).ready(function() {

                $('.freight_sub_menu li').each(function() {
                    var url = $(this).find('a').attr('href');
                    if (url == document.referrer) {
                        $(this).find('a').addClass('active');
                        $('.freight_menu').addClass('active').attr('aria-expanded', true);
                    }
                    $('.freight_sub_menu').addClass('in').attr('aria-expanded', true);
                });
                if (requestId != '') {
                    jQuery("#overlay").show();
                    var ref = database.collection('freight_vehicle').where("id", "==", id);
                    ref.get().then(async function(snapshots) {
                        var data = snapshots.docs[0].data();
                        console.log(data);
                        $(".name").val(data.name);
                        $(".kmCharge").val(data.kmCharge);
                        $(".length").val(data.length);
                        $('.width').val(data.width);
                        $('.height').val(data.height);
                        $('.description').val(data.description);
                        /*if (data.isGlobalAdminCommission) {
                            $("#IsglobalAdminComission").prop('checked', true);
                        }
                        if (data.isGlobalAdminCommission) {
                            $("#comissionType").hide();
                            $("#comission").hide();
                        } else {
                            $("#commission_type").val(data.commissionType);
                            $(".commission").val(data.commissionAmount);
                        }*/
                        if (data.image != '' && data.image != null) {
                            photo = data.image;
                            ImageFile = data.image;
                            $(".user_image").append(
                                '<img class="rounded" style="width:50px" src="' + data
                                .image + '" alt="image">');
                        } else {
                            $(".user_image").append(
                                '<img class="rounded" style="width:50px" src="' +
                                placeholderImage + '" alt="image">');
                        }
                        if (data.enable) {
                            $('.active').prop('checked', true);
                        }
                        jQuery("#overlay").hide();
                    })
                }
            });
        });

        $(".create_user_btn").click(function() {

            var name = $(".name").val();
            var kmCharge = $(".kmCharge").val();
            var length = $(".length").val();
            var height = $(".height").val();
            var width = $(".width").val();
            var description = $(".description").val();
            var enable = false;
            if ($(".active").is(':checked')) {
                enable = true;
            }

           /* var comission = false;
            if ($("#IsglobalAdminComission").is(":checked")) {
                comission = true;
            }
            var isGlobalAdminCommission = $("#IsglobalAdminComission").is(":checked") ? true : false;
            if (isGlobalAdminCommission == false) {
                var comission_type = $("#commission_type :selected").val();
                var admin_comission = $(".commission").val();
            } else {
                var comission_type = '';
                var admin_comission = '';
            }*/


            if (name == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{ trans('lang.name_help') }}</p>");
                window.scrollTo(0, 0);
            }
            else if (kmCharge == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{ trans('lang.kmCharge_help') }}</p>");
                window.scrollTo(0, 0);
            } else if (length == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{ trans('lang.length_help') }}</p>");
                window.scrollTo(0, 0);
            } else if (height == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{ trans('lang.height_help') }}</p>");
                window.scrollTo(0, 0);
            } else if (width == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{ trans('lang.width_help') }}</p>");
                window.scrollTo(0, 0);
            } else if (description == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{ trans('lang.description_help') }}</p>");
                window.scrollTo(0, 0);
            } else {
                requestId == '' ?
                    (storeImageData().then(IMG => {
                        database.collection('freight_vehicle').doc(id).set({
                            'id': id,
                            'name': name,
                            'length': length,
                            'height': height,
                            'width': width,
                            'kmCharge': kmCharge,
                            'enable': enable,
                            'description': description,
                            'image': IMG,
                        }).then(function(result) {
                            window.location.href = '{{ route('freight-vehicle') }}';
                        }).catch(function(error) {
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>" + error + "</p>");
                        })
                    }).catch(function(error) {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + error + "</p>");
                    }))

                    :
                    (storeImageData().then(IMG => {

                        database.collection('freight_vehicle').doc(id).update({
                            'name': name,
                            'length': length,
                            'height': height,
                            'width': width,
                            'kmCharge': kmCharge,
                            'enable': enable,
                            'description': description,
                            'image': IMG,
                        }).then(function(result) {
                            window.location.href = '{{ route('freight-vehicle') }}';
                        }).catch(function(error) {
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>" + error + "</p>");
                        })
                    }).catch(function(error) {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + error + "</p>");
                    }))

            }
        })

        async function storeImageData() {
            var newPhoto = '';
            try {
                if (ImageFile != "" && photo != ImageFile) {
                    var OldImageUrlRef = await storage.refFromURL(ImageFile);
                    imageBucket= OldImageUrlRef.bucket;
                    var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                    if (imageBucket == envBucket) {

                        await OldImageUrlRef.delete().then(() => {
                            console.log("Old file deleted!")
                        }).catch((error) => {
                            console.log("ERR File delete ===", error);
                        });
                    }else{
                        console.log('Bucket not matched');
                  }

                }
                if (photo != ImageFile) {
                    photo = photo.replace(/^data:image\/[a-z]+;base64,/, "")
                    var uploadTask = await storageRef.child(fileName).putString(photo, 'base64', {
                        contentType: 'image/jpg'
                    });
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

        function handleFileSelect(evt) {
            var f = evt.target.files[0];
            var reader = new FileReader();
            reader.onload = (function(theFile) {

                return function(e) {

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
                    $(".user_image").append(
                        '<span class="image-item" id="photo_user"><span class="remove-btn" data-id="user-remove" data-img="' +
                        photo +
                        '"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' +
                        photo + '" alt="image"></span>');

                };
            })(f);
            reader.readAsDataURL(f);
        }

        $(document).on("click", ".remove-btn", function() {
            $(".image-item").remove();
            $('#image').val('');
        });
    </script>
@endsection
