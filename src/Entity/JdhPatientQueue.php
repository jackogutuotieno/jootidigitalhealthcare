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
 * Entity class for "jdh_patient_queue" table
 */
#[Entity]
#[Table(name: "jdh_patient_queue")]
class JdhPatientQueue extends AbstractEntity
{
    public static array $propertyNames = [
        'visit_id' => 'visitId',
        'patient_name' => 'patientName',
        'visit_type' => 'visitType',
        'visit_date' => 'visitDate',
    ];

    #[Id]
    #[Column(name: "visit_id", type: "integer")]
    #[GeneratedValue]
    private int $visitId;

    #[Column(name: "patient_name", type: "string")]
    private string $patientName;

    #[Column(name: "visit_type", type: "string")]
    private string $visitType;

    #[Column(name: "visit_date", type: "datetime")]
    private DateTime $visitDate;

    public function getVisitId(): int
    {
        return $this->visitId;
    }

    public function setVisitId(int $value): static
    {
        $this->visitId = $value;
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

    public function getVisitType(): string
    {
        return HtmlDecode($this->visitType);
    }

    public function setVisitType(string $value): static
    {
        $this->visitType = RemoveXss($value);
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
}
