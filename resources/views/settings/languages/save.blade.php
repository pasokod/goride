@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.languages')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{!! route('settings.languages') !!}">{{trans('lang.languages')}}</a></li>
                    <li class="breadcrumb-item active">{{$id==''? trans('lang.add_language') : trans('lang.edit_languages')}}</li>
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
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.name')}}<span
                                                class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control title" id="title">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.name_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.code')}}<span
                                                class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control code" id="code">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.code_help") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.image')}}<span
                                                class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="file" onChange="handleFileSelect(event)" class="" id="flagImage">
                                        <div class="form-text text-muted">{{trans('lang.flag_help')}}</div>
                                    </div>
                                    <div class="placeholder_img_thumb flag_image"></div>
                                    <div id="uploding_image"></div>
                                </div>

                                <div class="form-group row width-50">
                                    <div class="form-check">
                                        <input type="checkbox" class="is_active" id="is_active">
                                        <label class="col-3 control-label"
                                               for="is_active">{{trans('lang.active')}}</label>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <div class="form-check">
                                        <input type="checkbox" class="is_rtl" id="is_rtl">
                                        <label class="col-3 control-label" for="is_rtl">{{trans('lang.is_rtl')}}</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary  create_user_btn"><i
                                class="fa fa-save"></i> {{ trans('lang.save')}}</button>
                    <a href="{!! url('settings/languages') !!}" class="btn btn-default"><i
                                class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        var database = firebase.firestore();
        var storageRef = firebase.storage().ref('language');
        var storage = firebase.storage();
        var placeholderImage = "{{ asset('/images/default_user.png') }}";
        var photo = "";
        var fileName = "";
        var requestId = "{{$id}}";
        var flagImageFile = '';

        $(document).ready(function () {
            $('.language_sub_menu li').each(function () {
                var url = $(this).find('a').attr('href');
                if (url == document.referrer) {
                    $(this).find('a').addClass('active');
                    $('.language_menu').addClass('active').attr('aria-expanded', true);
                }
                $('.language_sub_menu').addClass('in').attr('aria-expanded', true);
            });
            if (requestId != '') {
                jQuery("#overlay").show();
                var ref = database.collection('languages').where("id", "==", requestId);
                ref.get().then(async function (snapshots) {
                    var data = snapshots.docs[0].data();
                    $("#title").val(data.name);
                    $("#code").val(data.code);

                    if (data.enable) {
                        $("#is_active").prop("checked", true);
                    }
                    if (data.isRtl) {
                        $('#is_rtl').prop('checked', true);
                    }

                    if (data.image != '' && data.image != null) {
                        $(".flag_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + data.image + '" alt="image"></span>');
                        photo = data.image;
                        flagImageFile = data.image;
                    } else {

                        photo = "";
                        $(".flag_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image"></span>');
                    }
                    jQuery("#overlay").hide();
                })
            }
        });

        $(".create_user_btn").click(function () {

            var title = $("#title").val();
            var code = $("#code").val();

            var active = $(".is_active").is(":checked");
            var is_rtl = $(".is_rtl").is(":checked");
            if (title == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.name_error')}}</p>");
                window.scrollTo(0, 0);

            } else if (code == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.code_error')}}</p>");
                window.scrollTo(0, 0);
            } else {

                var id = database.collection("tmp").doc().id;
                jQuery("#overlay").show();
                (requestId == '') ?
                    (storeImageData().then(IMG => {
                        database.collection('languages').doc(id).set({
                            'name': title,
                            'code': code,
                            'enable': active,
                            'isRtl': is_rtl,
                            'image': IMG,
                            'id': id,
                            'isDeleted': false,
                        }).then(function (result) {
                            jQuery("#overlay").hide();
                            window.location.href = '{{ route("settings.languages") }}';
                        });
                    }).catch(err => {
                        jQuery("#overlay").hide();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + err + "</p>");
                        window.scrollTo(0, 0);
                    }))
                    : (storeImageData().then(IMG => {
                        database.collection('languages').doc(requestId).update({
                            'name': title,
                            'code': code,
                            'enable': active,
                            'isRtl': is_rtl,
                            'image': IMG,
                            'isDeleted': false,

                        }).then(function (result) {
                            jQuery("#overlay").hide();
                            window.location.href = '{{ route("settings.languages") }}';
                        });
                    }).catch(err => {
                        jQuery("#overlay").hide();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + err + "</p>");
                        window.scrollTo(0, 0);
                    }));
            }

        });

        async function storeImageData() {
            var newPhoto = '';
            if (requestId == '') {
                try {
                    photo = photo.replace(/^data:image\/[a-z]+;base64,/, "")
                    var uploadTask = await storageRef.child(fileName).putString(photo, 'base64', {contentType: 'image/jpg'});
                    var downloadURL = await uploadTask.ref.getDownloadURL();
                    newPhoto = downloadURL;
                    photo = downloadURL;
                } catch (error) {
                    console.log("ERR ===", error);
                }
            } else {

                try {
                    if (flagImageFile != "" && photo != flagImageFile) {
                        var flagOldImageUrlRef = await storage.refFromURL(flagImageFile);
                        imageBucket= flagOldImageUrlRef.bucket;
                        var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                        if (imageBucket == envBucket) {
                            await flagOldImageUrlRef.delete().then(() => {
                                console.log("Old file deleted!")
                            }).catch((error) => {
                                console.log("ERR File delete ===", error);
                            });
                        }else{
                            console.log('Bucket not matched');
                        }
                       
                    }
                    if (photo != flagImageFile) {
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
            }
            return newPhoto;
        }

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
                    $(".flag_image").empty();
                    $(".flag_image").append('<span class="image-item" ><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + filePayload + '" alt="image"></span>');
                };
            })(f);
            reader.readAsDataURL(f);
        }

        $(document).on('click', '.remove-btn', function () {
            $(".image-item").remove();
            $('#flagImage').val('');
        });
    </script>
@endsection
