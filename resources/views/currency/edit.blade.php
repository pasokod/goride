@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.currency_edit')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('currency') !!}">{{trans('lang.currency_table')}}</a>
                </li>
                <li class="breadcrumb-item active">{{trans('lang.currency_edit')}}</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
              <div class="card pb-4">
        <div class="card-body">
            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                 style="display: none;">{{trans('lang.processing')}}
            </div>
            <div class="error_top"></div>

            <div class="row restaurant_payout_create">
                <div class="restaurant_payout_create-inner">
                    <fieldset>
                        <legend>{{trans('lang.currency')}}</legend>
                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.currency_name')}}<span class="required-field"></span></label>
                            <div class="col-7">
                                <input type="text" class="form-control currency_name">
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.currency_code')}}<span class="required-field"></span></label>
                            <div class="col-7">
                                <input type="text" class="form-control currency_code">
                            </div>
                        </div>


                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.currency_symbol')}}<span class="required-field"></span></label>
                            <div class="col-7">
                                <input type="text" class="form-control currency_symbol">
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.digit_after_decimal_point')}}<span class="required-field"></span></label>
                            <div class="col-7">
                                <input type="number" class="form-control decimal_degits" value="0">
                                <div class="form-text text-muted">{{trans('lang.digit_after_decimal_point_help')}}</div>
                            </div>
                        </div>

                        <div class="form-check width-100">
                            <input type="checkbox" class="symbol_at_right" id="symbol_at_right">
                            <label class="col-5 control-label"
                                   for="symbol_at_right">{{trans('lang.symbole_at_right')}}</label>
                        </div>

                        <div class="form-check width-100">
                            <input type="checkbox" class="currency_active" id="currency_active">
                            <label class="col-3 control-label"
                                   for="currency_active">{{trans('lang.active')}}</label>
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="form-group col-12 text-center btm-btn">
                <button type="button" class="btn btn-primary  edit_currency_btn"><i class="fa fa-save"></i> {{
                    trans('lang.save')}}
                </button>
                <a href="{!! route('currency') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{
                    trans('lang.cancel')}}</a>
            </div>

        </div>

    </div>

    </div>
    </div>

</div>

@endsection

@section('scripts')


<script>

    var id = "{{$id}}";
    var database = firebase.firestore();
    var ref = database.collection('currency').where("id", "==", id);

    var deleteMsg = "{{trans('lang.delete_alert')}}";
    var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";
    var currencyDeleteAlert = "{{trans('lang.currency_delete_alert')}}";

    $(document).ready(function () {

        $('.currency').addClass('active');

        jQuery("#overlay").show();
        ref.get().then(async function (snapshots) {
            var currency = snapshots.docs[0].data();

            $(".currency_name").val(currency.name);
            $(".currency_code").val(currency.code);
            $(".currency_symbol").val(currency.symbol);
            if (currency.decimalDigits) {
                $(".decimal_degits").val(currency.decimalDigits);
            }
            if (currency.enable) {
                $(".currency_active").prop('checked', true);
            }
            if (currency.symbolAtRight) {
                $(".symbol_at_right").prop('checked', true);
            }
            jQuery("#overlay").hide();
        });
    });

    $(".edit_currency_btn").click(async function () {

        var currencyName = $(".currency_name").val();
        var currencyCode = $(".currency_code").val();
        var currencySymbol = $(".currency_symbol").val();
        var decimal_degits = $(".decimal_degits").val();
        var active = $(".currency_active").is(":checked") ? true : false;
        var symbolAtRight = $(".symbol_at_right").is(":checked") ? true : false;

        if (currencyName == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.enter_currency_name_error')}}</p>");
        } else if (currencyCode == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.enter_currency_code_error')}}</p>");
        } else if (currencySymbol == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.enter_currency_symbol_error')}}</p>");
        } else if (decimal_degits < 0) {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.digit_after_decimal_point_error')}}</p>");
        } else {
            jQuery("#overlay").show();
            var checkFlag = false;
            if (active) {
                await database.collection('currency').where('enable', "==", true).get().then(function (snapshots) {
                    var activeCurrency = snapshots.docs[0].data();
                    var activeCurrencyId = activeCurrency.id;
                    database.collection('currency').doc(activeCurrencyId).update({'enable': false});
                    checkFlag = true;
                });
            } else {
                await database.collection('currency').where('enable', "==", true).get().then(async function (snapshots) {
                    var activeCurrency = snapshots.docs[0].data();
                    var activeCurrencyId = activeCurrency.id;
                    if (snapshots.docs.length == 1 && activeCurrencyId == id) {
                        checkFlag = true;
                        alert(currencyDeleteAlert);
                        $(".currency_active").prop('checked', true);
                        active = true;
                        jQuery("#overlay").hide();
                        return false;
                    } else {
                        
                        await database.collection('currency').doc(id).update({'enable': false}).then(function (result) {
                            checkFlag = true;
                        });
                    }
                });
            }
            jQuery("#overlay").hide();
           
            if (checkFlag) {
                database.collection('currency').doc(id).update({
                    'symbol': currencySymbol,
                    'name': currencyName,
                    'symbolAtRight': symbolAtRight,
                    'decimalDigits': parseInt(decimal_degits),
                    'code': currencyCode,
                    'enable': active,
                    'updatedAt': new Date(),
                }).then(function (result) {
                    window.location.href = '{{ route("currency")}}';
                }).catch(function (error) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + error + "</p>");
                });
            }

        }
    });
</script>
@endsection
