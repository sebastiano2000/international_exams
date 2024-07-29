<?php

namespace App\Hesabe\Misc;

/**
 * This class is used for defining constant.
 *
 * @author Hesabe
 */
class Constants
{
    public const VERSION = "2.0";

    //Payment API URL
    public const PAYMENT_API_URL = "https://sandbox.hesabe.com";
    // public const PAYMENT_API_URL = "https://api.hesabe.com";

    // Get below values from Merchant Panel, Profile section
    // public const ACCESS_CODE = "e6f3e654-3cf5-4b55-824e-8e64adc2b451";
    // public const MERCHANT_SECRET_KEY = "gq6JWP7kZYmN85A4wvb8V32yb14B9XnM";
    // public const MERCHANT_IV = "ZYmN85A4wvb8V32y";
    // public const MERCHANT_CODE = "88750523";

    //sandbox
    public const ACCESS_CODE = "c333729b-d060-4b74-a49d-7686a8353481";
    public const MERCHANT_SECRET_KEY = "PkW64zMe5NVdrlPVNnjo2Jy9nOb7v1Xg";
    public const MERCHANT_IV = "5NVdrlPVNnjo2Jy9";
    public const MERCHANT_CODE = "842217";

    // This URL are defined by you to get the response from Payment Gateway after success and failure
    public const RESPONSE_URL = 'https://test.khereej.org/payment/success';
    public const FAILURE_URL = 'https://test.khereej.org/payment/failure';

    //Codes
    public const SUCCESS_CODE = 200;
    public const AUTHENTICATION_FAILED_CODE = 501;
}
