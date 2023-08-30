<?php
namespace CommerceMLParser;

use Symfony\Contracts\EventDispatcher\Event as BaseClass;

/**
 * Class Event
 * @package CommerceMLParser
 */
class Event extends BaseClass {
    /** @var Parser  */
    protected mixed $parser;

    public function __construct()
    {
        $args = func_get_args();
        $this->parser = end($args);
    }

    /**
     * @return Parser
     */
    public function getParser(): Parser
    {
        return $this->parser;
    }
}