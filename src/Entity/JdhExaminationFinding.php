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
 * Entity class for "jdh_examination_findings" table
 */
#[Entity]
#[Table(name: "jdh_examination_findings")]
class JdhExaminationFinding extends AbstractEntity
{
    public static array $propertyNames = [
        'id' => 'id',
        'patient_id' => 'patientId',
        'general_exams' => 'generalExams',
        'systematic_exams' => 'systematicExams',
        'submitted_by_user_id' => 'submittedByUserId',
        'date_submitted' => 'dateSubmitted',
    ];

    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "general_exams", type: "string")]
    private string $generalExams;

    #[Column(name: "systematic_exams", type: "string")]
    private string $systematicExams;

    #[Column(name: "submitted_by_user_id", type: "integer")]
    private int $submittedByUserId;

    #[Column(name: "date_submitted", type: "datetime")]
    private DateTime $dateSubmitted;

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

    public function getGeneralExams(): string
    {
        return HtmlDecode($this->generalExams);
    }

    public function setGeneralExams(string $value): static
    {
        $this->generalExams = RemoveXss($value);
        return $this;
    }

    public function getSystematicExams(): string
    {
        return HtmlDecode($this->systematicExams);
    }

    public function setSystematicExams(string $value): static
    {
        $this->systematicExams = RemoveXss($value);
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

    public function getDateSubmitted(): DateTime
    {
        return $this->dateSubmitted;
    }

    public function setDateSubmitted(DateTime $value): static
    {
        $this->dateSubmitted = $value;
        return $this;
    }
}
