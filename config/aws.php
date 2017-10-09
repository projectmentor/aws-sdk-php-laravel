<?php

/*
|-----------------------------------------------------------------------------
| This is a aws-sdk-php v2 version of the config/aws.php file which will
| get installed in the host application via `artisan vendor:publish`
|
| N.B. The enviroment variable names and some of the comments are not
| appropriate/applicable for IBM Cloud Object Storage. However since
| we are using the aws-sdk we will leave the naming convention
| intact. This may be problematic for those applications
| wishing to access both IBM COS and AMAZON S3 simultaneously.
|
*/

//REMOVE DOWNGRADED
//use Aws\Laravel\AwsServiceProvider;
//END REMOVE DOWNGRADED

return [


    /*
    |--------------------------------------------------------------------------
    | Your AWS Credentials
    |--------------------------------------------------------------------------
    |
    | In order to communicate with an AWS service, you must provide your AWS
    | credentials including your AWS Access Key ID and AWS Secret Access Key.
    |
    | To use credentials from your credentials file or environment or to use
    | IAM Instance Profile credentials, please remove these config settings from
    | your config or make sure they are null. For more information, see:
    | http://docs.aws.amazon.com/aws-sdk-php-2/guide/latest/configuration.html
    |
    */
    'key'    => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),

    /*
    |--------------------------------------------------------------------------
    | AWS Region
    |--------------------------------------------------------------------------
    |
    | Many AWS services are available in multiple regions. You should specify
    | the AWS region you would like to use, but please remember that not every
    | service is available in every region. To see what regions are available,
    | see: http://docs.aws.amazon.com/general/latest/gr/rande.html
    |
    */
    'region' => env('AWS_REGION', 'us-south'),

    /*
    |--------------------------------------------------------------------------
    | AWS Config File Location
    |--------------------------------------------------------------------------
    |
    | Instead of specifying your credentials and region here, you can specify
    | the location of an AWS SDK for PHP config file to use. These files provide
    | more granular control over what credentials and regions you are using for
    | each service. If you specify a filepath for this configuration setting,
    | the others in this file will be ignored. See the SDK user guide for more
    | information: https://goo.gl/NRFZue
    |
    */
    'config_file' => env('AWS_CONFIG_FILE'),

//REMOVE DOWNGRADED
//
//    /*
//    |--------------------------------------------------------------------------
//    | AWS SDK Configuration
//    |--------------------------------------------------------------------------
//    |
//    | The configuration options set in this file will be passed directly to the
//    | `Aws\Sdk` object, from which all client objects are created. The minimum
//    | required options are declared here, but the full set of possible options
//    | are documented at:
//    | http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/configuration.html
//    |
//    */
//
//    'region' => env('AWS_REGION', 'us-east-1'),
//    'version' => 'latest',
//    'ua_append' => [
//        'L5MOD/' . AwsServiceProvider::VERSION,
//    ],
//END REMOVE DOWNGRADED
];
