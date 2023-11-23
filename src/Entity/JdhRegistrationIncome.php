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
 * Entity class for "jdh_registration_income" table
 */
#[Entity]
#[Table(name: "jdh_registration_income")]
class JdhRegistrationIncome extends AbstractEntity
{
    public static array $propertyNames = [
        'patient_id' => 'patientId',
        'patient_name' => 'patientName',
        'patient_gender' => 'patientGender',
        'service_cost' => 'serviceCost',
        'patient_registration_date' => 'patientRegistrationDate',
        'patient_dob_year' => 'patientDobYear',
    ];

    #[Id]
    #[Column(name: "patient_id", type: "bigint")]
    #[GeneratedValue]
    private string $patientId;

    #[Column(name: "patient_name", type: "string")]
    private string $patientName;

    #[Column(name: "patient_gender", type: "string")]
    private string $patientGender;

    #[Column(name: "service_cost", type: "integer")]
    private int $serviceCost;

    #[Column(name: "patient_registration_date", type: "datetime")]
    private DateTime $patientRegistrationDate;

    #[Column(name: "patient_dob_year", type: "integer")]
    private int $patientDobYear;

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

    public function getPatientGender(): string
    {
        return HtmlDecode($this->patientGender);
    }

    public function setPatientGender(string $value): static
    {
        $this->patientGender = RemoveXss($value);
        return $this;
    }

    public function getServiceCost(): int
    {
        return $this->serviceCost;
    }

    public function setServiceCost(int $value): static
    {
        $this->serviceCost = $value;
        return $this;
    }

    public function getPatientRegistrationDate(): DateTime
    {
        return $this->patientRegistrationDate;
    }

    public function setPatientRegistrationDate(DateTime $value): static
    {
        $this->patientRegistrationDate = $value;
        return $this;
    }

    public function getPatientDobYear(): int
    {
        return $this->patientDobYear;
    }

    public function setPatientDobYear(int $value): static
    {
        $this->patientDobYear = $value;
        return $this;
    }
}
