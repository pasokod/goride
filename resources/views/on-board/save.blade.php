@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.on_board_plural')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('on-board') !!}">{{trans('lang.on_board_plural')}}</a>
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
                            <legend>{{trans('lang.on_board_details')}}</legend>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.title')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control title">
                                    <div class="form-text text-muted">
                                        {{ trans("lang.title_help") }}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.description')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <textarea rows="6" id="description" class="description form-control"></textarea>
                                    <div class="form-text text-muted">
                                        {{ trans("lang.description_help") }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.image')}}</label>
                                <div class="col-7">
                                    <input type="file" onChange="handleFileSelect(event)" class="form-control image"
                                        id="image">
                                    <div class="placeholder_img_thumb user_image"></div>
                                    <div id="uploding_image"></div>
                                    <div class="form-text text-muted w-50">
                                        {{ trans("lang.image_help") }}
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                    </div>
                </div>

                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary  create_user_btn"><i class="fa fa-save"></i> {{
                        trans('lang.save')}}</button>
                    <a href="{!! route('on-board') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{
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

    var requestId = "{{$id}}";
    var storageRef = firebase.storage().ref('on-boarding');
    var storage = firebase.storage();
    var photo = "";
    var fileName = "";
    var ImageFile = '';
    var placeholderImage = "{{ asset('/images/default_user.png') }}";
    $(document).ready(function () {

        $('.onboard_menu').addClass('active');


        jQuery("#overlay").show();
        var ref = database.collection('on_boarding').where("id", "==", requestId);
        ref.get().then(async function (snapshots) {
            var data = snapshots.docs[0].data();
            $(".title").val(data.title);
            $(".description").val(data.description);
            if (data.image == '' || data.image == null) {

                $(".user_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image">');
            } else {
                console.log('else');
                photo = data.image;
                ImageFile = data.image;
                $(".user_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + data.image + '" alt="image">');
            }
            jQuery("#overlay").hide();
        })

    });

    $(".create_user_btn").click(function () {
        jQuery("#overlay").show();
        var title = $(".title").val();
        var description = $(".description").val();

        if (title == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.title_help')}}</p>");
            window.scrollTo(0, 0);
        } else if (description == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.description_help')}}</p>");
            window.scrollTo(0, 0);
        } else {
            storeImageData().then(IMG => {
                database.collection('on_boarding').doc(requestId).update({
                    'title': title,
                    'description': description,
                    'image': IMG,
                }).then(function (result) {
                    window.location.href = '{{ route("on-board")}}';
                }).catch(function (error) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + error + "</p>");
                })
            });
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
                var uploadTask = await storageRef.child(fileName).putString(photo, 'base64', { contentType: 'image/jpg' });
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
                $(".user_image").empty();
                $(".user_image").append('<span class="image-item" id="photo_user"><span class="remove-btn" data-id="user-remove" data-img="' + photo + '"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + photo + '" alt="image"></span>');

            };
        })(f);
        reader.readAsDataURL(f);
    }

    $(document).on("click", ".remove-btn", function () {
        $(".image-item").remove();
        $('#image').val('');
    });
</script>
@endsection