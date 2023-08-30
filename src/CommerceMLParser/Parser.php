<?php

namespace CommerceMLParser;

use CommerceMLParser\Creational\Singleton;
use CommerceMLParser\Event\StartEvent;
use CommerceMLParser\Exception\NoEventException;
use CommerceMLParser\Exception\NoObjectException;
use CommerceMLParser\Exception\NoPathException;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class Parser
 *
 * @package CommerceMLParser
 *
 * @method static Parser getInstance(Factory $factory = null)
 */
class Parser extends EventDispatcher
{
    use Singleton;

    /** @var \XMLReader */
    protected \XMLReader $xmlReader;
    /** @var Factory */
    protected Factory $factory;
    /** @var array|callable[] */
    protected array $callable = [];
    /** @var  \SplFileObject */
    protected \SplFileObject $currentFile;

    /** @var int */
    private int $bulk_count = 0;
    /** @var array */
    private array $path = [];
    /** @var array */
    private array $bulk_rows = [];
    /** @var array */
    private array $bulk_rows_counter = [];

    /**
     * @param Factory|null $factory
     */
    protected function _init(Factory $factory = null): void
    {
        $this->factory = (null === $factory) ? new Factory() : $factory;

        $this->xmlReader = new \XMLReader();
        // Default parse rules
        foreach (Factory::$objects as $path => $object) {
            $this->registerPath($path, $this->dispatchObjectCallable());

            $event = explode('\\', $object['event']);
            $event = end($event);

            $this->addListener($event, function(Event $e, $eventName, EventDispatcher $dispatcher) {
                $_e = StartEvent::getInstance($name = $eventName . 'Start');
                if (!$_e->isPropagationStopped()) {
                    $dispatcher->dispatch($_e, $name);
                    $_e->stopPropagation();
                }
            });
        }
    }

    /**
     * @return callable
     */
    protected function dispatchObjectCallable(): callable
    {
        return function($object, $self) {
            if (!class_exists($object[1]['event'])) {
                throw new NoEventException($object[1]);
            }
            $event = explode('\\', $object[1]['event']);
            $event = end($event);
            $this->dispatch(new $object[1]['event']($object[0], $self), $event);
        };
    }

    /**
     * @return array
     */
    public function getBulkRowsCounter($event): array
    {
        return $this->bulk_rows_counter[$event];
    }

    public function parse($file)
    {
        $this->currentFile = new \SplFileObject($file);
        $this->path = [];

        $this->xmlReader->open($file);
        $this->read();
        $this->xmlReader->close();
    }

    /**
     * @return \SplFileObject
     */
    public function getCurrentFile(): \SplFileObject
    {
        return $this->currentFile;
    }

    /**
     * @param string $path
     * @param callable|callback $callable
     * @return $this
     */
    public function registerPath($path, $callable): static
    {
        $this->callable[$path] = $callable;
        return $this;
    }

    /**
     * @throws NoObjectException
     * @throws NoPathException
     */
    protected function read(): void
    {
        $xml = $this->xmlReader;
        while ($xml->read()) {
            if ($xml->nodeType === \XMLReader::END_ELEMENT) {
                array_pop($this->path);
                continue;
            }


            if ($xml->nodeType === \XMLReader::ELEMENT) {
                $this->path[] = $xml->name;
                $path = implode('/', $this->path);

                if ($xml->isEmptyElement) {
                    array_pop($this->path);
                }

                if (isset($this->callable[$path])) {
                    $object = $this->factory->createObject($path, $this->loadElementXml());
                    call_user_func($this->callable[$path], $object, $this);
                }
            }
        }

        foreach ($this->bulk_rows as $event => $rows) {
            if (!empty($rows)) {
                $this->dispatch(new BulkEvent($event, $this), 'BulkUpload');
            }
        }
    }

    public function addRow($event, $obj)
    {
        $this->bulk_rows[$event][] = $obj;
        @$this->bulk_rows_counter[$event]++;
        if (count($this->bulk_rows[$event]) >= $this->bulk_count) {
            $this->dispatch(new BulkEvent($event, $this), 'BulkUpload');
            $this->bulk_rows[$event] = [];
        }
    }

    public function getRows($event = null)
    {
        return null !== $event ? $this->bulk_rows[$event] : $this->bulk_rows;
    }

    /**
     * @return \SimpleXMLElement
     */
    protected function loadElementXml(): \SimpleXMLElement
    {
        $xml = $this->xmlReader->readOuterXml();

        return simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?>' . $xml);
    }

    /**
     * @return int
     */
    public function getBulkCount(): int
    {
        return $this->bulk_count;
    }

    /**
     * @param int $bulk_count
     */
    public function setBulkCount(int $bulk_count): static
    {
        $this->bulk_count = $bulk_count;
        return $this;
    }

    /**
     * @return Factory
     */
    public function getFactory(): Factory
    {
        return $this->factory;
    }
}