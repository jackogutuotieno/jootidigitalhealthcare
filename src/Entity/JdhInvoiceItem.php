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
 * Entity class for "jdh_invoice_items" table
 */
#[Entity]
#[Table(name: "jdh_invoice_items")]
class JdhInvoiceItem extends AbstractEntity
{
    public static array $propertyNames = [
        'id' => 'id',
        'invoice_id' => 'invoiceId',
        'invoice_item' => 'invoiceItem',
        'total_amount' => 'totalAmount',
        'submittedby_user_id' => 'submittedbyUserId',
        'submission_date' => 'submissionDate',
    ];

    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "invoice_id", type: "integer")]
    private int $invoiceId;

    #[Column(name: "invoice_item", type: "string")]
    private string $invoiceItem;

    #[Column(name: "total_amount", type: "integer")]
    private int $totalAmount;

    #[Column(name: "submittedby_user_id", type: "integer")]
    private int $submittedbyUserId;

    #[Column(name: "submission_date", type: "datetime")]
    private DateTime $submissionDate;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getInvoiceId(): int
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(int $value): static
    {
        $this->invoiceId = $value;
        return $this;
    }

    public function getInvoiceItem(): string
    {
        return HtmlDecode($this->invoiceItem);
    }

    public function setInvoiceItem(string $value): static
    {
        $this->invoiceItem = RemoveXss($value);
        return $this;
    }

    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(int $value): static
    {
        $this->totalAmount = $value;
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

    public function getSubmissionDate(): DateTime
    {
        return $this->submissionDate;
    }

    public function setSubmissionDate(DateTime $value): static
    {
        $this->submissionDate = $value;
        return $this;
    }
}
