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
        'CodeLength' => 5,
        'ImageWidth' => 250,
        'ImageHeight' => 50,
        'SoundStyle' => SoundStyle::Radio,
        'CodeStyle' => CodeStyle::Alpha,
        'ImageStyle' => [
            ImageStyle::Radar,
            ImageStyle::Collage,
            ImageStyle::Fingerprints,
        ],


    ],



    // Add more your Captcha configuration here...
];
