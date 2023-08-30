<?php
namespace CommerceMLParser\Model\Types;

use CommerceMLParser\Model\Interfaces\IdModel;
use CommerceMLParser\Model\Traits\PartnerProperty;
use CommerceMLParser\ORM\Collection;
use CommerceMLParser\ORM\Model;

/**
 * Class Partner
 * @package CommerceMLParser\Model
 *
 * @todo Дописать парсер Агентов
 */
class Partner extends Model implements IdModel
{
    use PartnerProperty;

    /** @var  string */
    protected string $id;
    /** @var  string */
    protected string $name;
    /** @var  string */
    protected string $comment;
    /** @var  Address */
    protected Address $address;
    /** @var Collection|Contact[]  */
    protected array|Collection $contacts;
    /** @var array  */
    protected array $agents = [];


    public function __construct(\SimpleXMLElement $xml)
    {
        parent::__construct($xml);
        $this->id = (string)$xml->Ид;
        $this->name = (string)$xml->Наименование;
        $this->comment = (string)$xml->Комментарий;
        if ($xml->Адрес) {
            $this->address = new Address($xml->Адрес);
        }
        $this->contacts = new Collection();
        if ($xml->Контакты) {
            foreach ($xml->Контакты->Контакт as $value) {
                $this->contacts->add(new Contact($value));
            }
        }

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
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): array|Collection
    {
        return $this->contacts;
    }

}
