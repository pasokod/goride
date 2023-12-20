@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.banner_plural')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('banners') !!}">{{trans('lang.banner_plural')}}</a>
                </li>
                <li class="breadcrumb-item active">{{ $id == 0? trans('lang.banner_create') :
                    trans('lang.banner_edit')}}
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
                            <legend>{{trans('lang.banner_details')}}</legend>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.banner_order')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="number" class="form-control banner_order" min="0">
                                </div>
                            </div>


                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.image')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="file" onChange="handleFileSelect(event)" class="form-control image">
                                    <div class="placeholder_img_thumb banner_image"></div>
                                    <div id="uploding_image"></div>
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <div class="form-check">
                                    <input type="checkbox" class="banner_active" id="banner_active">
                                    <label class="col-3 control-label"
                                           for="banner_active">{{trans('lang.enable')}}</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary  create_banner_btn"><i
                                class="fa fa-save"></i> {{ trans('lang.save')}}
                    </button>
                    <a href="{!! route('banners') !!}" class="btn btn-default"><i
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
    var bannerImagePath = '';
    var id = (requestId == '0') ? database.collection("tmp").doc().id : requestId;

    $(document).ready(function () {
        $('.banner_sub_menu li').each(function () {
            $('.banner_sub_menu li').each(function () {
                var url = $(this).find('a').attr('href');
                if (url == document.referrer) {
                    $(this).find('a').addClass('active');
                    $('.banner_menu').addClass('active').attr('aria-expanded', true);
                }
                $('.banner_sub_menu').addClass('in').attr('aria-expanded', true);
            });
            if (requestId != '0') {
                jQuery("#overlay").show();
                var ref = database.collection('banner').where("id", "==", id);
                ref.get().then(async function (snapshots) {
                    var data = snapshots.docs[0].data();
                    $(".banner_order").val(data.position);
                    if (data.enable) {
                        $('.banner_active').prop('checked', true);
                    }
                    if (data.image) {
                        photo = data.image;
                        bannerImagePath = data.image;
                        $(".banner_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + data.image + '" alt="image"></span>');
                    }
                    jQuery("#overlay").hide();
                })
            }
        });
    });

    $(".create_banner_btn").click(function () {

        var enable = $(".banner_active").is(':checked') ? true : false;
        var order = $(".banner_order").val();
        if (order == '' || order <= 0) {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.banner_order_error')}}</p>");
            window.scrollTo(0, 0);
        } else if (photo == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.banner_image_help')}}</p>");
            window.scrollTo(0, 0);
        } else {
            jQuery("#overlay").show();
            storeImageData().then(IMG => {
                requestId == '0'
                    ? (database.collection('banner').doc(id).set({
                        'id': id,
                        'enable': enable,
                        'image': IMG,
                        'isDeleted': false,
                        'position': order
                    }).then(function (result) {
                        window.location.href = '{{ route("banners")}}';
                    }).catch(function (error) {
                        jQuery("#overlay").hide();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + error + "</p>");
                    }))
                    : (database.collection('banner').doc(id).update({
                        'id': id,
                        'enable': enable,
                        'image': IMG,
                        'isDeleted': false,
                        'position': order
                    }).then(function (result) {
                        window.location.href = '{{ route("banners")}}';
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
    });

    async function storeImageData() {
        var newPhoto = '';
        try {
            if (bannerImagePath != "" && photo != bannerImagePath) {
                var bannerOldImageRef = await storage.refFromURL(bannerImagePath);
                imageBucket= bannerOldImageRef.bucket;
                var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                if (imageBucket == envBucket) {

                await bannerOldImageRef.delete().then(() => {
                    console.log("Old file deleted!")
                }).catch((error) => {
                    console.log("ERR File delete ===", error);
                });
                }else{
                        console.log('Bucket not matched');
                  }

            }
            if (photo != bannerImagePath) {
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
                $(".banner_image").empty();
                $(".banner_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + filePayload + '" alt="image"></span>');
            };
        })(f);
        reader.readAsDataURL(f);
    }

    $(document).on('click', '.remove-btn', function () {
        $(".banner_image").empty();
        photo = '';
    });
</script>
@endsection
