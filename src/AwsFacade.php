<?php

namespace Aws\Laravel;

//REMOVE DOWNGRADED
//use Aws\AwsClientInterface;
//END REMOVE

use Aws\Common\Client\AwsClientInterface;
use Illuminate\Support\Facades\Facade;

/**
 * Facade for the AWS service
 *
 * //REMOVE DOWNGRADED
 * //method static AwsClientInterface createClient($name, array $args = []) Get a client from the service builder.
 * //END REMOVE
 *
 * @method static AwsClientInterface get($name, $throwAway = false) Get a client from the service builder
 */
class AwsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'aws';
    }
}
