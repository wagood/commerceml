<?php
namespace CommerceMLParser\Exception;

use Exception;

class NoEventException extends Exception {
    /**
     * @param string $className
     * @param Exception|null $previous
     */
    public function __construct(string $className, Exception $previous = null)
    {
        $message = 'No event "' . $className . '" in parser exists';
        parent::__construct($message, null, $previous);
    }
}