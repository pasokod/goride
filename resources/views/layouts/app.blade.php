<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      <?php if (str_replace('_', '-', app()->getLocale()) == 'ar' || @$_COOKIE['is_rtl'] == 'true') { ?> dir="rtl" <?php } ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'GoRide') }}</title>
    <link rel="icon" id="favicon" type="image/x-icon" href="">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <?php if(str_replace('_', '-', app()->getLocale()) == 'ar' || @$_COOKIE['is_rtl'] == 'true'){ ?>
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    <?php } ?>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <?php if(str_replace('_', '-', app()->getLocale()) == 'ar' || @$_COOKIE['is_rtl'] == 'true'){ ?>
    <link href="{{asset('css/style_rtl.css')}}" rel="stylesheet">
    <?php } ?>
    
    <link href="{{ asset('css/icons/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icons/font-awesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{ asset('css/colors/blue.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

</head>

<body>
<div id="app" class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">

        <header class="topbar">

            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                @include('layouts.header')
            </nav>

        </header>

        <aside class="left-sidebar">

            <!-- Sidebar scroll-->

            <div class="scroll-sidebar">

                @include('layouts.menu')

            </div>

            <!-- End Sidebar scroll-->

        </aside>

        <footer class="footer">

            @include('layouts.footer')

        </footer>

    </div>

    <main class="py-4">
        @yield('content')
        <div id="overlay" style="display:none">
            <img src="{{ asset('images/spinner.gif') }}">
        </div>
    </main>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('js/waves.js') }}"></script>
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.js')}}"></script>
<script src="{{ asset('js/jquery.resizeImg.js') }}"></script>
<script src="{{ asset('js/mobileBUGFix.mini.js') }}"></script>

<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-functions.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>

<script src="{{ asset('js/chosen.jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('js/crypto-js.js') }}"></script>
<script src="{{ asset('js/jquery.cookie.js') }}"></script>
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

<script>
    var appLogo = '';
    var appFavIconLogo = '';
    var googleApiKey = '';
    var database = firebase.firestore();
    
    let globalRef = database.collection('settings').doc('global');
    globalRef.get().then(async function (snapshots) {
        var globalSetting = snapshots.data();
        if (globalSetting.appVersion != '') {
            $(".web_version").text('V:' + globalSetting.appVersion);
        }
    });

    $(document).ready(function () {
        let globalLogoRef = database.collection('settings').doc('logo');
        globalLogoRef.get().then(async function (snapshots) {
            var globalLogoSetting = snapshots.data();
            $("#favicon").attr("href", globalLogoSetting.appFavIconLogo)
            $(".dark-logo").attr("src", globalLogoSetting.appLogo);
            $(".light-logo").attr("src", globalLogoSetting.appLogo);
            // appLogo = (globalLogoSetting.appLogo) ? globalLogoSetting.appLogo : "{{ asset('images/goride-logo.png') }}";
            // appFavIconLogo = (globalLogoSetting.appFavIconLogo) ? globalLogoSetting.appFavIconLogo : "{{ asset('images/favicon.png') }}";
        });
    });

    var refGlobalSetting = database.collection('settings').doc('globalValue');

    refGlobalSetting.get().then(function (globalData) {

        var globalValue = globalData.data();

        if (globalValue && globalValue.hasOwnProperty('distanceType')) {
            $('.global_value').html(globalValue.distanceType + " {{trans('lang.charge')}}");
            $('.global_value_label').html(globalValue.distanceType + " {{trans('lang.charge')}}" + '<span class="required-field"></span>');
            $('.global_value_text').html("{{trans('lang.enter')}} " + globalValue.distanceType + " {{trans('lang.charge')}}");
            $('#distanceType').val(globalValue.distanceType);
        } else {
            $('.global_value').html('{{trans("lang.km_charge")}}');
            $('.global_value_text').html('{{ trans("lang.km_charge_help") }}');
            $('#distanceType').val('Km');
        }
    });

    async function sendNotification(fcmToken = '', title, body) {

        var checkFlag = false;
        var sendNotificationUrl = "{{ route('send-notification') }}";

        if (fcmToken !== '') {
            await $.ajax({
                type: 'POST',

                url: sendNotificationUrl,

                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'fcm': fcmToken,
                    'title': title,
                    'message': body
                },
                success: function (data) {
                    checkFlag = true;
                },
                error: function (error) {
                    checkFlag = true;
                }
            });
        } else {
            checkFlag = true;
        }

        return checkFlag;
    }

</script>

<script type="text/javascript">

    var doNotDeleteAlert = "This is for demo, We can not allow to delete";
    var doNotUpdateAlert = "This is for demo, We can not allow to update content";

    jQuery(window).scroll(function () {
        var scroll = jQuery(window).scrollTop();
        if (scroll <= 60) {
            jQuery("body").removeClass("sticky");
        } else {
            jQuery("body").addClass("sticky");
        }
    });

    var langcount = 0;
    var languages_list = database.collection('languages').where('isDeleted','==',false);
    languages_list.get().then(async function (snapshotslang) {
        if (snapshotslang.docs.length > 0) {
            snapshotslang.docs.forEach((doc) => {
                var data = doc.data();
                if (data.enable == true) {
                    langcount++;
                    $('#language_dropdown').append($("<option></option>").attr("value", data.id).attr("data-isrtl", data.isRtl).text(data.name));
                }
            });
            
            if (langcount > 1) {
                $("#language_dropdown_box").css('visibility', 'visible');
            }
            <?php if(session()->get('locale')){ ?>
                $("#language_dropdown").val("<?php echo session()->get('locale'); ?>");
            <?php } ?>

        }
    });

    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function () {
        var slug = $(this).val();
        var isrtl = $(this).find(':selected').data('isrtl');
        if (isrtl == true) {
            setCookie('is_rtl', isrtl.toString(), 365);
        } else {
            setCookie('is_rtl', 'false', 365);
        }
        window.location.href = url + "?lang=" + slug;
    });
    
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    async function loadGoogleMapsScript() {
        
        var globalKeySnapshot = await database.collection('settings').doc("globalKey").get();
        var globalKeyData = globalKeySnapshot.data();
        googleMapKey = globalKeyData.googleMapKey;
        const script = document.createElement('script');
        script.src = "https://maps.googleapis.com/maps/api/js?key=" + googleMapKey + "&libraries=places";
        script.onload = function () {
            navigator.geolocation.getCurrentPosition(GeolocationSuccessCallback,GeolocationErrorCallback);
        };
        document.head.appendChild(script);
    }

    const GeolocationSuccessCallback = (position) => {
        if(position.coords != undefined){
            default_latitude = position.coords.latitude
            default_longitude = position.coords.longitude
            setCookie('default_latitude', default_latitude, 365);
            setCookie('default_longitude', default_longitude, 365);
        }
    };

    const GeolocationErrorCallback = (error) => {
        console.log('Error: You denied for your default Geolocation',error.message);
        setCookie('default_latitude', '23.022505', 365);
        setCookie('default_longitude','72.571365', 365);
    };

    loadGoogleMapsScript();

</script>

@yield('scripts')

</body>
</html>
