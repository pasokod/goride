@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.faq_plural')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('faq') !!}">{{trans('lang.faq_plural')}}</a>
                </li>
                <li class="breadcrumb-item active">{{ $id =='' ? trans('lang.faq_create') : trans('lang.faq_edit')}}
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
                            <legend>{{trans('lang.faq_details')}}</legend>

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
                                        <textarea class="form-control description" rows="10" name="description"
                                                  id="description"></textarea>
                                    <div class="form-text text-muted">
                                        {{ trans("lang.description_help") }}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row width-50">
                                <div class="form-check">
                                    <input type="checkbox" class="faq_active" id="faq_active">
                                    <label class="col-3 control-label"
                                           for="faq_active">{{trans('lang.enable')}}</label>
                                </div>
                            </div>

                        </fieldset>
                    </div>
                </div>

                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary  create_user_btn"><i
                                class="fa fa-save"></i> {{ trans('lang.save')}}
                    </button>
                    <a href="{!! route('faq') !!}" class="btn btn-default"><i
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


    var requestId = "{{$id}}";
    var id = (requestId == '') ? database.collection("tmp").doc().id : requestId;

    $(document).ready(function () {

        $('.faq_menu').addClass('active');

        if (requestId != '') {
            jQuery("#overlay").show();
            var ref = database.collection('faq').where("id", "==", id);
            ref.get().then(async function (snapshots) {
                var data = snapshots.docs[0].data();
                $(".title").val(data.title);
                $(".description").val(data.description);
                if (data.enable) {
                    $('.faq_active').prop('checked', true);
                }

                jQuery("#overlay").hide();
            })
        }
    });

    $(".create_user_btn").click(function () {
        
        var title = $(".title").val();
        var description = $(".description").val();
        var enable = false;
        if ($(".faq_active").is(':checked')) {
            enable = true;
        }


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
            jQuery("#overlay").show();

            requestId == ''
                ? (database.collection('faq').doc(id).set({
                    'id': id,
                    'title': title,
                    'description': description,
                    'enable': enable,

                }).then(function (result) {
                    jQuery("#overlay").hide();

                    window.location.href = '{{ route("faq")}}';
                }).catch(function (error) {
                    jQuery("#overlay").hide();

                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + error + "</p>");
                }))
                : (database.collection('faq').doc(id).update({
                    'title': title,
                    'description': description,
                    'enable': enable,

                }).then(function (result) {
                    jQuery("#overlay").hide();

                    window.location.href = '{{ route("faq")}}';
                }).catch(function (error) {
                    jQuery("#overlay").hide();

                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + error + "</p>");
                }))
        }
    })
</script>
@endsection
