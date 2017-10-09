<?php namespace Aws\Laravel\Test;

use Aws\Laravel\AwsFacade as AWS;
use Aws\Laravel\AwsServiceProvider;
use Illuminate\Container\Container;

abstract class AwsServiceProviderTest extends \PHPUnit_Framework_TestCase
{

    public function testFacadeCanBeResolvedToServiceInstance()
    {
        $app = $this->setupApplication();
        $this->setupServiceProvider($app);

        // Mount facades
        AWS::setFacadeApplication($app);

        // Get an instance of a client (S3) via the facade.
        //REMOVE DOWNGRADED
        //$s3 = AWS::createClient('S3');
        //END REMOVE DOWNGRADED

        $s3 = AWS::get('S3');
        $this->assertInstanceOf('Aws\S3\S3Client', $s3);
    }


    /*---------------------------------------------------------
     | N.B. DOWNGRADED This method is deprecated in v3
     | but added back here for v2 compatibility.
     |---------------------------------------------------------
    */
    public function testRegisterAwsServiceProviderWithConfigFile()
    {
        $app = $this->setupApplication();
        $this->setupServiceProvider($app);

        // Simulate global config; specify config file
        $app['config']->set('aws', [
            'config_file' => __DIR__ . '/test_services.json'
        ]);

        // Get an instance of a client (S3)
        /** @var $s3 \Aws\S3\S3Client */
        $s3 = $app['aws']->get('s3');
        $this->assertInstanceOf('Aws\S3\S3Client', $s3);

        // Verify that the client received the credentials from the global config
        $this->assertEquals('change_me', $s3->getCredentials()->getAccessKeyId());
        $this->assertEquals('change_me', $s3->getCredentials()->getSecretKey());
    }

    public function testRegisterAwsServiceProviderWithPackageConfigAndEnv()
    {
        $app = $this->setupApplication();
        $this->setupServiceProvider($app);

        // Get an instance of a client (S3).
        /** @var $s3 \Aws\S3\S3Client */
        
        //REMOVE DOWNGRADED
        //$s3 = $app['aws']->createClient('S3');
        //END REMOVE DOWNGRADED

        $s3 = $app['aws']->get('S3');
        $this->assertInstanceOf('Aws\S3\S3Client', $s3);

        // Verify that the client received the credentials from the package config.
        //REMOVE DOWNGRADED
        /** //var \Aws\Credentials\CredentialsInterface $credentials */
        //END REMOVE DOWNGRADED


        /** @var \Aws\Common\Credentials\CredentialsInterface $credentials */
        $credentials = $s3->getCredentials()->wait();   //is wait() chainable in v2?

        //N.B. These Credentials are loaded from environment vars in phpunit.xml
        $this->assertEquals('foo', $credentials->getAccessKeyId());
        $this->assertEquals('bar', $credentials->getSecretKey());
        $this->assertEquals('baz', $s3->getRegion());
    }

    public function testServiceNameIsProvided()
    {
        $app = $this->setupApplication();
        $provider = $this->setupServiceProvider($app);
        $this->assertContains('aws', $provider->provides());
    }

    //REMOVE DOWNGRADED
    //public function testVersionInformationIsProvidedToSdkUserAgent()
    //{
    //    $app = $this->setupApplication();
    //    $this->setupServiceProvider($app);
    //    $config = $app['config']->get('aws');

    //    $this->assertArrayHasKey('ua_append', $config);
    //    $this->assertInternalType('array', $config['ua_append']);
    //    $this->assertNotEmpty($config['ua_append']);
    //    $this->assertNotEmpty(array_filter($config['ua_append'], function ($ua) {
    //        return false !== strpos($ua, AwsServiceProvider::VERSION);
    //    }));
    //}
    //END REMOVE

    /**
     * @return Container
     */
    abstract protected function setupApplication();

    /**
     * @param Container $app
     *
     * @return AwsServiceProvider
     */
    private function setupServiceProvider(Container $app)
    {
        // Create and register the provider.
        $provider = new AwsServiceProvider($app);
        $app->register($provider);
        $provider->boot();

        return $provider;
    }
}
