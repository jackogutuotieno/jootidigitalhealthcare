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
 * Entity class for "jdh_insurance" table
 */
#[Entity]
#[Table(name: "jdh_insurance")]
class JdhInsurance extends AbstractEntity
{
    public static array $propertyNames = [
        'insurance_id' => 'insuranceId',
        'insurance_name' => 'insuranceName',
        'insurance_contact_person' => 'insuranceContactPerson',
        'insurance_contact_person_phone' => 'insuranceContactPersonPhone',
        'insurance_contact_person_email' => 'insuranceContactPersonEmail',
        'insurance_physical_address' => 'insurancePhysicalAddress',
        'submission_date' => 'submissionDate',
        'date_updated' => 'dateUpdated',
        'submitted_by_user_id' => 'submittedByUserId',
    ];

    #[Id]
    #[Column(name: "insurance_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $insuranceId;

    #[Column(name: "insurance_name", type: "string")]
    private string $insuranceName;

    #[Column(name: "insurance_contact_person", type: "string")]
    private string $insuranceContactPerson;

    #[Column(name: "insurance_contact_person_phone", type: "string")]
    private string $insuranceContactPersonPhone;

    #[Column(name: "insurance_contact_person_email", type: "string")]
    private string $insuranceContactPersonEmail;

    #[Column(name: "insurance_physical_address", type: "text")]
    private string $insurancePhysicalAddress;

    #[Column(name: "submission_date", type: "datetime")]
    private DateTime $submissionDate;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    #[Column(name: "submitted_by_user_id", type: "integer")]
    private int $submittedByUserId;

    public function getInsuranceId(): int
    {
        return $this->insuranceId;
    }

    public function setInsuranceId(int $value): static
    {
        $this->insuranceId = $value;
        return $this;
    }

    public function getInsuranceName(): string
    {
        return HtmlDecode($this->insuranceName);
    }

    public function setInsuranceName(string $value): static
    {
        $this->insuranceName = RemoveXss($value);
        return $this;
    }

    public function getInsuranceContactPerson(): string
    {
        return HtmlDecode($this->insuranceContactPerson);
    }

    public function setInsuranceContactPerson(string $value): static
    {
        $this->insuranceContactPerson = RemoveXss($value);
        return $this;
    }

    public function getInsuranceContactPersonPhone(): string
    {
        return HtmlDecode($this->insuranceContactPersonPhone);
    }

    public function setInsuranceContactPersonPhone(string $value): static
    {
        $this->insuranceContactPersonPhone = RemoveXss($value);
        return $this;
    }

    public function getInsuranceContactPersonEmail(): string
    {
        return HtmlDecode($this->insuranceContactPersonEmail);
    }

    public function setInsuranceContactPersonEmail(string $value): static
    {
        $this->insuranceContactPersonEmail = RemoveXss($value);
        return $this;
    }

    public function getInsurancePhysicalAddress(): string
    {
        return HtmlDecode($this->insurancePhysicalAddress);
    }

    public function setInsurancePhysicalAddress(string $value): static
    {
        $this->insurancePhysicalAddress = RemoveXss($value);
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

    public function getDateUpdated(): DateTime
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(DateTime $value): static
    {
        $this->dateUpdated = $value;
        return $this;
    }

    public function getSubmittedByUserId(): int
    {
        return $this->submittedByUserId;
    }

    public function setSubmittedByUserId(int $value): static
    {
        $this->submittedByUserId = $value;
        return $this;
    }
}
