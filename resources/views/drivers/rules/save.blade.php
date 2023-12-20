@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.driver_rule_plural')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a
                            href="{!! route('driver-rules') !!}">{{trans('lang.driver_rule_plural')}}</a>
                </li>
                <li class="breadcrumb-item active">{{ $id == 0? trans('lang.driver_rule_create') :
                    trans('lang.driver_rule_edit')}}
                </li>
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
                            <legend>{{trans('lang.driver_rule_details')}}</legend>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.name')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control driver_rule_name" name="driver_rule_name"
                                           id="driver_rule_name">
                                </div>
                            </div>


                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.image')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="file" onChange="handleFileSelect(event)" class="form-control image">
                                    <div class="placeholder_img_thumb driver_rule_image"></div>
                                    <div id="uploding_image"></div>
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <div class="form-check">
                                    <input type="checkbox" class="driver_rule_active" id="driver_rule_active">
                                    <label class="col-3 control-label"
                                           for="driver_rule_active">{{trans('lang.enable')}}</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary  create-driver-rule-btn"><i
                                class="fa fa-save"></i> {{ trans('lang.save')}}
                    </button>
                    <a href="{!! route('driver-rules') !!}" class="btn btn-default"><i
                                class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    var database = firebase.firestore();
    var storageRef = firebase.storage().ref('images');
    var storage = firebase.storage();
    var requestId = "{{$id}}";
    var photo = '';
    var fileName = '';
    var driverRuleImagePath = '';
    var id = (requestId == '0') ? database.collection("tmp").doc().id : requestId;

    $(document).ready(function () {
        $('.driver_rules_sub_menu li').each(function () {
            var url = $(this).find('a').attr('href');
            if (url == document.referrer) {
                $(this).find('a').addClass('active');
                $('.driver_rules_menu').addClass('active').attr('aria-expanded', true);
            }
            $('.driver_rules_sub_menu').addClass('in').attr('aria-expanded', true);
        });
        if (requestId != '0') {
            jQuery("#overlay").show();
            var ref = database.collection('driver_rules').where("id", "==", id);
            ref.get().then(async function (snapshots) {
                var data = snapshots.docs[0].data();
                $(".driver_rule_name").val(data.name);
                $('.driver_rule_active').prop('checked', data.enable ? true : false);
                if (data.image) {
                    photo = data.image;
                    driverRuleImagePath = data.image;
                    $(".driver_rule_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + data.image + '" alt="image"></span>');
                }
                jQuery("#overlay").hide();
            })
        }
    });

    $(".create-driver-rule-btn").click(function () {
        
        var enable = $(".driver_rule_active").is(':checked') ? true : false;
        var name = $(".driver_rule_name").val();
        if (name == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.driver_rule_name_error')}}</p>");
            window.scrollTo(0, 0);
        } else if (photo == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.driver_rule_image_error')}}</p>");
            window.scrollTo(0, 0);
        } else {
            jQuery("#overlay").show();
            storeImageData().then(IMG => {
                requestId == '0'
                    ? (database.collection('driver_rules').doc(id).set({
                        'id': id,
                        'enable': enable,
                        'image': IMG,
                        'isDeleted': false,
                        'name': name
                    }).then(function (result) {
                        window.location.href = '{{ route("driver-rules")}}';
                    }).catch(function (error) {
                        jQuery("#overlay").hide();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + error + "</p>");
                    }))
                    : (database.collection('driver_rules').doc(id).update({
                        'id': id,
                        'enable': enable,
                        'image': IMG,
                        'isDeleted': false,
                        'name': name
                    }).then(function (result) {
                        window.location.href = '{{ route("driver-rules")}}';
                    }).catch(function (error) {
                        jQuery("#overlay").hide();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + error + "</p>");
                    }))
            }).catch(err => {
                jQuery("#overlay").hide();
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>" + err + "</p>");
                window.scrollTo(0, 0);
            });
        }
    })

    async function storeImageData() {
        var newPhoto = '';
        try {
            if (driverRuleImagePath != "" && photo != driverRuleImagePath) {
                var driverRuleOldImage = await storage.refFromURL(driverRuleImagePath);
                imageBucket = driverRuleOldImage.bucket;
                var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                if (imageBucket == envBucket) {

                    await driverRuleOldImage.delete().then(() => {
                        console.log("Old file deleted!")
                    }).catch((error) => {
                        console.log("ERR File delete ===", error);
                    });
                } else {
                    console.log('Bucket not matched');
                }

            }
            if (photo != driverRuleImagePath) {
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
                $(".driver_rule_image").empty();
                $(".driver_rule_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + filePayload + '" alt="image"></span>');
            };
        })(f);
        reader.readAsDataURL(f);
    }

    $(document).on('click', '.remove-btn', function () {
        $(".driver_rule_image").empty();
        photo = '';
    });
</script>
@endsection
