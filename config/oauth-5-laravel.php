<?php

return [

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => 'OAuth\Common\Storage\Session',

    /**
     * Consumers
     */
    'consumers' => [

        'Google' => [
            'client_id' => env('GOOGLE_CLIENT_ID', '615191595556-3vcm1cquokkv0d0p5rnsu25t44f8f2c8.apps.googleusercontent.com'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET', 'qRexTLVpTH_Jyr_uwfiSEQYn'),
            'scope' => ['userinfo_email', 'userinfo_profile'],
        ],
        'Twitter' => [
            'client_id' => env('TWITTER_CLIENT_ID', 'Eii3BrN71CDfb1nDtZRG68zHS'),
            'client_secret' => env('TWITTER_CLIENT_SECRET', 'qjIRj0lD0CsIGqmqjgRfhiIGaNP9pbhZJHtW36O1PcS4lgj3jl'),
        ],
        'Linkedin' => [
            'client_id' => env('LINKEDIN_CLIENT_ID', '77wj5ee4x17gad'),
            'client_secret' => env('LINKEDIN_CLIENT_SECRET', 'rkNrPgE9GaQgBbDB'),
            'scope' => ['r_basicprofile', 'w_share', 'r_emailaddress', 'rw_company_admin']
        ],
        'Instagram' => [
            'client_id' => env('INSTAGRAM_CLIENT_ID', '77wj5ee4x17gad'),
            'client_secret' => env('INSTAGRAM_CLIENT_SECRET', 'rkNrPgE9GaQgBbDB'),
            'scope' => ['basic', 'comments', 'relationships', 'likes']
        ],
        'Pinterest' => [
            'client_id' => env('PINTEREST_CLIENT_ID', "4796441904438846617"),
            'client_secret' => env('PINTEREST_CLIENT_SECRET', "e7fa0e548b42bc40ca4a4c2d5bc5b7e62320eb55f16212e1c2e0c5894b50c50a")
        ],
        'Bitly' => [
            'client_id' => env('BITLY_CLIENT_ID', "bfbdbbe9f84c1f0910e1231c740c1bdc8cf6dc60"),
            'client_secret' => env("BITLY_CLIENT_SECRET", "cf60c04fa900cfd5eb2578ff89ec5259df231935")
        ]

    ]

];