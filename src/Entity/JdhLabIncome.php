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
 * Entity class for "jdh_lab_income" table
 */
#[Entity]
#[Table(name: "jdh_lab_income")]
class JdhLabIncome extends AbstractEntity
{
    public static array $propertyNames = [
        'patient_id' => 'patientId',
        'patient_name' => 'patientName',
        'service_name' => 'serviceName',
        'service_cost' => 'serviceCost',
        'request_date' => 'requestDate',
        'patient_dob_year' => 'patientDobYear',
    ];

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "patient_name", type: "string")]
    private string $patientName;

    #[Column(name: "service_name", type: "string")]
    private string $serviceName;

    #[Column(name: "service_cost", type: "integer")]
    private int $serviceCost;

    #[Column(name: "request_date", type: "datetime")]
    private DateTime $requestDate;

    #[Column(name: "patient_dob_year", type: "integer")]
    private int $patientDobYear;

    public function getPatientId(): int
    {
        return $this->patientId;
    }

    public function setPatientId(int $value): static
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

    public function getServiceName(): string
    {
        return HtmlDecode($this->serviceName);
    }

    public function setServiceName(string $value): static
    {
        $this->serviceName = RemoveXss($value);
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

    public function getRequestDate(): DateTime
    {
        return $this->requestDate;
    }

    public function setRequestDate(DateTime $value): static
    {
        $this->requestDate = $value;
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
