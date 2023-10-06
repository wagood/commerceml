<?php

namespace CommerceMLParser\Model\Types;

class Contact
{
    /** @var string */
    protected string $type;
    /** @var string */
    protected string $value;
    /** @var string */
    protected ?string $comment;

    /**
     * @param \SimpleXMLElement $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (!is_null($xml)) {
            $this->type = (string) $xml->Тип;
            $this->value = (string) $xml->Значение;
            $this->comment = null;
            if($xml->Комментарий){
                $this->comment = (string) $xml->Комментарий;
            }
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

}
