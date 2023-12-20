@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.reports_driver')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('/reports/driver')}}">{{trans('lang.report_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.reports_driver')}}</li>
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
                            <legend>{{trans('lang.reports_driver')}}</legend>
                          
                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.select_status')}}</label>
                                <div class="col-7">
                                    <select class="form-control status">
                                        <option value="all">{{trans('lang.all_drivers')}}</option>
                                        <option value="approved">{{trans('lang.approved_drivers')}}</option>
                                        <option value="pending">{{trans('lang.approval_pending_drivers')}}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.file_format')}}<span class="required-field"></span></label>
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
                    <button type="submit" class="btn btn-primary download-driver-report"><i class="fa fa-save"></i> {{ trans('lang.download')}}</button>
                </div>

            </div>

        </div>
     </div>
    </div>
@endsection

@section('scripts')
<script>
    var database = firebase.firestore();
    var driverUserRef = database.collection('driver_users');
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

    async function getServiceName(serviceId) {
        var title = '';
        if(serviceId){
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
        if(vehicleId){
            await database.collection('vehicle_type').where('id', '==', vehicleId).get().then(async function (snapshots) {
                if (snapshots.docs.length > 0) {
                    var vehicle = snapshots.docs[0].data();
                    title = vehicle.name;
                }
            });
        }
        return title;
    }
    function dateFormat(dateRegistred){
        var date = new Date(dateRegistred.seconds * 1000);
        var newDate = date.toLocaleDateString('en-CA');
        return newDate;
    }
    async function generateReport(driverData, headers, fileFormat){
        await objectExporter({
            type: fileFormat,
            exportable: driverData,
            headers: headers,
            columnSeparator: ',',
            fileName: 'user-report',
            headerStyle: 'font-weight: bold; padding: 5px; border: 1px solid #dddddd;',
            cellStyle: 'border: 1px solid lightgray; margin-bottom: -1px;',
            documentTitle : '',
            sheetName: 'user-report'
        })
    }
    $(document).on('click', '.download-driver-report', function(){
        var status = $(".status :selected").val();
        var fileFormat = $(".file_format :selected").val();       
        var headerArray = ['Name', 'Email', 'PhoneNumber', 'LoginType', 'Document Verified',  'Wallet Amount', 'latitude', 'longitude', 'Vehicle Type', 'Vehicle Color', 'Vehicle Number', 'Vehicle Seats', 'Vehicle Registration date', 'Vehicle Name', 'Service'];        
        var headers = [];
        if(fileFormat == 'xls' || fileFormat == 'csv'){
            headers = headerArray
            var script = document.createElement("script");
            script.setAttribute("src", "https://unpkg.com/object-exporter@3.2.1/dist/objectexporter.min.js");
            script.setAttribute("async", "false");
            var head = document.head;
            head.insertBefore(script, head.firstChild);
        }else{
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
            var allDrivers  = driverUserRef;
            var pendingDrivers  = driverUserRef.where('documentVerification', '==', false);
            var approvedDrivers  = driverUserRef.where('documentVerification', '==', true);
            var driverRef = ((status == 'approved')?approvedDrivers:((status == 'pending')?pendingDrivers:allDrivers))
            driverRef.get().then( async function(driverSnapshots){
                if(driverSnapshots.docs.length > 0){
                    var driverData = await getData(driverSnapshots);

                    if ((fileFormat == "pdf") ? document.title = "driver-report" : "");

                    objectExporter({
                        type: fileFormat,
                        exportable: driverData,
                        headers: headers,
                        columnSeparator: ',',
                        fileName: 'driver-report',
                        headerStyle: 'font-weight: bold; padding: 5px; border: 1px solid #dddddd;',
                        cellStyle: 'border: 1px solid lightgray; margin-bottom: -1px;',
                        documentTitle : '',
                        sheetName: 'driver-report',

                })
                    $('.file_format option[value=""]').attr('selected','selected');
                    $('.status option[value="all"]').attr('selected','selected');
                    jQuery("#overlay").hide();
                }else{
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.not_found_data_error')}}</p>");
                    window.scrollTo(0, 0);
                }
            });
        }
    })
    async function getData(querySnapshot) {
        var driverData = [];
        await Promise.all(querySnapshot.docs.map(async (doc) => {
            var driverObj = doc.data();
            var newDriverObj = {};
            newDriverObj['Name'] = driverObj.fullName;
            newDriverObj['Email'] = driverObj.email;
            newDriverObj['PhoneNumber'] = '(+'+(driverObj.countryCode.includes('+')?driverObj.countryCode.slice(1):driverObj.countryCode)+') '+driverObj.phoneNumber;
            newDriverObj['LoginType'] = (driverObj.loginType)?driverObj.loginType:'';
            newDriverObj['Document Verified'] = ((driverObj.documentVerification)?'Yes':'No');
            newDriverObj['Wallet Amount'] = ((driverObj.walletAmount) ? (symbolAtRight ? (parseFloat(driverObj.walletAmount).toFixed(decimal_degits) + currentCurrency) : (currentCurrency + parseFloat(driverObj.walletAmount).toFixed(decimal_degits))) : "");

            //newDriverObj['Wallet Amount'] = ((driverObj.walletAmount)?driverObj.walletAmount:'');
            if(driverObj.location){
                newDriverObj['latitude'] = ((driverObj.location && driverObj.location.latitude)?driverObj.location.latitude:'');
                newDriverObj['longitude'] = ((driverObj.location && driverObj.location.longitude)?driverObj.location.longitude:'');
            }else{
                newDriverObj['latitude'] = '';
                newDriverObj['longitude'] = '';
            }
            if(driverObj.vehicleInformation){
                var vehicleInfo = driverObj.vehicleInformation;
                newDriverObj['Vehicle Type'] = (vehicleInfo.vehicleType)?vehicleInfo.vehicleType:'';
                newDriverObj['Vehicle Color'] = (vehicleInfo.vehicleColor)?vehicleInfo.vehicleColor:'';
                newDriverObj['Vehicle Number'] = (vehicleInfo.vehicleNumber)?vehicleInfo.vehicleNumber:'';
                newDriverObj['Vehicle Seats'] = (vehicleInfo.seats)?vehicleInfo.seats:0;
                newDriverObj['Vehicle Registration date'] = (vehicleInfo.registrationDate)?dateFormat(vehicleInfo.registrationDate):'';
                var vehicleName =  await getVehicleName(vehicleInfo.vehicleTypeId)
                newDriverObj['Vehicle Name'] = vehicleName?vehicleName:'';
            }else{
                newDriverObj['Vehicle Name'] = '';
                newDriverObj['Vehicle Type'] = '';
                newDriverObj['Vehicle Color'] = '';
                newDriverObj['Vehicle Number'] = '';
                newDriverObj['Vehicle Seats'] = '';
                newDriverObj['Vehicle Registration date'] = '';
            }
            var serviceName = await getServiceName(driverObj.serviceId)
            newDriverObj['Service'] = serviceName?serviceName:'';
            driverData.push(newDriverObj);
        }));
        return driverData;
    } 
</script>
@endsection
