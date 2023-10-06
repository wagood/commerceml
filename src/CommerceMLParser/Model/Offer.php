<?php
namespace CommerceMLParser\Model;

use CommerceMLParser\Model\Types\Price;
use CommerceMLParser\Model\Types\WarehouseStock;
use CommerceMLParser\ORM\Collection;

class Offer extends Product
{
    /** @var float Количество */
    protected float $quantity;
    /** @var Collection|Price[] Цены  */
    protected array|Collection $prices;
    /** @var Collection|WarehouseStock[] Склад */
    protected array|Collection $warehouses;

    public function __construct(\SimpleXMLElement $xml)
    {
        parent::__construct($xml);

        $this->prices = new Collection();
        $this->warehouses = new Collection();
        $this->quantity = (float)$xml->Количество;

        if($xml->Остатки && $xml->Остатки->Остаток && (float)$xml->Остатки->Остаток->Количество) {
            $this->quantity = (float)$xml->Остатки->Остаток->Количество;
        }

        if ($xml->Цены) {
            foreach ($xml->Цены->Цена as $price) {
                $this->prices->add(new Price($price));
            }
        }

        if ($xml->Склад) {
            foreach ($xml->Склад as $warehouse) {
                $this->warehouses->add(new WarehouseStock($warehouse));
            }
        }
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @return Collection|Types\Price[]
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @return Collection|WarehouseStock[]
     */
    public function getWarehouses()
    {
        return $this->warehouses;
    }
}
