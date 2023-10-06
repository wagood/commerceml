<?php
namespace CommerceMLParser\Model;

use CommerceMLParser\Model\Interfaces\IdModel;

class Property implements IdModel
{
    /** @var string */
    protected string $id;
    /** @var string */
    protected string $name;
    /** @var array */
    protected array $values = array();
    /** @var string */
    protected string $description;
    /** @var bool */
    protected bool $isRequired;
    /** @var bool */
    protected bool $isList;
    /** @var string */
    protected string $type;
    /** @var bool ; */
    protected bool $isUsed;
    /** @var bool ; */
    protected bool $delmark;


    /**
     * Property constructor.
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (null === $xml) {
            return;
        }

        $this->id = (string)$xml->Ид;
        $this->name = (string)$xml->Наименование;
        $valueType = (string)$xml->ТипЗначений;
        if ($valueType === 'Справочник' && $xml->ВариантыЗначений) {
            foreach ($xml->ВариантыЗначений->Справочник as $value) {
                $id = (string)$value->ИдЗначения;
                $this->values[$id] = (string)$value->Значение;
            }
        }
        $this->description = (string)$xml->Описание;
        $this->isRequired = (string)$xml->Обязательное === 'true';
        $this->isList = (string)$xml->Множественное === 'true';
        $this->type = (string)$xml->ТипЗначений;
        $this->isUsed = (string)$xml->ИспользованиеСвойства === 'true';
        $this->delmark = (string) $xml->ПометкаУдаления === 'true';
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return boolean
     */
    public function isIsRequired(): bool
    {
        return $this->isRequired;
    }

    /**
     * @return boolean
     */
    public function isIsList(): bool
    {
        return $this->isList;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return boolean
     */
    public function isIsUsed(): bool
    {
        return $this->isUsed;
    }

    /**
     * @return bool
     */
    public function getDelmark(): bool
    {
        return $this->delmark;
    }
}
