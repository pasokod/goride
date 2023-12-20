<?php

namespace App\Http\Controllers;


class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function globals()
    {
        return view("settings.global");
    }

    public function adminCommission()
    {
        return view("settings.adminCommission");
    }

    public function cod()
    {
        return view('settings.payments.cod');
    }

    public function applePay()
    {
        return view('settings.payments.applepay');
    }

    public function stripe()
    {
        return view('settings.payments.stripe');
    }

    public function razorpay()
    {
        return view('settings.payments.razorpay');
    }

    public function paytm()
    {
        return view('settings.payments.paytm');
    }

    public function payfast()
    {
        return view('settings.payments.payfast');
    }

    public function paypal()
    {
        return view('settings.payments.paypal');
    }

    public function paystack()
    {
        return view('settings.payments.paystack');
    }

    public function flutterwave()
    {
        return view('settings.payments.flutterwave');
    }

    public function mercadopago()
    {
        return view('settings.payments.mercadopago');
    }

    public function wallet()
    {
        return view('settings.payments.wallet');
    }

    public function landingPageTemplate()
    {
        return view('settings.landingpage_template');
    }

    public function headerTemplate()
    {
        return view('settings.header_templates');
    }

    public function footerTemplate()
    {
        return view('settings.footer_templates');
    }

    public function privacyPolicy()
    {
        return view('settings.privacy_policy');
    }

    public function termsAndConditions()
    {
        return view('settings.terms_conditions');
    }

    public function languages()
    {
        return view('settings.languages.index');
    }

    public function saveLanguage($id=null)
    {
        return view('settings.languages.save')->with('id',$id);
    }

    public function deletedLang()
    {

        return view('settings.languages.deleted-languages');
    }



}
