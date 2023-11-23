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
 * Entity class for "jdh_pharmacy_income" table
 */
#[Entity]
#[Table(name: "jdh_pharmacy_income")]
class JdhPharmacyIncome extends AbstractEntity
{
    public static array $propertyNames = [
        'patient_id' => 'patientId',
        'patient_name' => 'patientName',
        'name' => 'name',
        'selling_price' => 'sellingPrice',
        'units_available' => 'unitsAvailable',
        'units_given' => 'unitsGiven',
        'units_remaining' => 'unitsRemaining',
        'submission_date' => 'submissionDate',
        'line_total_cost' => 'lineTotalCost',
    ];

    #[Id]
    #[Column(name: "patient_id", type: "bigint")]
    #[GeneratedValue]
    private string $patientId;

    #[Column(name: "patient_name", type: "string")]
    private string $patientName;

    #[Column(type: "string")]
    private string $name;

    #[Column(name: "selling_price", type: "float")]
    private float $sellingPrice;

    #[Column(name: "units_available", type: "integer")]
    private int $unitsAvailable;

    #[Column(name: "units_given", type: "integer")]
    private int $unitsGiven;

    #[Column(name: "units_remaining", type: "bigint", insertable: false, updatable: false)]
    private string $unitsRemaining;

    #[Column(name: "submission_date", type: "datetime")]
    private DateTime $submissionDate;

    #[Column(name: "line_total_cost", type: "float", insertable: false, updatable: false)]
    private float $lineTotalCost;

    public function getPatientId(): string
    {
        return $this->patientId;
    }

    public function setPatientId(string $value): static
    {
        $this->patientId = $value;
        return $this;
    }

    public function getPatientName(): string
    {
        return HtmlDecode($this->patientName);
    }

    public function setPatientName(string $value): static
    {
        $this->patientName = RemoveXss($value);
        return $this;
    }

    public function getName(): string
    {
        return HtmlDecode($this->name);
    }

    public function setName(string $value): static
    {
        $this->name = RemoveXss($value);
        return $this;
    }

    public function getSellingPrice(): float
    {
        return $this->sellingPrice;
    }

    public function setSellingPrice(float $value): static
    {
        $this->sellingPrice = $value;
        return $this;
    }

    public function getUnitsAvailable(): int
    {
        return $this->unitsAvailable;
    }

    public function setUnitsAvailable(int $value): static
    {
        $this->unitsAvailable = $value;
        return $this;
    }

    public function getUnitsGiven(): int
    {
        return $this->unitsGiven;
    }

    public function setUnitsGiven(int $value): static
    {
        $this->unitsGiven = $value;
        return $this;
    }

    public function getUnitsRemaining(): string
    {
        return $this->unitsRemaining;
    }

    public function setUnitsRemaining(string $value): static
    {
        $this->unitsRemaining = $value;
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

    public function getLineTotalCost(): float
    {
        return $this->lineTotalCost;
    }

    public function setLineTotalCost(float $value): static
    {
        $this->lineTotalCost = $value;
        return $this;
    }
}
