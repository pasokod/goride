
@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.reports_user')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/reports/user')}}">{{trans('lang.report_plural')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('lang.reports_user')}}</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card  pb-4">

                <div class="card-body">
                    <div id="data-table_processing" class="dataTables_processing panel panel-default"
                         style="display: none;">{{trans('lang.processing')}}</div>
                    <div class="error_top"></div>

                    <div class="row restaurant_payout_create">
                        <div class="restaurant_payout_create-inner">
                            <fieldset>
                                <legend>{{trans('lang.reports_user')}}</legend>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.select_status')}}</label>
                                    <div class="col-7">
                                        <select class="form-control status">
                                            <option value="true">{{trans('lang.active')}}</option>
                                            <option value="false">{{trans('lang.inactive')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.file_format')}}<span
                                                class="required-field"></span></label>
                                    <div class="col-7">
                                        <select class="form-control file_format">
                                            <option value="">{{trans('lang.file_format')}}</option>
                                            {{--<option value="xls">{{trans('lang.xls')}}</option>--}}
                                            <option value="csv">{{trans('lang.csv')}}</option>
                                            <option value="pdf">{{trans('lang.pdf')}}</option>
                                        </select>
                                    </div>
                                </div>

                            </fieldset>
                        </div>
                    </div>

                    <div class="form-group col-12 text-center btm-btn">
                        <button type="submit" class="btn btn-primary download-user-report"><i
                                    class="fa fa-save"></i> {{ trans('lang.download')}}</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/objectexporter.min.js') }}"></script>
    <script>
        var database = firebase.firestore();
        var userRef = database.collection('users');
        var activeUserData = [];
        var notActiveUserData = [];

        var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');


        var decimal_degits = 0;
        var symbolAtRight = false;
        var currentCurrency = '';
        refCurrency.get().then(async function (snapshots) {

            var currencyData = snapshots.docs[0].data();
            currentCurrency = currencyData.symbol;
            decimal_degits = currencyData.decimalDigits;

            if (currencyData.symbolAtRight) {
                symbolAtRight = true;
            }
        });

        $(document).on('click', '.download-user-report', function () {
            var status = $(".status :selected").val();
            var fileFormat = $(".file_format :selected").val();
            var headerArray = ['Name', 'Email', 'PhoneNumber', 'LoginType', 'Wallet Amount', 'Status'];
            var headers = [];
            var headers = [];
            if (fileFormat == 'xls' || fileFormat == 'csv') {
                headers = headerArray;
                var script = document.createElement("script");
                script.setAttribute("src", "https://unpkg.com/object-exporter@3.2.1/dist/objectexporter.min.js");
                script.setAttribute("async", "false");
                var head = document.head;
                head.insertBefore(script, head.firstChild);
            } else {
                for (var k = 0; k < headerArray.length; k++) {
                    headers.push({
                        alias: headerArray[k],
                        name: headerArray[k],
                        flex: 1,
                    });
                }
                var script = document.createElement("script");
                script.setAttribute("src", "{{ asset('js/objectexporter.min.js') }}");
                script.setAttribute("async", "false");
                var head = document.head;
                head.insertBefore(script, head.firstChild);
            }

            $(".error_top").html("");

            if (fileFormat == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.file_format_error')}}</p>");
                window.scrollTo(0, 0);
            } else {
                jQuery("#overlay").show();
                    userRef.get().then(async function (userSnapshots) {
                   
                    if (userSnapshots.docs.length > 0) {
                        var filterData = await getData(userSnapshots);

                        ((fileFormat == "pdf") ? document.title = "user-report" : "");

                        objectExporter({
                            type: fileFormat,
                            exportable: ((status == "true") ? activeUserData : notActiveUserData),
                            headers: headers,
                            columnSeparator: ',',
                            fileName: 'user-report',
                            headerStyle: 'font-weight: bold; padding: 5px; border: 1px solid #dddddd;',
                            cellStyle: 'border: 1px solid lightgray; margin-bottom: -1px;',
                            documentTitle: '',
                            sheetName: 'user-report'
                        });

                        jQuery("#overlay").hide();
                        activeUserData = [];
                        notActiveUserData = [];
                        $('.file_format option[value=""]').attr('selected', 'selected');
                    } else {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.not_found_data_error')}}</p>");
                        window.scrollTo(0, 0);
                    }
                });
            }
        })

        async function getData(querySnapshot) {
            var dataArray = [];
            await Promise.all(querySnapshot.docs.map(async (doc) => {
                var userObj = doc.data();
                var newUserObj = {};
                newUserObj['Name'] = userObj.fullName;
                newUserObj['Email'] = userObj.email;
                newUserObj['PhoneNumber'] = ('(+' + (userObj.countryCode.includes('+') ? userObj.countryCode.slice(1) : userObj.countryCode) + ') ' + userObj.phoneNumber);
                newUserObj['LoginType'] = userObj.loginType;
                newUserObj['Wallet Amount'] = ((userObj.walletAmount) ? (symbolAtRight ? (parseFloat(userObj.walletAmount).toFixed(decimal_degits) + currentCurrency) : (currentCurrency + parseFloat(userObj.walletAmount).toFixed(decimal_degits))) : "");

                newUserObj['Status'] = ((userObj.isActive) ? 'Active' : 'Not-active');
                if (userObj.isActive) {
                    activeUserData.push(newUserObj);
                } else {
                    notActiveUserData.push(newUserObj);
                }
                dataArray.push(newUserObj);
            }));
            return dataArray;
        }
    </script>
@endsection
