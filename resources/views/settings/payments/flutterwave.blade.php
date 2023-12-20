@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="card">
            <div class="payment-top-tab mt-3 mb-3">
                <ul class="nav nav-tabs card-header-tabs align-items-end">
                    <li class="nav-item">
                        <a class="nav-link stripe_active_label" href="{!! url('settings/payments/stripe') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_stripe')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cod_active_label" href="{!! url('settings/payments/cod') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_cod_short')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                         <a class="nav-link apple_pay_active_label" href="{!! url('settings/payments/applepay') !!}"><i
                                     class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_apple_pay')}}<span
                                     class="badge ml-2"></span>
                         </a>
                     </li>--}}
                    <li class="nav-item">
                        <a class="nav-link razorpay_active_label" href="{!! url('settings/payments/razorpay') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_razorpay')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link paypal_active_label" href="{!! url('settings/payments/paypal') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_paypal')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link paytm_active_label" href="{!! url('settings/payments/paytm') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_paytm')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link wallet_active_label" href="{!! url('settings/payments/wallet') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_wallet')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link payfast_active_label" href="{!! url('settings/payments/payfast') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.payfast')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link paystack_active_label" href="{!! url('settings/payments/paystack') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_paystack_lable')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active flutterWave_active_label"
                           href="{!! url('settings/payments/flutterwave') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.flutterWave')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mercadopago_active_label"
                           href="{!! url('settings/payments/mercadopago') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.mercadopago')}}<span
                                    class="badge ml-2"></span></a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div id="data-table_processing" class="dataTables_processing panel panel-default"
                     style="display: none;">Processing...
                </div>
                <div class="row restaurant_payout_create">
                    <div class="restaurant_payout_create-inner">
                        <fieldset>
                            <legend>{{trans('lang.app_setting_flutterWave')}}</legend>
                            <div class="form-check width-100">
                                <input type="checkbox" class=" enable_payment_method" id="enable_payment_method">
                                <label class="col-3 control-label"
                                       for="enable_payment_method">{{trans('lang.app_setting_enable_payment')}}</label>
                            </div>

                            <div class="form-check width-100">
                                <input type="checkbox" class="sand_box_mode" id="sand_box_mode">
                                <label class="col-3 control-label"
                                       for="sand_box_mode">{{trans('lang.app_setting_enable_sandbox_mode')}}</label>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.app_setting_secretKey')}}</label>
                                <div class="col-7">
                                    <input type="password" class="form-control secretKey">
                                    <div class="form-text text-muted">
                                        {!! trans('lang.app_setting_secretKey_help') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.app_setting_publicKey')}}</label>
                                <div class="col-7">
                                    <input type="password" class=" form-control publicKey">
                                    <div class="form-text text-muted">
                                        {!! trans('lang.app_setting_publicKey_help') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.app_setting_encryptionKey')}}</label>
                                <div class="col-7">
                                    <input type="password" class=" form-control encryptionKey">
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.image')}}</label>
                                <div class="col-7">
                                    <input type="file" class=" col-7 form-control stripe-image"
                                           onChange="handleFileSelect(event)">
                                    <div class="form-text text-muted">
                                        {!! trans('lang.payment_method_image_help') !!}
                                    </div>
                                    <div class="placeholder_img_thumb payment_image"></div>
                                    <div id="uploding_image"></div>
                                </div>
                            </div>

                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="form-group col-12 text-center btm-btn">
                <button type="button" class="btn btn-primary save_flutterWave_btn"><i
                            class="fa fa-save"></i> {{trans('lang.save')}}</button>
                <a href="{{url('/dashboard')}}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        var database = firebase.firestore();
        var paymentRef = database.collection('settings').doc('payment');
        var photo = "";
        var fileName = "";
        var ImageFile = "";
        var storageRef = firebase.storage().ref('images');
        var storage = firebase.storage();
        $(document).ready(function () {

            $('.setting_menu').addClass('active').attr('aria-expanded', true);
            $('.setting_payment_menu').addClass('active');
            $('.setting_sub_menu').addClass('in').attr('aria-expanded', true);


            jQuery("#overlay").show();
            paymentRef.get().then(async function (paymentSnapshots) {
                var payment = paymentSnapshots.data().flutterWave;
                if (payment.enable) {
                    $("#enable_payment_method").prop('checked', true);

                    jQuery(".flutterWave_active_label span").addClass('badge-success');
                    jQuery(".flutterWave_active_label span").text('Active');
                }
                if (payment.isSandbox) {
                    $("#sand_box_mode").prop('checked', true);
                }
                $('.secretKey').val(payment.secretKey);
                $('.publicKey').val(payment.publicKey);
                $('.encryptionKey').val(payment.encryptionKey);

                if (payment.hasOwnProperty('image')) {

                    if (payment.image != '' && payment.image != null) {
                        $(".payment_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + payment.image + '" alt="image"></span>');
                        photo = payment.image;
                        ImageFile = payment.image;
                    } else {
                        photo = "";
                        //$(".payment_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image"></span>');
                    }
                }

                var cash = paymentSnapshots.data().cash;
                if (cash.enable) {
                    $(".enable_cod").prop('checked', true);

                    $(".cod_active_label span").addClass('badge-success');
                    $(".cod_active_label span").text('Active');
                }

                var mercadoPago = paymentSnapshots.data().mercadoPago;

                if (mercadoPago.enable) {
                    jQuery(".mercadopago_active_label span").addClass('badge-success');
                    jQuery(".mercadopago_active_label span").text('Active');
                }


                var payStack = paymentSnapshots.data().payStack;

                if (payStack.enable) {
                    jQuery(".paystack_active_label span").addClass('badge-success');
                    jQuery(".paystack_active_label span").text('Active');
                }

                var payfast = paymentSnapshots.data().payfast;

                if (payfast.enable) {
                    jQuery(".payfast_active_label span").addClass('badge-success');
                    jQuery(".payfast_active_label span").text('Active');
                }

                var paypal = paymentSnapshots.data().paypal;

                if (paypal.enable) {
                    jQuery(".paypal_active_label span").addClass('badge-success');
                    jQuery(".paypal_active_label span").text('Active');
                }

                var paytm = paymentSnapshots.data().paytm;

                if (paytm.enable) {
                    jQuery(".paytm_active_label span").addClass('badge-success');
                    jQuery(".paytm_active_label span").text('Active');
                }

                var razorpay = paymentSnapshots.data().razorpay;

                if (razorpay.enable) {
                    jQuery(".razorpay_active_label span").addClass('badge-success');
                    jQuery(".razorpay_active_label span").text('Active');
                }

                var strip = paymentSnapshots.data().strip;

                if (strip.enable) {
                    jQuery(".stripe_active_label span").addClass('badge-success');
                    jQuery(".stripe_active_label span").text('Active');
                }

                var wallet = paymentSnapshots.data().wallet;

                if (wallet.enable) {
                    jQuery(".wallet_active_label span").addClass('badge-success');
                    jQuery(".wallet_active_label span").text('Active');
                }

                jQuery("#overlay").hide();
            })
            $(".save_flutterWave_btn").click(function () {
                
                var secretKey = $(".secretKey").val();
                var publicKey = $(".publicKey").val();
                var encryptionKey = $(".encryptionKey").val();
                var isEnabled = $("#enable_payment_method").is(":checked");
                var isSandBox = $("#sand_box_mode").is(":checked");
                storeImageData().then(IMG => {
                    database.collection('settings').doc("payment").update({
                        'flutterWave.enable': isEnabled,
                        'flutterWave.isSandbox': isSandBox,
                        'flutterWave.secretKey': secretKey,
                        'flutterWave.publicKey': publicKey,
                        'flutterWave.encryptionKey': encryptionKey,
                        'flutterWave.image': IMG,
                    }).then(function (result) {
                        window.location.href = '{{ url("settings/payments/flutterwave")}}';
                    });
                }).catch(err => {
                    jQuery("#overlay").hide();
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + err + "</p>");
                    window.scrollTo(0, 0);
                });
            })
        })

        async function storeImageData() {
            var newPhoto = '';
            try {
                if (ImageFile != "" && photo != ImageFile) {
                    var OldImageUrlRef = await storage.refFromURL(ImageFile);
                    await OldImageUrlRef.delete().then(() => {
                        console.log("Old file deleted!")
                    }).catch((error) => {
                        console.log("ERR File delete ===", error);
                    });
                }
                if (photo != ImageFile) {
                    photo = photo.replace(/^data:image\/[a-z]+;base64,/, "")
                    var uploadTask = await storageRef.child(fileName).putString(photo, 'base64', {contentType: 'image/jpg'});
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
                    $(".payment_image").empty();
                    $(".payment_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + filePayload + '" alt="image"></span>');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    </script>
@endsection