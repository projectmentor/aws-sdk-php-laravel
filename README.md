# AWS S3 Service Provider 
***for Laravel 5.2 and AWS SDK 2.x and IBM Cloud Object Storage***

<!-- [![@awsforphp on Twitter](http://img.shields.io/badge/twitter-%40awsforphp-blue.svg?style=flat)](https://twitter.com/awsforphp) -->
<!-- [![Build Status](https://img.shields.io/travis/aws/aws-sdk-php-laravel.svg)](https://travis-ci.org/aws/aws-sdk-php-laravel) -->
<!-- [![Latest Stable Version](https://img.shields.io/packagist/v/aws/aws-sdk-php-laravel.svg)](https://packagist.org/packages/aws/aws-sdk-php-laravel) -->
<!-- [![Total Downloads](https://img.shields.io/packagist/dt/aws/aws-sdk-php-laravel.svg)](https://packagist.org/packages/aws/aws-sdk-php-laravel) -->
<!-- [![Gitter](https://badges.gitter.im/Join Chat.svg)](https://gitter.im/aws/aws-sdk-php?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge) -->

This is a simple [Laravel](http://laravel.com/) service provider for making it easy to include the official
[AWS SDK for PHP v2](https://github.com/aws/aws-sdk-php) in your Laravel and Lumen applications.
So that you can use IBM's Cloud Object Storage 'S3' compatible api.

This README is for `projectmentor\aws-sdk-php-laravel`.<br />
Forked from `aws/aws-sdk-php-laravel` v3.x.<br />
Using branch `ibm-cos-s3`.<br />
Designated as version `dev-ibm-cos-s3`<br />

***IMPORTANT***

The service provider **HAS BEEN DOWNGRADED** in this fork.

IBM COS provides php access via it's own copy of 'S3 API' which seems to be based off of aws\aws-sdk-php v.2.5.
However, I've been unable to find the source code online.

Hence IBM's 'S3' api appears to contain a subset of the commands in amazon's 2.x version.

**This version** 

* **dev-ibm-cos-s3** ([ibm-cos-s3 branch](https://github.com/projectmentor/aws-sdk-php-laravel/tree/ibm-cos-s3)) - For `laravel/framework:~5.2` and `aws/aws-sdk-php:~2.5`

**Major Upstream Versions:**

* **3.x** ([master branch](https://github.com/aws/aws-sdk-php-laravel)) - For `laravel/framework:~5.1` and `aws/aws-sdk-php:~3.0`
* **2.x** ([2.0 branch](https://github.com/aws/aws-sdk-php-laravel/tree/2.0)) - For `laravel/framework:5.0.*` and `aws/aws-sdk-php:~2.4`
* **1.x** ([1.0 branch](https://github.com/aws/aws-sdk-php-laravel/tree/1.0)) - For `laravel/framework:4.*` and `aws/aws-sdk-php:~2.4`

## Installation

This packages **dev-ibm-cos-s3** version can be installed in your host application via [Composer](http://getcomposer.org) by:

* Creating a [VCS repository](https://getcomposer.org/doc/05-repositories.md#loading-a-package-from-a-vcs-repository) for this FORK.
* Requiring the forked version `dev-ibm-cos-s3` of the `aws/aws-sdk-php-laravel` package in your project's `composer.json`.

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/projectmentor/aws-sdk-php-laravel"
        }
    ],
    "require": {
        "aws/aws-sdk-php-laravel": "dev-ibm-cos-s3"
    }
}
```

Then run a composer update
```sh
php composer update
```

To use the AWS Service Provider, you must register the provider when bootstrapping your application.


### Lumen
In Lumen find the `Register Service Providers` in your `bootstrap/app.php` and register the AWS Service Provider.

```php
    $app->register(Aws\Laravel\AwsServiceProvider::class);
```

### Laravel
In Laravel find the `providers` key in your `config/app.php` and register the AWS Service Provider.

```php
    'providers' => array(
        // ...
        Aws\Laravel\AwsServiceProvider::class,
    )
```

Find the `aliases` key in your `config/app.php` and add the AWS facade alias.

```php
    'aliases' => array(
        // ...
        'AWS' => Aws\Laravel\AwsFacade::class,
    )
```

## Configuration
By default, the package uses the following environment variables to auto-configure the plugin:  
Hence, you may set them in your .env file in the host project directory. 


```
AWS_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY
AWS_REGION              //default = us-south
AWS_ENDPOINT            //default = https://s3.us-south.objectstorage.softlayer.net
AWS_CONFIG_FILE         //default = null
```
Note: You can\'t use the same envronment variables to access both Amazon AWS and IBM COS _simultaneously_.  
See [the AWS SDK V2 Guide](http://docs.aws.amazon.com/aws-sdk-php/v2/guide/credentials.html#credential-profiles) for alternate methods of providing credentials to the client.

To customize the configuration file, publish the package configuration using Artisan.

```sh
php artisan vendor:publish --provider="Aws\Laravel\AwsServiceProvider"
```

Update your settings in the generated `config/aws.php` configuration file.

```php
return [
     'key'          => 'YOUR_AWS_ACCESS_KEY_ID',
     'secret'       => 'YOUR_AWS_SECRET_KEY',
     'region'       => 'us-south',
     'endpoint'     => 'https://s3.us-south.objectstorage.softlayer.net',
     'config_file'  => null
 ]; 
``` 

Referring to the Laravel 5.2.0 [Upgrade guide](https://laravel.com/docs/5.2/upgrade#upgrade-5.2.0); you must use a 
config file instead of environment variable option if using php artisan `config:cache`.

Learn more about [configuring the v2 AWS SDK](http://docs.aws.amazon.com/aws-sdk-php/v2/guide/configuration.html) on
the SDK's v2 User Guide.

## TODO: Usage

In order to use the AWS SDK for PHP within your app, you need to retrieve it from the [Laravel IoC
Container](http://laravel.com/docs/ioc). The following example uses the Amazon S3 client to upload a file.

<!--```php -->
//TODO:
<!-- $s3 = App::make('aws')->createClient('s3'); -->
<!-- $s3->putObject(array( -->
<!--     'Bucket'     => 'YOUR_BUCKET', -->
<!--     'Key'        => 'YOUR_OBJECT_KEY', -->
<!--     'SourceFile' => '/the/path/to/the/file/you/are/uploading.ext', -->
<!-- )); -->
<!--``` -->

If the AWS facade is registered within the `aliases` section of the application configuration, you can also use the
following technique.

<!--```php -->
//TODO:
<!-- $s3 = AWS::createClient('s3'); -->
<!-- $s3->putObject(array( -->
<!--     'Bucket'     => 'YOUR_BUCKET', -->
<!--     'Key'        => 'YOUR_OBJECT_KEY', -->
<!--     'SourceFile' => '/the/path/to/the/file/you/are/uploading.ext', -->
<!-- )); -->
<!--``` -->

## Links

<!-- * [IBM COS S3 API]() -->
* [IBM COS S3 Developer Intro](https://developer.ibm.com/recipes/tutorials/cloud-object-storage-s3-api-intro)
* [IBM COS S3 API Reference](https://ibm-public-cos.github.io/crs-docs/api-reference)
* [IBM COS S3 Compatibility](https://ibm-public-cos.github.io/crs-docs/about-compatibility-api)
* [IBM COS API Guides](https://ibm-public-cos.github.io/crs-docs/using-the-api)
* [AWS 2.x to 3.x migration guide](http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/migration.html)
* [AWS SDK for PHP on Github](http://github.com/aws/aws-sdk-php/tree/2.8)
* [AWS SDK for PHP website](http://aws.amazon.com/sdkforphp/)
* [AWS on Packagist](https://packagist.org/packages/aws/)
* [License](http://aws.amazon.com/apache2.0/)
* [Laravel website](http://laravel.com/)
