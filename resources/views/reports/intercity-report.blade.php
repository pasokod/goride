@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.intercity_report')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{{url('/reports/intercity')}}">{{trans('lang.report_plural')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.intercity_report')}}</li>
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
                                <legend>{{trans('lang.intercity_report')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_status')}}</label>
                                    <div class="col-7">
                                        <select id="order_status" class="form-control">
                                            <option value="">{{ trans('lang.all')}}</option>
                                            <option value="Ride Placed">{{ trans('lang.order_placed')}}</option>
                                            <option value="Ride Accepted">{{ trans('lang.order_accepted')}}</option>
                                            <option value="Ride Rejected">{{ trans('lang.order_rejected')}}</option>
                                            <option value="Ride InProgress">{{ trans('lang.ride_inprogress')}}</option>
                                            <option value="Ride Active">{{ trans('lang.order_active')}}</option>
                                            <option value="Ride Completed">{{ trans('lang.order_completed')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_intercity_service')}}</label>
                                    <div class="col-7">
                                        <select id='intercity_service' class="form-control">
                                            <option value="">{{trans('lang.all')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_user')}}</label>
                                    <div class="col-7">
                                        <select id='user' class="form-control">
                                            <option value="">{{trans('lang.all')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_driver')}}</label>
                                    <div class="col-7">
                                        <select id='driver' class="form-control">
                                            <option value="">{{trans('lang.all')}}</option>
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

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_payment_method')}}</label>
                                    <div class="col-7">
                                        <select id='payment_method' class="form-control">
                                            <option value="">{{trans('lang.all')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <script>
        var database = firebase.firestore();
        var userRef = database.collection('users');
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

        function setDateData() {
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
        };
        $(document).ready(function () {
            setDateData();
            database.collection('intercity_service').get().then(async function (snapshots) {
                snapshots.docs.forEach((listval) => {
                    var data = listval.data();
                    $('#intercity_service').append($("<option></option>")
                        .attr("value", data.id)
                        .text(data.name));
                })
            });
            database.collection('users').get().then(async function (snapshots) {
                snapshots.docs.forEach((listval) => {
                    var data = listval.data();
                    $('#user').append($("<option></option>")
                        .attr("value", data.id)
                        .text(data.fullName));
                })
            });
            database.collection('driver_users').get().then(async function (snapshots) {
                snapshots.docs.forEach((listval) => {
                    var data = listval.data();
                    $('#driver').append($("<option></option>")
                        .attr("value", data.id)
                        .text(data.fullName));
                })
            });
            database.collection('settings').doc('payment').get().then(async function (snapshots) {
                var data = snapshots.data();
                Object.keys(data).forEach((listval) => {
                    $('#payment_method').append($("<option></option>")
                        .attr("value", data[listval].name)
                        .text(data[listval].name));
                })
            });
        });
        var headerArray = ['Ride Id', 'From', 'To', 'Ride Date', 'Ride Time', 'Ride Distance', 'Payment Status', 'Payment Method', 'Ride Status', 'User Name', 'User Email', 'User Phone Number', 'Driver Name', 'Driver Email', 'Driver Phone Number', 'Service Type', 'Parcel Dimension', 'Parcel Weight', 'Number Of Passenger', 'Offer Rate', 'Final Rate', 'Total'];
        var headers = [];

        $(document).on('click', '.download-user-report', async function () {
            var query = database.collection("orders_intercity");
            var order_status = $("#order_status :selected").val();
            var intercity_service = $("#intercity_service :selected").val();
            var user = $("#user :selected").val();
            var driver = $("#driver :selected").val();
            var payment_method = $("#payment_method :selected").val();
            let ride_date_from = moment($('#reportrange').data('daterangepicker').startDate).toDate();
            let ride_date_to = moment($('#reportrange').data('daterangepicker').endDate).toDate();
            var fileFormat = $(".file_format :selected").val();
            if (order_status != "") {
                query = query.where('status', '==', order_status)
            }
            if (intercity_service != "") {
                query = query.where('intercityServiceId', '==', intercity_service)
            }
            if (user != "") {
                query = query.where('userId', '==', user)
            }
            if (driver != "") {
                query = query.where('driverId', '==', driver)
            }
            if (payment_method != "") {
                query = query.where('paymentType', '==', payment_method)
            }
            if (ride_date_from != "") {
                query = query.where('createdDate', '>=', ride_date_from)
            }
            if (ride_date_to != "") {
                query = query.where('createdDate', '<=', ride_date_to)
            }
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
            } else {
                jQuery("#overlay").show();
                query.get().then(async function (querySnapshot) {
                    if (querySnapshot.docs.length > 0) {
                        var filterData = await getData(querySnapshot, fileFormat);

                        if ((fileFormat == "pdf") ? document.title = "intercity-ride-report" : "");

                        objectExporter({
                            type: fileFormat,
                            exportable: filterData,
                            headers: headers,
                            columnSeparator: ',',
                            fileName: 'intercity-ride-report',
                            headerStyle: 'font-weight: bold; padding: 5px; border: 1px solid #dddddd;',
                            cellStyle: 'border: 1px solid lightgray; margin-bottom: -1px;',
                            documentTitle: '',
                            sheetName: 'intercity-ride-report'
                        });
                        jQuery("#overlay").hide();
                        setDateData();
                        $('.file_format').val('').trigger('change');
                        $('#order_status').val('').trigger('change');
                        $('#intercity_service').val('').trigger('change');
                        $('#user').val('').trigger('change');
                        $('#driver').val('').trigger('change');
                        $('#ride_date_from').val("");
                        $('#ride_date_to').val("");
                    } else {
                        jQuery("#overlay").hide();
                        setDateData();
                        $('.file_format').val('').trigger('change');
                        $('#order_status').val('').trigger('change');
                        $('#intercity_service').val('').trigger('change');
                        $('#user').val('').trigger('change');
                        $('#driver').val('').trigger('change');
                        $('#ride_date_from').val("");
                        $('#ride_date_to').val("");
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.not_found_data_error')}}</p>");
                        window.scrollTo(0, 0);
                    }
                }).catch((error) => {
                    console.log("Error getting documents: ", error);
                    $(".error_top").show();
                    $(".error_top").html(error);
                    window.scrollTo(0, 0);
                });
            }
        })

        async function getData(querySnapshot, fileFormat) {
            var dataArray = [];
            await Promise.all(querySnapshot.docs.map(async (doc) => {
                var obj = doc.data();
                var newObj = {};
                var amount = parseFloat(obj.offerRate);
                var total_amount = 0;
                newObj['Ride Id'] = obj.id;
                if (fileFormat == "csv") {
                    newObj['From'] = obj.sourceLocationName.replace(/,/g, '');
                    newObj['To'] = obj.destinationLocationName.replace(/,/g, '');
                }else{
                    newObj['From'] = obj.sourceLocationName;
                    newObj['To'] = obj.destinationLocationName;
                }
                newObj['Ride Date'] = moment(obj.createdDate.toDate()).format('ddd MMM DD YYYY h:mm:ss A');
                newObj['Ride Time'] = formatTime(obj.whenTime);
                newObj['Ride Distance'] = parseFloat(obj.distance).toFixed(2) + ((obj.distanceType) ? obj.distanceType : 'Km');
                newObj['Payment Status'] = (obj.paymentStatus) ? 'Paid' : 'Not Paid';
                newObj['Payment Method'] = obj.paymentType;
                newObj['Ride Status'] = obj.status;
                if (obj.userId) {
                    var userInfo = await getUser(obj.userId);
                    newObj['User Name'] = userInfo && userInfo.fullName?userInfo.fullName:'';
                    newObj['User Email'] = userInfo && userInfo.email?userInfo.email:'';
                    //newObj['User Phone Number'] = userInfo && userInfo.phoneNumber?userInfo.phoneNumber:'NULL';
                    newObj['User Phone Number'] = userInfo && userInfo.phoneNumber ?('(+'+(userInfo.countryCode.includes('+')?userInfo.countryCode.slice(1):userInfo.countryCode)+') '+userInfo.phoneNumber):'';

                } else {
                    newObj['User Name'] = '';
                    newObj['User Email'] = '';
                    newObj['User Phone Number'] = '';
                }
                if (obj.driverId) {
                    var driverInfo = await getDriver(obj.driverId);
                    newObj['Driver Name'] = driverInfo && driverInfo.fullName?driverInfo.fullName:'';
                    newObj['Driver Email'] = driverInfo && driverInfo.email?driverInfo.email:'';
                    //newObj['Driver Phone Number'] = driverInfo && driverInfo.phoneNumber?driverInfo.phoneNumber:'NULL';
                    newObj['Driver Phone Number'] = driverInfo && driverInfo.phoneNumber ?('(+'+(driverInfo.countryCode.includes('+')?driverInfo.countryCode.slice(1):driverInfo.countryCode)+') '+driverInfo.phoneNumber):'';

                } else {
                    newObj['Driver Name'] = '';
                    newObj['Driver Email'] = '';
                    newObj['Driver Phone Number'] = '';
                }
                newObj['Service Type'] = obj.intercityService.name;
                if (obj.intercityService.name == "Parcel") {
                    newObj['Parcel Dimension'] = obj.parcelDimension + " ft";
                    newObj['Parcel Weight'] = obj.parcelWeight + ' Kg';
                } else {
                    newObj['Parcel Dimension'] = '';
                    newObj['Parcel Weight'] = '';
                }
                if (obj.numberOfPassenger) {
                    newObj['Number Of Passenger'] = obj.numberOfPassenger;
                } else {
                    newObj['Number Of Passenger'] = '';
                }
                if (obj.driverId && obj.driverId != null) {
                    var amount = 0;
                    var total_amount = 0;
                    var offer_rate = 0;
                    var final_rate = 0;
                    if (obj.offerRate) {
                        amount = parseFloat(obj.offerRate);
                        offer_rate = parseFloat(obj.offerRate);
                    }
                    if (obj.finalRate) {
                        amount = parseFloat(obj.finalRate);
                        final_rate = parseFloat(obj.finalRate);
                    }
                    total_amount = amount;
                    var discount_amount = 0;
                    if (obj.hasOwnProperty('coupon') && obj.coupon.enable) {
                        var data = obj.coupon;

                        if (data.type == "fix") {
                            discount_amount = data.amount;
                        } else {
                            discount_amount = (data.amount * amount) / 100;
                        }

                        total_amount -= parseFloat(discount_amount);

                    }
                    var admin_commision_amount = amount - discount_amount;
                    if (obj.hasOwnProperty('taxList') && obj.taxList.length > 0) {
                        var taxData = obj.taxList;

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
                    if (obj.hasOwnProperty('adminCommission') && obj.adminCommission.isEnabled) {
                        var data = obj.adminCommission;

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
                    newObj['Offer Rate'] = offer_rate;
                    newObj['Final Rate'] = final_rate;
                    newObj['Total'] = total_amount;
                } else {
                    newObj['Offer Rate'] = ((obj.offerRate) ? (symbolAtRight ? (parseFloat(obj.offerRate).toFixed(decimal_degits) + currentCurrency) : (currentCurrency + parseFloat(obj.offerRate).toFixed(decimal_degits))) : "");
                    newObj['Final Rate'] = ((obj.finalRate) ? (symbolAtRight ? (parseFloat(obj.finalRate).toFixed(decimal_degits) + currentCurrency) : (currentCurrency + parseFloat(obj.finalRate).toFixed(decimal_degits))) : "");
                    newObj['Total'] = "";
                }
                dataArray.push(newObj);
            }));
            return dataArray;
        }

        async function getUser(userId) {
            var userData;
            await database.collection('users').doc(userId).get().then(async function (snapshots) {
                userData = snapshots.data();
            });
            return userData;
        }

        async function getDriver(driverId) {
            var driverData;
            await database.collection('driver_users').doc(driverId).get().then(async function (snapshots) {
                driverData = snapshots.data();
            });
            return driverData;
        }

        function formatTime(timeString) {
            const [hourString, minute] = timeString.split(":");
            const hour = +hourString % 24;
            return (hour % 12 || 12) + ":" + minute + (hour < 12 ? " AM" : " PM");
        }
    </script>
@endsection
