@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.reports_transaction')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.reports_transaction')}}</li>
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
                                <legend>{{trans('lang.reports_transaction')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_user_type')}}<span
                                                class="required-field"></span></label>
                                    <div class="col-7">
                                        <select class="form-control user" id="user_type">
                                            <option selected value="">{{trans('lang.select_user_type')}}</option>

                                            <option value="driver">{{trans('lang.driver')}}</option>
                                            <option value="customer">{{trans('lang.customer')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_user')}}<span
                                                class="required-field"></span>
                                    </label>
                                    <div class="col-7">
                                        <select class="form-control user" id="user">
                                            <option selected value="">{{trans('lang.select_user')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_payment_method')}}</label>
                                    <div class="col-7">
                                        <select class="form-control payment_method">
                                            <option value="all" selected>{{trans('lang.all')}}</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_date')}}</label>
                                    <div class="col-7">
                                        <div id="reportrange"
                                             style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                            <i class="fa fa-calendar"></i>&nbsp;
                                            <span></span> <i class="fa fa-caret-down"></i>
                                        </div>
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
                        <button type="button" onclick="generateReport()" class="btn btn-primary download-user-report"><i
                                    class="fa fa-save"></i> {{ trans('lang.download')}}</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/objectexporter.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <script>
        var database = firebase.firestore();
        var userRef = database.collection('wallet_transaction');
        var driverUserRef = database.collection('driver_users');
        var customerRef = database.collection('users');
        var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');
        var paymentMethodRef = database.collection('settings').doc('payment');

        var symbolAtRight = false;
        var decimal_degits = 0;
        var currentCurrency = '';

        refCurrency.get().then(async function (snapshots) {
            var currencyData = snapshots.docs[0].data();
            currentCurrency = currencyData.symbol;
            decimal_degits = currencyData.decimalDigits;

            if (currencyData.symbolAtRight) {
                symbolAtRight = true;
            }
        });
        paymentMethodRef.get().then(function (snapShots) {

            var data = snapShots.data();
            Object.keys(data).forEach((listval) => {
                $('.payment_method').append($("<option value='" + data[listval].name + "'>" + data[listval].name + "</option>"));
            });
        });
        $(function () {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });
        $('#user_type').on('change', function () {

            var user_type = $("#user_type :selected").val();

            if (user_type == "driver") {
                $('#user').html('');
                driverUserRef.get().then(function (snapShots) {

                    if (snapShots.docs.length > 0) {
                        $('#user').append('<option value="all" selected>{{trans("lang.all_driver")}}</option>');
                        snapShots.docs.forEach((listval) => {
                            var data = listval.data();
                            //$('#user').append('<option disabled selected>Select User</option>');
                            $('#user').append('<option value="' + data.id + '">' + data.fullName + '</option>');
                        });

                    }
                });
            } else if (user_type == "customer") {
                $('#user').html('');
                customerRef.get().then(function (snapShots) {

                    if (snapShots.docs.length > 0) {
                        $('#user').append('<option value="all" selected>{{trans("lang.all_customer")}}</option>');
                        snapShots.docs.forEach((listval) => {
                            var data = listval.data();

                            $('#user').append('<option value="' + data.id + '">' + data.fullName + '</option>');
                        });

                    }
                });
            } else {

            }
        })

        async function generateReport() {
            var userRef = database.collection('wallet_transaction');
            var userType = $("#user_type :selected").val();
            var user = $('#user :selected').val();
            var paymentType = $('.payment_method :selected').val();
            let start_date = moment($('#reportrange').data('daterangepicker').startDate).toDate();
            let end_date = moment($('#reportrange').data('daterangepicker').endDate).toDate();


            if (userType != "all") {
                userRef = userRef.where('userType', '==', userType);
            }
            if (user != "all") {
                userRef = userRef.where('userId', '==', user);
            }
            if (paymentType != "all") {

                userRef = userRef.where('paymentType', '==', paymentType);
            }
            if (start_date != '') {
                userRef = userRef.where('createdDate', '>=', start_date);
            }
            if (end_date != '') {
                userRef = userRef.where('createdDate', '<=', end_date);
            }
            var fileFormat = $(".file_format :selected").val();
            var headerArray = ['TxnId', 'Name', 'PaymentType', 'Amount', 'Date', 'Note'];
            var headers = [];
            var transactionData = [];
            if (fileFormat == 'xls' || fileFormat == 'csv') {
                headers = headerArray
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
            } else if (userType == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.select_user_type')}}</p>");
                window.scrollTo(0, 0);
            } else if (user == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.select_user')}}</p>");
                window.scrollTo(0, 0);
            } else {
                jQuery("#overlay").show();

                userRef.get().then(async function (userSnapshots) {

                    if (userSnapshots.docs.length > 0) {
                        var transactionData = await getData(userSnapshots, userType);

                        ((fileFormat == "pdf") ? document.title = "transaction-report" : "");

                        objectExporter({
                            type: fileFormat,
                            exportable: transactionData,
                            headers: headers,
                            columnSeparator: ',',
                            fileName: 'transaction-report',
                            headerStyle: 'font-weight: bold; padding: 5px; border: 1px solid #dddddd;',
                            cellStyle: 'border: 1px solid lightgray; margin-bottom: -1px;',
                            documentTitle: '',
                            sheetName: 'transaction-report'
                        })
                        jQuery("#overlay").hide();


                        $('.file_format option[value=""]').attr('selected', 'selected');
                    } else {
                        jQuery("#overlay").hide();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.not_found_data_error')}}</p>");
                        window.scrollTo(0, 0);
                    }
                });
            }
        }

        async function getData(querySnapshot, userType) {
            var transactionData = [];
            await Promise.all(querySnapshot.docs.map(async (doc) => {
                var userObj = doc.data();
                var newUserObj = {};
                var userName = await getUserData(userObj.userId, userType);

                if (userObj.amount.charAt(0) == "-") {
                    var amount = Math.abs(userObj.amount);
                    if (symbolAtRight) {
                        amount = "-" + parseFloat(amount).toFixed(decimal_degits) + currentCurrency;

                    } else {
                        amount = "-" + currentCurrency + parseFloat(amount).toFixed(decimal_degits);

                    }

                } else {
                    if (symbolAtRight) {
                        amount = parseFloat(userObj.amount).toFixed(decimal_degits) + currentCurrency;

                    } else {
                        amount = currentCurrency + parseFloat(userObj.amount).toFixed(decimal_degits);

                    }

                }


                var date = userObj.createdDate.toDate().toDateString();
                var time = userObj.createdDate.toDate().toLocaleTimeString('en-US');
                var dateTime = date + " " + time;
                newUserObj['TxnId'] = userObj.transactionId;
                newUserObj['Name'] = userName ? userName : '';
                newUserObj['PaymentType'] = userObj.paymentType;
                newUserObj['Amount'] = amount;
                newUserObj['Date'] = dateTime;
                newUserObj['Note'] = userObj.note;
                transactionData.push(newUserObj);
            }));
            return transactionData;
        }

        async function getUserData(id, type) {

            if (type == "driver") {

                var userName = '';
                await database.collection('driver_users').where("id", "==", id).get().then(async function (snapshotss) {

                    if (snapshotss.docs[0]) {
                        var user_data = snapshotss.docs[0].data();
                        userName = user_data.fullName;
                        //return userName;
                    }
                });
                return userName;
            } else {
                var userName = '';

                await database.collection('users').where("id", "==", id).get().then(async function (snapshotss) {

                    if (snapshotss.docs[0]) {
                        var user_data = snapshotss.docs[0].data();
                        userName = user_data.fullName;
                        //return userName;
                    }
                });
                return userName;
            }


        }
    </script>
@endsection
