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
 * Entity class for "jdh_patient_visits" table
 */
#[Entity]
#[Table(name: "jdh_patient_visits")]
class JdhPatientVisit extends AbstractEntity
{
    public static array $propertyNames = [
        'visit_id' => 'visitId',
        'patient_id' => 'patientId',
        'visit_type_id' => 'visitTypeId',
        'user_id' => 'userId',
        'insurance_id' => 'insuranceId',
        'visit_description' => 'visitDescription',
        'visit_date' => 'visitDate',
        'subbmitted_by_user_id' => 'subbmittedByUserId',
    ];

    #[Id]
    #[Column(name: "visit_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $visitId;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "visit_type_id", type: "integer")]
    private int $visitTypeId;

    #[Column(name: "user_id", type: "integer")]
    private int $userId;

    #[Column(name: "insurance_id", type: "integer", nullable: true)]
    private ?int $insuranceId;

    #[Column(name: "visit_description", type: "text", nullable: true)]
    private ?string $visitDescription;

    #[Column(name: "visit_date", type: "datetime")]
    private DateTime $visitDate;

    #[Column(name: "subbmitted_by_user_id", type: "integer")]
    private int $subbmittedByUserId;

    public function getVisitId(): int
    {
        return $this->visitId;
    }

    public function setVisitId(int $value): static
    {
        $this->visitId = $value;
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

    public function getVisitTypeId(): int
    {
        return $this->visitTypeId;
    }

    public function setVisitTypeId(int $value): static
    {
        $this->visitTypeId = $value;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $value): static
    {
        $this->userId = $value;
        return $this;
    }

    public function getInsuranceId(): ?int
    {
        return $this->insuranceId;
    }

    public function setInsuranceId(?int $value): static
    {
        $this->insuranceId = $value;
        return $this;
    }

    public function getVisitDescription(): ?string
    {
        return HtmlDecode($this->visitDescription);
    }

    public function setVisitDescription(?string $value): static
    {
        $this->visitDescription = RemoveXss($value);
        return $this;
    }

    public function getVisitDate(): DateTime
    {
        return $this->visitDate;
    }

    public function setVisitDate(DateTime $value): static
    {
        $this->visitDate = $value;
        return $this;
    }

    public function getSubbmittedByUserId(): int
    {
        return $this->subbmittedByUserId;
    }

    public function setSubbmittedByUserId(int $value): static
    {
        $this->subbmittedByUserId = $value;
        return $this;
    }
}
