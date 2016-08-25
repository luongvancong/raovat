<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => Nht\User::class,
        'key' => '',
        'secret' => '',
    ],

    'facebook' => [
        'client_id'     => '552091071613449',
        'client_secret' => '44857986143e35307217fb2480eb5620',
        'redirect'      => 'http://giaca.org/auth/facebook/callback',
    ],

    'google' => [
        'client_id'     => '357469820882-d1nsevltignnj36itn8ajm826sl6b08v.apps.googleusercontent.com',
        'client_secret' => 'TWTcwDyTteE_SgIJxXctPtAA',
        'redirect'      => 'http://giaca.org/auth/google/callback'
    ],

    'ga' => [
        'client_id'     => '357469820882-5k2qmvf8ua0l9nb1ku73dapkk8ud995q.apps.googleusercontent.com',
        'client_secret' => 'k2OmiSjXxxmUYKYpHw5SjQtX',
        'redirect'      => 'http://giaca.org/ga/callback'
    ]

];
