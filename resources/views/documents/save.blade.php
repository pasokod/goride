@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.document_plural')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('documents') !!}">{{trans('lang.document_plural')}}</a>
                </li>
                <li class="breadcrumb-item active">{{ $id == 0? trans('lang.document_create') :
                    trans('lang.document_edit')}}
                </li>
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
                            <legend>{{trans('lang.document_details')}}</legend>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.document_title')}}<span
                                            class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control document_title">
                                    <div class="form-text text-muted">
                                        {{ trans("lang.document_title_help") }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <div class="form-check">
                                    <input type="checkbox" class="document_active" id="document_active">
                                    <label class="col-3 control-label"
                                           for="document_active">{{trans('lang.enable')}}</label>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <div class="form-check">
                                    <input type="checkbox" class="document_front_active" id="document_front_active"
                                           checked>
                                    <label class="col-3 control-label" for="document_front_active">{{trans('lang.document_front_active')}}<span
                                                class="required-field"></span></label>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <div class="form-check">
                                    <input type="checkbox" class="document_back_active" id="document_back_active">
                                    <label class="col-3 control-label" for="document_back_active">{{trans('lang.document_back_active')}}</label>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <div class="form-check">
                                    <input type="checkbox" class="document_expire_active" id="document_expire_active">
                                    <label class="col-3 control-label" for="document_expire_active">{{trans('lang.document_expire_active')}}</label>
                                </div>
                            </div>


                        </fieldset>
                    </div>
                </div>

                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary  create_user_btn"><i class="fa fa-save"></i> {{
                        trans('lang.save')}}
                    </button>
                    <a href="{!! route('documents') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{
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
    var alldriver = database.collection('driver_users');
    var ref = database.collection('documents');
    var requestId = "{{$id}}";
    var id = (requestId == '0') ? database.collection("tmp").doc().id : requestId;
    var docDeleteAlert = "{{trans('lang.doc_delete_alert')}}";

    $(document).ready(function () {
        //$('.document_menu').addClass('active');
        $('.document_sub_menu li').each(function () {
            var url = $(this).find('a').attr('href');
            if (url == document.referrer) {
                $(this).find('a').addClass('active');
                $('.document_menu').addClass('active').attr('aria-expanded', true);
            }
            $('.document_sub_menu').addClass('in').attr('aria-expanded', true);
        });
        if (requestId != '0') {
            jQuery("#overlay").show();
            var ref = database.collection('documents').doc(id.trim());
            ref.get().then(async function (snapshots) {
                var data = snapshots.data();
                $(".document_title").val(data.title);
                $('.document_active').prop('checked', data.enable ? true : false);
                $('.document_front_active').prop('checked', data.frontSide ? true : false);
                $('.document_back_active').prop('checked', data.backSide ? true : false);
                $('.document_expire_active').prop('checked', data.expireAt ? true : false);
                jQuery("#overlay").hide();
            })
        }
    });

    $(".create_user_btn").click(function () {

        var title = $(".document_title").val();
        var enable = $(".document_active").is(':checked') ? true : false;
        var frontSide = $(".document_front_active").is(':checked') ? true : false;
        var backSide = $(".document_back_active").is(':checked') ? true : false;
        var expireAt = $(".document_expire_active").is(':checked') ? true : false;
        var length = 0;
        database.collection('documents').where('enable', "==", true).get().then(function (snapshots) {
            length = snapshots.docs.length;
        });
        if (title == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.document_title_help')}}</p>");
            window.scrollTo(0, 0);
        } else if (frontSide == false) {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.document_front_active')}}</p>");
            window.scrollTo(0, 0);
        } else if (enable == false && length == 1) {
            $(".document_active").prop('checked', true);
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>" + docDeleteAlert + "</p>");
            window.scrollTo(0, 0);
            return false;
        } else {
            jQuery("#overlay").show();

            requestId == '0'
                ? (database.collection('documents').doc(id.trim()).set({
                    'id': id,
                    'title': title,
                    'enable': enable,
                    'frontSide': frontSide,
                    'backSide': backSide,
                    'expireAt': expireAt,
                    'isDeleted': false,
                }).then(async function (result) {
                    var enableDocIds = await getDocId();
                    await alldriver.get().then(async function (snapshotsdriver) {
                        if (snapshotsdriver.docs.length > 0) {
                            var verification = await driverDocVerification(enableDocIds, snapshotsdriver);
                            if (verification) {
                                jQuery("#overlay").hide();
                                window.location.href = '{{ route("documents")}}';
                            }
                        } else {
                            jQuery("#overlay").hide();
                            window.location.href = '{{ route("documents")}}';
                        }
                    })
                }).catch(function (error) {
                    jQuery("#overlay").hide();
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + error + "</p>");
                }))
                : (database.collection('documents').doc(id.trim()).update({
                    'title': title,
                    'enable': enable,
                    'frontSide': frontSide,
                    'backSide': backSide,
                    'expireAt': expireAt,
                    'isDeleted': false,
                }).then(async function (result) {
                    var enableDocIds = await getDocId();
                    await alldriver.get().then(async function (snapshotsdriver) {
                        if (snapshotsdriver.docs.length > 0) {
                            var verification = await driverDocVerification(enableDocIds, snapshotsdriver);
                            if (verification) {
                                jQuery("#overlay").hide();
                                window.location.href = '{{ route("documents")}}';
                            }
                        } else {
                            jQuery("#overlay").hide();
                            window.location.href = '{{ route("documents")}}';
                        }
                    })
                }).catch(function (error) {
                    jQuery("#overlay").hide();
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + error + "</p>");
                }))
        }
    });

    async function getDocId() {
        var enableDocIds = [];
        await database.collection('documents').where('isDeleted', '==', false).where('enable', "==", true).get().then(async function (snapshots) {
            await snapshots.forEach((doc) => {
                enableDocIds.push(doc.data().id);
            });
        });
        return enableDocIds;
    }

    async function driverDocVerification(enableDocIds, snapshotsdriver) {
        var isCompleted = false;
        await Promise.all(snapshotsdriver.docs.map(async (driver) => {
            await database.collection('driver_document').doc(driver.id).get().then(async function (docrefSnapshot) {
                if (docrefSnapshot.data() && docrefSnapshot.data().documents.length > 0) {
                    var driverDocId = await docrefSnapshot.data().documents.filter((doc) => doc.verified == true).map((docData) => docData.documentId);
                    if (driverDocId.length >= enableDocIds.length) {
                        await database.collection('driver_users').doc(driver.id).update({'documentVerification': true});
                    } else {
                        await enableDocIds.forEach(async (docId) => {
                            if (!driverDocId.includes(docId)) {
                                await database.collection('driver_users').doc(driver.id).update({'documentVerification': false});
                            }
                        });
                    }
                } else {
                    await database.collection('driver_users').doc(driver.id).update({'documentVerification': false});
                }
            });
            isCompleted = true;
        }));
        return isCompleted;
    }
</script>
@endsection
