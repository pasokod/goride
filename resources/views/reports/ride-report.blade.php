@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.reports_ride')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/reports/ride')}}">{{trans('lang.report_plural')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('lang.reports_ride')}}</li>
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
                                <legend>{{trans('lang.reports_ride')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_driver')}}</label>
                                    <div class="col-7">
                                        <select class="form-control driver">
                                            <option value="">{{trans('lang.all')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_user')}}</label>
                                    <div class="col-7">
                                        <select class="form-control customer">
                                            <option value="">{{trans('lang.all')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_service')}}</label>
                                    <div class="col-7">
                                        <select class="form-control service">
                                            <option value="">{{trans('lang.all')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_ride_status')}}</label>
                                    <div class="col-7">
                                        <select class="form-control status">
                                            <option value="">{{trans('lang.all')}}</option>
                                            <option value="Ride Placed">{{ trans('lang.order_placed')}}</option>
                                            <option value="Ride Active">{{ trans('lang.order_active')}}</option>
                                            <option value="Ride InProgress">{{ trans('lang.ride_inprogress')}}</option>
                                            <option value="Ride Completed">{{ trans('lang.order_completed')}}</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_payment_method')}}</label>
                                    <div class="col-7">
                                        <select class="form-control payment_method">
                                            <option value="">{{trans('lang.all')}}</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_payment_status')}}</label>
                                    <div class="col-7">
                                        <select class="form-control payment_status">
                                            <option value="">{{trans('lang.all')}}</option>
                                            <option value="true">{{trans('lang.paid')}}</option>
                                            <option value="false">{{trans('lang.not_paid')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
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
                        <button type="submit" class="btn btn-primary download-user-report"><i
                                    class="fa fa-save"></i> {{ trans('lang.download')}}</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <script>
        var database = firebase.firestore();
        var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');
        var driverUserRef = database.collection('driver_users').orderBy('fullName');
        var serviceRef = database.collection('service').orderBy('title');
        var customerRef = database.collection('users').orderBy('fullName');
        var paymentMethodRef = database.collection('settings').doc('payment');

        setDate();

        function setDate() {
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
        }

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

        serviceRef.get().then(function (snapShots) {

            if (snapShots.docs.length > 0) {

                snapShots.docs.forEach((listval) => {
                    var data = listval.data();

                    $('.service').append('<option value="' + data.id + '">' + data.title + '</option>');
                });

            }
        });

        paymentMethodRef.get().then(function (snapShots) {

            var data = snapShots.data();
            Object.keys(data).forEach((listval) => {

                $('.payment_method').append($("<option value='" + data[listval].name + "'>" + data[listval].name + "</option>"));
            });
        });

        customerRef.get().then(function (snapShots) {

            if (snapShots.docs.length > 0) {

                snapShots.docs.forEach((listval) => {
                    var data = listval.data();

                    $('.customer').append('<option value="' + data.id + '">' + data.fullName + '</option>');
                });

            }
        });

        driverUserRef.get().then(function (snapShots) {

            if (snapShots.docs.length > 0) {

                snapShots.docs.forEach((listval) => {
                    var data = listval.data();

                    $('.driver').append('<option value="' + data.id + '">' + data.fullName + '</option>');
                });

            }
        });

        async function getServiceName(serviceId) {
            var title = '';
            if (serviceId) {
                await database.collection('service').where('id', '==', serviceId).get().then(async function (snapshots) {
                    if (snapshots.docs.length > 0) {
                        var service = snapshots.docs[0].data();
                        title = service.title;
                    }
                });
            }
            return title;
        }

        async function getVehicleName(vehicleId) {
            var title = '';
            if (vehicleId) {
                await database.collection('vehicle_type').where('id', '==', vehicleId).get().then(async function (snapshots) {
                    if (snapshots.docs.length > 0) {
                        var vehicle = snapshots.docs[0].data();
                        title = vehicle.name;
                    }
                });
            }
            return title;
        }

        async function getDriver(driverId) {
            var driverData = '';
            if (driverId) {
                await driverUserRef.where('id', '==', driverId).get().then(async function (snapshots) {
                    if (snapshots.docs.length > 0) {
                        driverData = snapshots.docs[0].data();
                    }
                });
            }
            return driverData;
        }

        async function getUser(userId) {
            var userData = '';
            if (userId) {
                await customerRef.where('id', '==', userId).get().then(async function (snapshots) {
                    if (snapshots.docs.length > 0) {
                        userData = snapshots.docs[0].data();
                    }
                });
            }
            return userData;
        }


        async function generateReport(orderData, headers, fileFormat) {

            if ((fileFormat == "pdf") ? document.title = "ride-report" : "");

            objectExporter({
                type: fileFormat,
                exportable: orderData,
                headers: headers,
                fileName: 'ride-report',
                columnSeparator: ',',
                headerStyle: 'font-weight: bold; padding: 5px; border: 1px solid #dddddd;',
                cellStyle: 'border: 1px solid lightgray; margin-bottom: -1px;',
                documentTitle: 'ride-report',
                sheetName: 'ride-report',
            });
        }

        async function getReportData(orderSnapshots, fileFormat) {

            var orderData = [];

            await Promise.all(orderSnapshots.docs.map(async (order) => {

                var orderObj = order.data();

                var orderId = orderObj.id;
                var finalOrderObject = {};

                var driverData = ((orderObj.driverId && orderObj.driverId != null) ? await getDriver(orderObj.driverId) : '-');

                var userData = await getUser(orderObj.userId);

                var serviceTitle = await getServiceName(orderObj.serviceId);
                var date = orderObj.createdDate.toDate();

                var distance = parseFloat(orderObj.distance).toFixed(2);
                var distanceType = ((orderObj.distanceType && orderObj.distanceType != "" && orderObj.distanceType != null) ? orderObj.distanceType : "");

                var paymentStatus = ((orderObj.paymentStatus == true) ? "Paid" : "Not Paid");

                var sourceLocationName = orderObj.sourceLocationName;
                var destinationLocationName = orderObj.destinationLocationName;

                if (fileFormat == "csv") {
                    sourceLocationName = sourceLocationName.replace(/,/g, '');
                    destinationLocationName = destinationLocationName.replace(/,/g, '');

                }

                finalOrderObject['Order ID'] = orderId;
                finalOrderObject['Driver Name'] = ((driverData.fullName) ? driverData.fullName : "");
                finalOrderObject['Driver Email'] = ((driverData.email) ? driverData.email : "");
                //finalOrderObject['Driver Phone'] = ((driverData.phoneNumber) ? ((driverData.countryCode) ? driverData.countryCode + "" + driverData.phoneNumber : driverData.phoneNumber) : "NULL");
                finalOrderObject['Driver Phone'] = driverData && driverData.phoneNumber ? ('(+' + (driverData.countryCode.includes('+') ? driverData.countryCode.slice(1) : driverData.countryCode) + ') ' + driverData.phoneNumber) : '';

                finalOrderObject['User Name'] = ((userData.fullName) ? userData.fullName : "");
                finalOrderObject['User Email'] = ((userData.email) ? userData.email : "");
                //finalOrderObject['User Phone'] = ((userData.phoneNumber) ? ((userData.countryCode) ? userData.countryCode + "" + userData.phoneNumber : userData.phoneNumber) : "NULL");
                finalOrderObject['User Phone'] = userData && userData.phoneNumber ? ('(+' + (userData.countryCode.includes('+') ? userData.countryCode.slice(1) : userData.countryCode) + ') ' + userData.phoneNumber) : '';
                finalOrderObject['Date'] = moment(date).format('ddd MMM DD YYYY h:mm:ss A');
                finalOrderObject['From'] = sourceLocationName;
                finalOrderObject['To'] = destinationLocationName;
                finalOrderObject['Distance'] = distance + " " + distanceType;
                finalOrderObject['Service'] = serviceTitle;
                finalOrderObject['Vehicle Type'] = ((driverData.vehicleInformation && driverData.vehicleInformation.vehicleType && driverData.vehicleInformation.vehicleType != null) ? driverData.vehicleInformation.vehicleType : "");
                finalOrderObject['Vehicle Number'] = ((driverData.vehicleInformation && driverData.vehicleInformation.vehicleNumber && driverData.vehicleInformation.vehicleNumber != null) ? driverData.vehicleInformation.vehicleNumber : "");
                finalOrderObject['Payment Method'] = orderObj.paymentType;
                finalOrderObject['Payment Status'] = paymentStatus;
                finalOrderObject['Status'] = orderObj.status;
                if (orderObj.driverId) {

                    var amount = 0;
                    var total_amount = 0;
                    var offer_rate = 0;
                    var final_rate = 0;

                    if (orderObj.offerRate) {
                        amount = parseFloat(orderObj.offerRate);
                        offer_rate = parseFloat(orderObj.offerRate);

                    }
                    if (orderObj.finalRate) {
                        amount = parseFloat(orderObj.finalRate);
                        final_rate = parseFloat(orderObj.finalRate);

                    }

                    total_amount = amount;

                    var discount_amount = 0;
                    if (orderObj.hasOwnProperty('coupon') && orderObj.coupon.enable) {
                        var data = orderObj.coupon;

                        if (data.type == "fix") {
                            discount_amount = data.amount;
                        } else {
                            discount_amount = (data.amount * amount) / 100;
                        }

                        total_amount -= parseFloat(discount_amount);

                    }

                    var admin_commision_amount = amount - discount_amount;

                    if (orderObj.hasOwnProperty('taxList') && orderObj.taxList.length > 0) {
                        var taxData = orderObj.taxList;

                        var tax_amount_total = 0;
                        for (var i = 0; i < taxData.length; i++) {

                            var data = taxData[i];

                            if (data.enable) {

                                var tax_amount = data.tax;

                                if (data.type == "percentage") {

                                    tax_amount = (data.tax * total_amount) / 100;
                                }

                                tax_amount_total += parseFloat(tax_amount);

                            }
                        }
                        total_amount += parseFloat(tax_amount_total);


                    }

                    var commission_amount = 0;
                    if (orderObj.hasOwnProperty('adminCommission') && orderObj.adminCommission.isEnabled) {
                        var data = orderObj.adminCommission;

                        if (data.type == "fix") {
                            commission_amount = data.amount;
                        } else {
                            commission_amount = (data.amount * admin_commision_amount) / 100;
                        }

                        //total_amount -= parseFloat(commission_amount);
                    }

                    if (symbolAtRight) {
                        offer_rate = offer_rate.toFixed(decimal_degits) + currentCurrency;
                        final_rate = final_rate.toFixed(decimal_degits) + currentCurrency;
                        total_amount = total_amount.toFixed(decimal_degits) + currentCurrency;

                    } else {
                        offer_rate = currentCurrency + offer_rate.toFixed(decimal_degits);
                        final_rate = currentCurrency + final_rate.toFixed(decimal_degits);
                        total_amount = currentCurrency + total_amount.toFixed(decimal_degits);

                    }
                    finalOrderObject['Offer Rate'] = offer_rate;
                    finalOrderObject['Final Rate'] = final_rate;
                    finalOrderObject['Total'] = total_amount;

                } else {
                    finalOrderObject['Offer Rate'] = ((orderObj.offerRate) ? (symbolAtRight ? (parseFloat(orderObj.offerRate).toFixed(decimal_degits) + currentCurrency) : (currentCurrency + parseFloat(orderObj.offerRate).toFixed(decimal_degits))) : "");
                    finalOrderObject['Final Rate'] = ((orderObj.finalRate) ? (symbolAtRight ? (parseFloat(orderObj.finalRate).toFixed(decimal_degits) + currentCurrency) : (currentCurrency + parseFloat(orderObj.finalRate).toFixed(decimal_degits))) : "");
                    finalOrderObject['Total'] = "";
                }
                orderData.push(finalOrderObject);
            }));

            return orderData;
        }

        $(document).on('click', '.download-user-report', function () {

            var driver = $(".driver :selected").val();
            var customer = $(".customer :selected").val();
            var service = $(".service :selected").val();
            var status = $(".status :selected").val();
            var payment_method = $(".payment_method :selected").val();
            var payment_status = $(".payment_status :selected").val();
            var fileFormat = $(".file_format :selected").val();
            let start_date = moment($('#reportrange').data('daterangepicker').startDate).toDate();
            let end_date = moment($('#reportrange').data('daterangepicker').endDate).toDate();

            var headerArray = ['Order ID', 'Driver Name', 'Driver Email', 'Driver Phone', 'User Name', 'User Email', 'User Phone', 'Date', 'From', 'To', 'Distance', 'Service', 'Vehicle Type', 'Vehicle Number', 'Payment Method', 'Payment Status', 'Status', 'Offer Rate', 'Final Rate', 'Total',];


            var headers = [];

            $(".error_top").html("");

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

            if (fileFormat == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.file_format_error')}}</p>");
                window.scrollTo(0, 0);
            } else {
                jQuery("#overlay").show();

                var ordersRef = database.collection('orders').orderBy('createdDate', 'desc');

                if (driver != "") {
                    ordersRef = ordersRef.where('driverId', '==', driver)
                }
                if (customer != "") {
                    ordersRef = ordersRef.where('userId', '==', customer)
                }

                if (service != "") {
                    ordersRef = ordersRef.where('serviceId', '==', service)
                }

                if (status != "") {
                    ordersRef = ordersRef.where('status', '==', status)
                }

                if (payment_method != "") {
                    ordersRef = ordersRef.where('paymentType', '==', payment_method)
                }


                if (payment_status != "") {
                    if (payment_status === 'true') payment_status = true;
                    if (payment_status === 'false') payment_status = false;

                    ordersRef = ordersRef.where('paymentStatus', '==', payment_status)
                }

                if (start_date != "") {
                    ordersRef = ordersRef.where('createdDate', '>=', start_date)
                }

                if (end_date != "") {
                    ordersRef = ordersRef.where('createdDate', '<=', end_date)
                }

                ordersRef.get().then(async function (orderSnapshots) {

                    if (orderSnapshots.docs.length > 0) {
                        var reportData = await getReportData(orderSnapshots, fileFormat);

                        generateReport(reportData, headers, fileFormat);

                        jQuery("#overlay").hide();
                        setDate();
                        $('.file_format').val('').trigger('change');
                        $('.driver').val('').trigger('change');
                        $('.customer').val('').trigger('change');
                        $('.service').val('').trigger('change');
                        $('.status').val('').trigger('change');
                        $('.payment_method').val('').trigger('change');
                        $('.payment_status').val('').trigger('change');

                    } else {
                        jQuery("#overlay").hide();
                        setDate();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.not_found_data_error')}}</p>");
                        window.scrollTo(0, 0);

                    }

                }).catch((error) => {

                    jQuery("#overlay").show();

                    console.log("Error getting documents: ", error);
                    $(".error_top").show();
                    $(".error_top").html(error);
                    window.scrollTo(0, 0);
                });
            }
        });

    </script>
@endsection
