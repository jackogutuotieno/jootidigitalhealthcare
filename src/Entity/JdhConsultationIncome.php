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
 * Entity class for "jdh_consultation_income" table
 */
#[Entity]
#[Table(name: "jdh_consultation_income")]
class JdhConsultationIncome extends AbstractEntity
{
    public static array $propertyNames = [
        'user_id' => 'userId',
        'patient_id' => 'patientId',
        'first_name' => 'firstName',
        'last_name' => 'lastName',
        'department_id' => 'departmentId',
        'service_name' => 'serviceName',
        'service_cost' => 'serviceCost',
    ];

    #[Id]
    #[Column(name: "user_id", type: "integer")]
    #[GeneratedValue]
    private int $userId;

    #[Column(name: "patient_id", type: "bigint")]
    #[GeneratedValue]
    private string $patientId;

    #[Column(name: "first_name", type: "string")]
    private string $firstName;

    #[Column(name: "last_name", type: "string")]
    private string $lastName;

    #[Column(name: "department_id", type: "integer")]
    private int $departmentId;

    #[Column(name: "service_name", type: "string")]
    private string $serviceName;

    #[Column(name: "service_cost", type: "integer")]
    private int $serviceCost;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $value): static
    {
        $this->userId = $value;
        return $this;
    }

    public function getPatientId(): string
    {
        return $this->patientId;
    }

    public function setPatientId(string $value): static
    {
        $this->patientId = $value;
        return $this;
    }

    public function getFirstName(): string
    {
        return HtmlDecode($this->firstName);
    }

    public function setFirstName(string $value): static
    {
        $this->firstName = RemoveXss($value);
        return $this;
    }

    public function getLastName(): string
    {
        return HtmlDecode($this->lastName);
    }

    public function setLastName(string $value): static
    {
        $this->lastName = RemoveXss($value);
        return $this;
    }

    public function getDepartmentId(): int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(int $value): static
    {
        $this->departmentId = $value;
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
}
