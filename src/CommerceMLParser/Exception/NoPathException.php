<?php
namespace CommerceMLParser\Exception;

class NoPathException extends \Exception {
    /**
     * @param string $path
     * @param \Exception|null $previous
     */
    public function __construct(string $path, \Exception $previous = null)
    {
        $message = 'No register path "' . $path . '" in factory';
        parent::__construct($message, null, $previous);
    }
}