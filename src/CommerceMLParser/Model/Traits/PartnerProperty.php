<?php
namespace CommerceMLParser\Model\Traits;

use CommerceMLParser\Model\Types\Address;

/**
 * Class PartnerProperty
 * @package CommerceMLParser\Model\Traits
 *
 * @todo Дописать парсер Руководителя и Счетов
 */
trait PartnerProperty
{
    /** @var  string */
    protected string $officialName;
    /** @var Address  */
    protected Address $partnerAddress;
    /** @var  string */
    protected string $inn;
    /** @var  string */
    protected string $kpp;
    /** @var string  */
    protected string $mainActivity;
    /** @var  string */
    protected string $egrpo;
    /** @var  string */
    protected string $okvd;
    /** @var  string */
    protected string $okdp;
    /** @var  string */
    protected string $okopf;
    /** @var  string */
    protected string $okfs;
    /** @var  string */
    protected string $okpo;
    /** @var  \DateTime */
    protected \DateTime $registerDate;

    /**
     * PartnerProperty constructor.
     *
     * @param \SimpleXMLElement $xml
     * @throws \Exception
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->officialName = (string)$xml->ОфициальноеНаименование;
        $this->partnerAddress = new Address($xml->ЮридическийАдрес);
        $this->inn = (string)$xml->ИНН;
        $this->kpp = (string)$xml->КПП;
        $this->mainActivity = (string)$xml->ОсновнойВидДеятельности;
        $this->egrpo = (string)$xml->ЕГРПО;
        $this->okvd = (string)$xml->ОКВЭД;
        $this->okdp = (string)$xml->ОКДП;
        $this->okopf = (string)$xml->ОКОПФ;
        $this->okfs = (string)$xml->ОКФС;
        $this->okpo = (string)$xml->ОКПО;
        $this->registerDate = new \DateTime((string)$xml->ДатаРегистрации);
    }
}