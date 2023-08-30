<?php
namespace CommerceMLParser\Exception;

use Exception;

/**
 * Class NoObjectException
 * @package CommerceMLParser\Exception
 */
class NoObjectException extends Exception {
    /**
     * @param string $className
     * @param Exception|null $previous
     */
    public function __construct(string $className, Exception $previous = null)
    {
        $message = 'No object "' . $className . '" in factory exists';
        parent::__construct($message, null, $previous);
    }
}