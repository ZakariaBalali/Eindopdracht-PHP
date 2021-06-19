<?php

namespace _PhpScoper5e394cb3b4e38\GuzzleHttp\Exception;

use Throwable;
if (\interface_exists(\Throwable::class)) {
    interface GuzzleException extends \Throwable
    {
    }
} else {
    /**
     * @method string getMessage()
     * @method \Throwable|null getPrevious()
     * @method mixed getCode()
     * @method string getFile()
     * @method int getLine()
     * @method array getTrace()
     * @method string getTraceAsString()
     */
    interface GuzzleException
    {
    }
}
