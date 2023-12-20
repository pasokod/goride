@extends('layouts.app')

@section('content')

    <div class="page-wrapper">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.drivers_wallet_transactions')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.drivers_wallet_transactions')}}</li>
                </ol>
            </div>
            <div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive m-t-10">
                                <table id="userTable"
                                       class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>


                                        <th>{{trans('lang.id')}}</th>
                                        <th>{{trans('lang.user_name')}}</th>
                                        <th>{{trans('lang.payment_method')}}</th>
                                        <th>{{trans('lang.total_amount')}}</th>
                                        <th>{{trans('lang.note')}}</th>
                                        <th>{{trans('lang.date')}}</th>
                                        <th>{{trans('lang.actions')}} </th>

                                    </tr>
                                    </thead>
                                    <tbody id="append_list1">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')


    <script type="text/javascript">

        var database = firebase.firestore();

        var symbolAtRight = false;
        var ref = database.collection('wallet_transaction').where("userType", "==", 'driver').orderBy('createdDate', 'desc');
        var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');

        refCurrency.get().then(async function (snapshots) {
            var currencyData = snapshots.docs[0].data();
            currentCurrency = currencyData.symbol;
            decimal_degits = currencyData.decimalDigits;

            if (currencyData.symbolAtRight) {
                symbolAtRight = true;
            }
        });

        var append_list = '';

        var deleteMsg = "{{trans('lang.delete_alert')}}";
        var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";

        $(document).ready(function () {

            jQuery("#overlay").show();

            append_list = document.getElementById('append_list1');
            append_list.innerHTML = '';
            ref.get().then(async function (snapshots) {

                var html = '';
                if (snapshots.docs.length > 0) {
                    html = await buildHTML(snapshots);
                    jQuery("#overlay").hide();
                }
                if (html != '') {
                    append_list.innerHTML = html;
                }

                $('#userTable').DataTable({
                    order: [],
                    columnDefs: [
                        {
                            targets: 5,
                            type: 'date',
                            render: function (data) {
                                return data;
                            }
                        },
                        {orderable: false, targets: [2, 6]},
                    ],
                    order : [['5','desc']],
                    "language": {
                        "zeroRecords": "{{trans('lang.no_record_found')}}",
                        "emptyTable": "{{trans('lang.no_record_found')}}"
                    }
                });
            });

        });


        async function buildHTML(snapshots) {
            var html = '';
            await Promise.all(snapshots.docs.map(async (listval) => {
                var val = listval.data();
                var getData = await getListData(val);
                html += getData;
            }));
            return html;
        }

        async function getListData(val) {
            var html = '';
            html = html + '<tr>';
            newdate = '';
            var id = val.userId;
            var route1 = '{{route("drivers.view",":id")}}';
            route1 = route1.replace(':id', id);
            var t_id = val.id;
            var transaction = t_id.substring(0, 7);
            html = html + '<td>' + transaction + '</td>';
            if (val.userId) {
                var userName = await payoutuserfunction(val.userId);
                if (userName) {
                    html = html + '<td><a class="user_role_' + val.userId + '" href="' + route1 + '">' + userName + '</a></td>';

                } else {
                    html = html + '<td>{{trans("lang.unknown_user")}}</td>';

                }
            } else {
                html = html + '<td></td>';
            }
            var paymentIMG = await getPaymentImage(val.paymentType, val.id);
            html = html + '<td><span class="payment_method_' + val.id + '"><img style="width:100px" src="' + paymentIMG + '" alt="image"></span></td>';
            if (val.amount.charAt(0) == "-") {
                amount = Math.abs(val.amount);
                if (symbolAtRight) {
                    amount = parseFloat(amount).toFixed(decimal_degits) + currentCurrency;
                } else {
                    amount = currentCurrency + parseFloat(amount).toFixed(decimal_degits);
                }
                html = html + '<td><span class="text-danger">(-' + amount + ')</span></td>';
            } else {
                if (symbolAtRight) {
                    amount = parseFloat(val.amount).toFixed(decimal_degits) + currentCurrency;
                } else {
                    amount = currentCurrency + parseFloat(val.amount).toFixed(decimal_degits);
                }
                html = html + '<td><span class="text-success">(' + amount + ')</span></td>';
            }
            html = html + '<td>' + val.note + '</td>';
            if (val.hasOwnProperty("createdDate")) {
                var date = val.createdDate.toDate().toDateString();
                var time = val.createdDate.toDate().toLocaleTimeString('en-US');
                html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';
            } else {
                html = html + '<td></td>';
            }
            if (val.orderType != null && val.orderType!='') {
                if (val.orderType == 'city') {
                    var trroute1 = '{{route("rides.show",":id")}}';
                    trroute1 = trroute1.replace(':id', val.transactionId);
                } else {
                    var trroute1 = '{{route("intercity-service-rides.view",":id")}}';
                    trroute1 = trroute1.replace(':id', val.transactionId);
                }
                html = html + '<td class="action-btn"><a href="' + trroute1 + '"><i class="fa fa-file-pdf-o " aria-hidden="true"></i></a></td>';
            } else {
                html = html + '<td></td>';

            }
            html = html + '</tr>';
            return html;
        }

        async function payoutuserfunction(user) {
            var payoutuser = '';
            await database.collection('driver_users').where("id", "==", user).get().then(async function (snapshotss) {
                if (snapshotss.docs[0]) {
                    var user_data = snapshotss.docs[0].data();
                    payoutuser = user_data.fullName;
                    // jQuery(".user_role_" + user).html(user_data.fullName);
                }
            });
            return payoutuser;
        }

        async function getPaymentImage(paymentType, id) {
            var img = '';
            paymentType =  paymentType.charAt(0).toUpperCase() + paymentType.slice(1);

            await database.collection('settings').doc('payment').get().then(async function (snapshots) {
                var payment = snapshots.data();
                var payamentData = Object.values(payment).filter((data) => data.name == paymentType).map((filterData) => filterData)
                // type = paymentType.toLowerCase();
                // if (type == "flutterwave") {
                //     type = "flutterWave";
                // }else if (type == "stripe") {
                //     type = "strip";
                // }else if (type == "paystack") {
                //     type = "payStack";
                // }else if (type == "mercadopago") {
                //     type = "mercadoPago";
                // }
                // payment = payment[type];

                img = payamentData[0].image;
                // $('.payment_method_'+id).html('<img style="width:100px" src="' + payment.image + '" alt="image">');
            });
            return img;
        }

    </script>

@endsection
