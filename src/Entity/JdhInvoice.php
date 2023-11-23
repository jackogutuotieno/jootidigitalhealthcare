<?php

namespace PHPMaker2024\jootidigitalhealthcare\Entity;

use DateTime;
use DateTimeImmutable;
use DateInterval;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\SequenceGenerator;
use Doctrine\DBAL\Types\Types;
use PHPMaker2024\jootidigitalhealthcare\AbstractEntity;
use PHPMaker2024\jootidigitalhealthcare\AdvancedSecurity;
use PHPMaker2024\jootidigitalhealthcare\UserProfile;
use function PHPMaker2024\jootidigitalhealthcare\Config;
use function PHPMaker2024\jootidigitalhealthcare\EntityManager;
use function PHPMaker2024\jootidigitalhealthcare\RemoveXss;
use function PHPMaker2024\jootidigitalhealthcare\HtmlDecode;
use function PHPMaker2024\jootidigitalhealthcare\EncryptPassword;

/**
 * Entity class for "jdh_invoice" table
 */
#[Entity]
#[Table(name: "jdh_invoice")]
class JdhInvoice extends AbstractEntity
{
    public static array $propertyNames = [
        'id' => 'id',
        'patient_id' => 'patientId',
        'invoice_title' => 'invoiceTitle',
        'invoice_description' => 'invoiceDescription',
        'invoice_date' => 'invoiceDate',
        'submittedby_user_id' => 'submittedbyUserId',
    ];

    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "invoice_title", type: "string")]
    private string $invoiceTitle;

    #[Column(name: "invoice_description", type: "text")]
    private string $invoiceDescription;

    #[Column(name: "invoice_date", type: "datetime")]
    private DateTime $invoiceDate;

    #[Column(name: "submittedby_user_id", type: "integer")]
    private int $submittedbyUserId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getPatientId(): int
    {
        return $this->patientId;
    }

    public function setPatientId(int $value): static
    {
        $this->patientId = $value;
        return $this;
    }

    public function getInvoiceTitle(): string
    {
        return HtmlDecode($this->invoiceTitle);
    }

    public function setInvoiceTitle(string $value): static
    {
        $this->invoiceTitle = RemoveXss($value);
        return $this;
    }

    public function getInvoiceDescription(): string
    {
        return HtmlDecode($this->invoiceDescription);
    }

    public function setInvoiceDescription(string $value): static
    {
        $this->invoiceDescription = RemoveXss($value);
        return $this;
    }

    public function getInvoiceDate(): DateTime
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate(DateTime $value): static
    {
        $this->invoiceDate = $value;
        return $this;
    }

    public function getSubmittedbyUserId(): int
    {
        return $this->submittedbyUserId;
    }

    public function setSubmittedbyUserId(int $value): static
    {
        $this->submittedbyUserId = $value;
        return $this;
    }
}
