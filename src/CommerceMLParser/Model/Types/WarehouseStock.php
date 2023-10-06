<?php
/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 23.12.15
 * Time: 12:37
 */

namespace CommerceMLParser\Model\Types;

use CommerceMLParser\Model\Interfaces\IdModel;

/**
 * Class WarehouseStock
 * @package CommerceMLParser\Model\Types
 *
 * xsd:complexType name="ОстаткиПоСкладам"
 */
class WarehouseStock implements IdModel
{
    /** @var string ИдСклада */
    protected string $id;
    /** @var float КоличествоНаСкладе */
    protected string|float $quantity;

    /**
     * @inheritDoc
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->id = (string)$xml->attributes()->ИдСклада;
        $this->quantity = (string)$xml->attributes()->КоличествоНаСкладе;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
