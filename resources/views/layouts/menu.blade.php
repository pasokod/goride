@php
$user=Auth::user();
$role_has_permission = App\Models\Permission::where('role_id',$user->role_id)->pluck('permission')->toArray();

@endphp
<nav class="sidebar-nav">

    <ul id="sidebarnav">

        <li>
            <a class="waves-effect waves-dark" href="{!! url('dashboard') !!}" aria-expanded="false">

                <i class="mdi mdi-home"></i>

                <span class="hide-menu">{{trans('lang.dashboard')}}</span>

            </a>
        </li>
        @if(in_array('god-eye',$role_has_permission))

        <li>
            <a class="waves-effect waves-dark" href="{!! url('map') !!}" aria-expanded="false">

                <i class="mdi mdi-home-map-marker"></i>

                <span class="hide-menu">{{trans('lang.gods_eye')}}</span>

            </a>
        </li>
        @endif

        @if(in_array('admins',$role_has_permission) || in_array('roles',$role_has_permission))

        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">

                <i class="mdi mdi-lock-outline"></i>

                <span class="hide-menu">{{trans('lang.access_control')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse">
                @if(in_array('roles',$role_has_permission))
                <li><a href="{!! url('role') !!}">{{trans('lang.role_plural')}}</a></li>
                @endif

                @if(in_array('admins',$role_has_permission))
                <li><a href="{!! url('admin-users') !!}">{{trans('lang.admin_plural')}}</a></li>
                @endif
            </ul>

        </li>

        @endif

        @if(in_array('users',$role_has_permission) || in_array('drivers',$role_has_permission)
        || in_array('documents',$role_has_permission) || in_array('deleted-documents',$role_has_permission) ||
        in_array('reports',$role_has_permission))


        <li class="nav-subtitle"><span class="nav-subtitle-span">{{trans('lang.account_management')}}</span></li>

        @endif

        @if(in_array('users',$role_has_permission))
        <li>
            <a class="waves-effect waves-dark user_menu" href="{!! url('users') !!}" aria-expanded="false">

                <i class="mdi mdi-account-multiple"></i>

                <span class="hide-menu">{{trans('lang.users')}}</span>

            </a>
        </li>
        @endif

        @if(in_array('drivers',$role_has_permission) || in_array('approve_drivers',$role_has_permission) ||
        in_array('pending_drivers',$role_has_permission))
        <li>
            <a class="has-arrow waves-effect waves-dark driver_menu" href="#" aria-expanded="false">

                <i class="mdi mdi-account-card-details"></i>

                <span class="hide-menu">{{trans('lang.driver_plural')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse driver_sub_menu">
                @if(in_array('drivers',$role_has_permission))
                <li class="all_driver_menu"><a href="{!! url('drivers') !!}">{{trans('lang.all_drivers')}}</a></li>
                @endif
                @if(in_array('approve_drivers',$role_has_permission))
                <li class="approve_driver_menu"><a
                            href="{!! url('drivers/approved') !!}">{{trans('lang.approved_drivers')}}</a></li>
                @endif
                @if(in_array('pending_drivers',$role_has_permission))
                <li class="pending_driver_menu"><a
                            href="{!! url('drivers/pending') !!}">{{trans('lang.approval_pending_drivers')}}</a></li>
                @endif
            </ul>

        </li>
        @endif

        @if(in_array('documents',$role_has_permission) || in_array('deleted-documents',$role_has_permission))

        <li>
            <a class="has-arrow waves-effect waves-dark document_menu" href="#" aria-expanded="false">

                <i class="mdi mdi-file-document"></i>

                <span class="hide-menu">{{trans('lang.document_plural')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse document_sub_menu">

                @if(in_array('documents',$role_has_permission))
                <li class="all_document_menu">
                    <a href="{!! url('documents') !!}">{{trans('lang.all_document_plural')}}</a>
                </li>
                @endif
                @if(in_array('deleted-documents',$role_has_permission))
                <li class="deleted_document_menu">
                    <a href="{!! url('documents/deleted') !!}">{{trans('lang.deleted_document_plural')}}</a>
                </li>
                @endif
            </ul>

        </li>

        @endif

        @if(in_array('reports',$role_has_permission))
        <li>
            <a class="has-arrow waves-effect waves-dark report_menu" href="#" aria-expanded="false">
                <i class="mdi mdi-calendar-check"></i>
                <span class="hide-menu">{{trans('lang.report_plural')}}</span>
            </a>
            <ul aria-expanded="false" class="collapse report_sub_menu">
                <li><a href="{!! url('reports/user') !!}">{{trans('lang.reports_user')}}</a></li>
                <li><a href="{!! url('reports/driver') !!}">{{trans('lang.reports_driver')}}</a></li>
                <li><a href="{!! url('reports/ride') !!}">{{trans('lang.reports_ride')}}</a></li>
                <li><a href="{!! url('reports/intercity') !!}">{{trans('lang.intercity_report')}}</a></li>
                <li><a href="{!! url('reports/transaction') !!}">{{trans('lang.reports_transaction')}}</a></li>

            </ul>

        </li>
        @endif

        @if(in_array('service',$role_has_permission) || in_array('ride_order',$role_has_permission)
        || in_array('intercity_service',$role_has_permission) || in_array('intercity_order',$role_has_permission)
        || in_array('freight',$role_has_permission)
        || in_array('airports',$role_has_permission)
        || in_array('vehicle-type',$role_has_permission)
        || in_array('driver-rules',$role_has_permission)
        || in_array('deleted-driver-rules',$role_has_permission))

        <li class="nav-subtitle"><span class="nav-subtitle-span">{{trans('lang.ride_management')}}</span></li>

        @endif

        @if(in_array('service',$role_has_permission) || in_array('ride_order',$role_has_permission))
        <li>
            <a class="has-arrow waves-effect waves-dark rides_menu" href="#" aria-expanded="false">
                <i class="mdi mdi-map-marker-multiple"></i>
                <span class="hide-menu">{{trans('lang.order_plural')}}</span>
            </a>
            <ul aria-expanded="false" class="collapse ride_sub_menu">
                @if(in_array('service',$role_has_permission))
                <li class="services_menu"><a href="{!! url('services') !!}">{{trans('lang.service_plural')}}</a></li>
                @endif
                @if(in_array('ride_order',$role_has_permission))
                <li class="rides_menu"><a href="{!! url('rides') !!}">{{trans('lang.ride_order_plural')}}</a></li>
                @endif
            </ul>
        </li>
        @endif
        @if(in_array('intercity_service',$role_has_permission) || in_array('intercity_order',$role_has_permission))

        <li>
            <a class="has-arrow waves-effect waves-dark intercity_service_menu" href="#" aria-expanded="false">
                <i class="mdi mdi-city"></i>
                <span class="hide-menu">{{trans('lang.intercity')}}</span>
            </a>
            <ul aria-expanded="false" class="collapse intercity_service_sub_menu">
                @if(in_array('intercity_service',$role_has_permission))
                <li class="intercity_service_menu"><a
                            href="{!! url('intercity-service') !!}">{{trans('lang.intercity_service_plural')}}</a></li>
                @endif
                @if(in_array('intercity_order',$role_has_permission))
                <li class="intercity_service_menu"><a
                            href="{!! url('intercity-service-rides') !!}">{{trans('lang.intercity_order_plural')}}</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if(in_array('freight',$role_has_permission))
        <li>
            <a class="has-arrow waves-effect waves-dark freight_menu" href="#" aria-expanded="false">
                <i class="mdi mdi-truck"></i>
                <span class="hide-menu">{{trans('lang.freight')}}</span>
            </a>
            <ul aria-expanded="false" class="collapse freight_sub_menu">
                <li class="freight_vehicle_menu"><a
                            href="{!! url('freight-vehicles') !!}">{{trans('lang.freight_vehicles')}}</a></li>
            </ul>
        </li>
        @endif

        @if(in_array('airports',$role_has_permission))
        <li>
            <a class="waves-effect waves-dark airport_menu" href="{!! url('airports') !!}" aria-expanded="false">
                <i class="mdi mdi-airplane"></i>
                <span class="hide-menu">{{trans('lang.airports')}}</span>
            </a>

        </li>
        @endif
        @if(in_array('vehicle-type',$role_has_permission))

        <li>
            <a class="waves-effect waves-dark vehicle_type_menu" href="{!! url('vehicle-type') !!}"
               aria-expanded="false">

                <i class="mdi mdi-car"></i>

                <span class="hide-menu">{{trans('lang.vehicle_type')}}</span>

            </a>
        </li>
        @endif
        @if(in_array('driver-rules',$role_has_permission) || in_array('deleted-driver-rules',$role_has_permission))

        <li>
            <a class="has-arrow waves-effect waves-dark driver_rules_menu" href="#" aria-expanded="false">
                <i class="mdi mdi-playlist-check"></i>
                <span class="hide-menu">{{trans('lang.driver_rule_plural')}}</span>
            </a>
            <ul aria-expanded="false" class="collapse driver_rules_sub_menu">
                @if(in_array('driver-rules',$role_has_permission))
                <li class="all_driver_rules_menu"><a
                            href="{!! url('driver-rules') !!}">{{trans('lang.all_driver_rule_plural')}}</a></li>
                @endif
                @if(in_array('deleted-driver-rules',$role_has_permission))
                <li class="deleted_driver_rules_menu"><a
                            href="{!! url('driver-rules/deleted') !!}">{{trans('lang.deleted_driver_rule_plural')}}</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(in_array('cms',$role_has_permission) || in_array('banners',$role_has_permission)
        || in_array('deleted-banner',$role_has_permission) || in_array('on-board',$role_has_permission)
        || in_array('faq',$role_has_permission)
        || in_array('sos',$role_has_permission))

        <li class="nav-subtitle"><span class="nav-subtitle-span">{{trans('lang.app_management')}}</span></li>
        @endif

        @if(in_array('cms',$role_has_permission))

        <li><a class="waves-effect waves-dark cms_page" href="{!! url('cms') !!}" aria-expanded="false">
                <i class="mdi mdi-book-open-page-variant"></i>
                <span class="hide-menu">{{trans('lang.cms_plural')}}</span>
            </a>
        </li>
        @endif
        @if(in_array('banners',$role_has_permission) || in_array('deleted-banner',$role_has_permission))
        <li>
            <a class="has-arrow waves-effect waves-dark banner_menu" href="#" aria-expanded="false">
                <i class="mdi mdi-monitor-multiple"></i>
                <span class="hide-menu">{{trans('lang.banner_plural')}}</span>
            </a>
            <ul aria-expanded="false" class="collapse banner_sub_menu">
                @if(in_array('banners',$role_has_permission))
                <li class="all_banner_menu"><a href="{!! url('banners') !!}">{{trans('lang.all_banner_plural')}}</a>
                </li>
                @endif
                @if(in_array('deleted-banner',$role_has_permission))
                <li class="deleted_banner_menu"><a
                            href="{!! url('banners/deleted') !!}">{{trans('lang.deleted_banner_plural')}}</a></li>
                @endif
            </ul>
        </li>
        @endif
        @if(in_array('on-board',$role_has_permission))
        <li><a class="waves-effect waves-dark onboard_menu" href="{!! url('on-board') !!}" aria-expanded="false">
                <i class="mdi mdi-book-open-page-variant"></i>
                <span class="hide-menu">{{trans('lang.on_board_plural')}}</span>
            </a>
        </li>
        @endif
        @if(in_array('faq',$role_has_permission))

        <li><a class="waves-effect waves-dark faq_menu" href="{!! url('faq') !!}" aria-expanded="false">
                <i class="mdi mdi-comment-question-outline"></i>
                <span class="hide-menu">{{trans('lang.faq_plural')}}</span>
            </a>
        </li>
        @endif
        @if(in_array('sos',$role_has_permission))
        <li><a class="waves-effect waves-dark sos_menu" href="{!! url('sos') !!}" aria-expanded="false">
                <i class="mdi mdi-heart-pulse"></i>
                <span class="hide-menu">{{trans('lang.sos')}}</span>
            </a>
        </li>
        @endif

        @if(in_array('tax',$role_has_permission) || in_array('coupon',$role_has_permission)
        || in_array('deleted-coupon',$role_has_permission) || in_array('currency',$role_has_permission)
        || in_array('language',$role_has_permission) || in_array('deleted-language',$role_has_permission)
        || in_array('payout-request',$role_has_permission) ||
        in_array('drivers-wallet-transaction',$role_has_permission)
        || in_array('users-wallet-transaction',$role_has_permission) || in_array('global-setting',$role_has_permission)
        || in_array('admin-commission',$role_has_permission) || in_array('payment-method',$role_has_permission)
        || in_array('homepageTemplate',$role_has_permission) || in_array('header-template',$role_has_permission)
        || in_array('footer-template',$role_has_permission) || in_array('privacy',$role_has_permission)
        || in_array('terms',$role_has_permission))

        <li class="nav-subtitle"><span class="nav-subtitle-span">{{trans('lang.setting_management')}}</span></li>

        @endif

        @if(in_array('tax',$role_has_permission))

        <li>
            <a class="waves-effect waves-dark tax_menu" href="{!! url('tax') !!}" aria-expanded="false">

                <i class="mdi mdi-cash"></i>

                <span class="hide-menu">{{trans('lang.tax_plural')}}</span>

            </a>
        </li>

        @endif
        @if(in_array('coupon',$role_has_permission) || in_array('deleted-coupon',$role_has_permission))
        <li>
            <a class="has-arrow waves-effect waves-dark coupon_menu" href="#" aria-expanded="false">

                <i class="mdi mdi-ticket-percent"></i>

                <span class="hide-menu">{{trans('lang.coupon_plural')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse coupon_sub_menu">
                @if(in_array('coupon',$role_has_permission))
                <li class="all_coupon_menu"><a href="{!! url('coupons') !!}">{{trans('lang.all_coupon_plural')}}</a>
                </li>
                @endif
                @if(in_array('deleted-coupon',$role_has_permission))
                <li class="deleted_coupon_menu"><a
                            href="{!! url('coupons/deleted') !!}">{{trans('lang.deleted_coupon_plural')}}</a></li>
                @endif
            </ul>

        </li>
        @endif
        @if(in_array('currency',$role_has_permission))

        <li>
            <a class="waves-effect waves-dark currency" href="{!! url('currency') !!}" aria-expanded="false">

                <i class="mdi mdi-currency-usd"></i>

                <span class="hide-menu">{{trans('lang.currencies')}}</span>

            </a>
        </li>
        @endif
        @if(in_array('language',$role_has_permission) || in_array('deleted-language',$role_has_permission))

        <li>
            <a class="has-arrow waves-effect waves-dark language_menu" href="#" aria-expanded="false">
                <i class="mdi mdi-earth"></i>
                <span class="hide-menu">{{trans('lang.languages')}}</span>
            </a>
            <ul aria-expanded="false" class="collapse language_sub_menu">
                @if(in_array('language',$role_has_permission))

                <li class="all_language_menu"><a
                            href="{!! url('settings/languages') !!}">{{trans('lang.all_languages')}}</a></li>
                @endif
                @if(in_array('deleted-language',$role_has_permission))
                <li class="deleted_language_menu"><a
                            href="{!! url('settings/languages/deleted') !!}">{{trans('lang.deleted_languages')}}</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(in_array('payout-request',$role_has_permission) ||
        in_array('drivers-wallet-transaction',$role_has_permission) ||
        in_array('users-wallet-transaction',$role_has_permission))

        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-bank"></i>
                <span class="hide-menu">{{trans('lang.payment_plural')}}</span>
            </a>
            @if(in_array('payout-request',$role_has_permission))
            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('payoutRequest') !!}">{{trans('lang.payout_request')}}</a></li>
            </ul>
            @endif
            @if(in_array('drivers-wallet-transaction',$role_has_permission))
            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('walletTransaction/driver') !!}">{{trans('lang.drivers_wallet_transactions')}}</a>
                </li>
            </ul>
            @endif
            @if(in_array('users-wallet-transaction',$role_has_permission))
            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('walletTransaction/user') !!}">{{trans('lang.users_wallet_transactions')}}</a></li>
            </ul>
            @endif
        </li>
        @endif
        @if(in_array('global-setting',$role_has_permission) || in_array('admin-commission',$role_has_permission) ||
        in_array('payment-method',$role_has_permission)
        || in_array('homepageTemplate',$role_has_permission) || in_array('header-template',$role_has_permission) ||
        in_array('footer-template',$role_has_permission)
        || in_array('privacy',$role_has_permission) || in_array('terms',$role_has_permission))

        <li>
            <a class="has-arrow waves-effect waves-dark setting_menu" href="#" aria-expanded="false">

                <i class="mdi mdi-settings"></i>

                <span class="hide-menu">{{trans('lang.app_setting')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse setting_sub_menu">
                @if(in_array('global-setting',$role_has_permission))
                <li><a href="{!! url('settings/globals') !!}">{{trans('lang.app_setting_globals')}}</a></li>
                @endif
                @if(in_array('admin-commission',$role_has_permission))
                <li><a href="{!! url('settings/adminCommission') !!}">{{trans('lang.admin_commission')}}</a></li>
                @endif
                @if(in_array('payment-method',$role_has_permission))

                <li><a href="{!! url('settings/payments/stripe') !!}"
                       class="setting_payment_menu">{{trans('lang.payment_methods')}}</a></li>
                @endif
                @if(in_array('homepageTemplate',$role_has_permission))

                <li><a href="{!! url('settings/landingPageTemplate') !!}">{{trans('lang.homepageTemplate')}}</a></li>
                @endif
                @if(in_array('header-template',$role_has_permission))

                <li><a href="{!! url('settings/headerTemplate') !!}">{{trans('lang.header_template')}}</a></li>
                @endif
                @if(in_array('footer-template',$role_has_permission))

                <li><a href="{!! url('settings/footerTemplate') !!}">{{trans('lang.footer_template')}}</a></li>
                @endif
                @if(in_array('privacy',$role_has_permission))

                <li><a href="{!! url('settings/privacyPolicy') !!}">{{trans('lang.privacy_policy')}}</a></li>
                @endif
                @if(in_array('terms',$role_has_permission))

                <li><a href="{!! url('settings/termsAndConditions') !!}">{{trans('lang.terms_and_conditions')}}</a></li>
                @endif
            </ul>

        </li>
        @endif


    </ul>

    <p class="web_version"></p>

</nav>
