<?php if (!class_exists('CaptchaConfiguration')) {
    return;
}

// BotDetect PHP Captcha configuration options
// more details here: https://captcha.com/doc/php/captcha-options.html
// ----------------------------------------------------------------------------

return [

    /*
    |--------------------------------------------------------------------------
    | Captcha configuration for example page
    |--------------------------------------------------------------------------
    */
    'ExampleCaptcha' => [
        'UserInputID' => 'CaptchaCode',
        'CodeLength' => CaptchaRandomization::GetRandomCodeLength(4, 6),
        'ImageWidth' => 250,
        'ImageHeight' => 50,
        'CodeStyle' => CodeStyle::Numeric,
        'ImageStyle' => [
            ImageStyle::Collage,
        ],

    ],



    // Add more your Captcha configuration here...
];
