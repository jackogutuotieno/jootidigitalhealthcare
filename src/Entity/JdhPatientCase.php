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
 * Entity class for "jdh_patient_cases" table
 */
#[Entity]
#[Table(name: "jdh_patient_cases")]
class JdhPatientCase extends AbstractEntity
{
    public static array $propertyNames = [
        'case_id' => 'caseId',
        'patient_id' => 'patientId',
        'history' => 'history',
        'random_blood_sugar' => 'randomBloodSugar',
        'medical_history' => 'medicalHistory',
        'family' => 'family',
        'socio_economic_history' => 'socioEconomicHistory',
        'notes' => 'notes',
        'submission_date' => 'submissionDate',
        'submitted_by_user_id' => 'submittedByUserId',
    ];

    #[Id]
    #[Column(name: "case_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $caseId;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(type: "text", nullable: true)]
    private ?string $history;

    #[Column(name: "random_blood_sugar", type: "text", nullable: true)]
    private ?string $randomBloodSugar;

    #[Column(name: "medical_history", type: "text")]
    private string $medicalHistory;

    #[Column(type: "text")]
    private string $family;

    #[Column(name: "socio_economic_history", type: "text")]
    private string $socioEconomicHistory;

    #[Column(type: "text", nullable: true)]
    private ?string $notes;

    #[Column(name: "submission_date", type: "datetime")]
    private DateTime $submissionDate;

    #[Column(name: "submitted_by_user_id", type: "integer")]
    private int $submittedByUserId;

    public function getCaseId(): int
    {
        return $this->caseId;
    }

    public function setCaseId(int $value): static
    {
        $this->caseId = $value;
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

    public function getHistory(): ?string
    {
        return HtmlDecode($this->history);
    }

    public function setHistory(?string $value): static
    {
        $this->history = RemoveXss($value);
        return $this;
    }

    public function getRandomBloodSugar(): ?string
    {
        return HtmlDecode($this->randomBloodSugar);
    }

    public function setRandomBloodSugar(?string $value): static
    {
        $this->randomBloodSugar = RemoveXss($value);
        return $this;
    }

    public function getMedicalHistory(): string
    {
        return HtmlDecode($this->medicalHistory);
    }

    public function setMedicalHistory(string $value): static
    {
        $this->medicalHistory = RemoveXss($value);
        return $this;
    }

    public function getFamily(): string
    {
        return HtmlDecode($this->family);
    }

    public function setFamily(string $value): static
    {
        $this->family = RemoveXss($value);
        return $this;
    }

    public function getSocioEconomicHistory(): string
    {
        return HtmlDecode($this->socioEconomicHistory);
    }

    public function setSocioEconomicHistory(string $value): static
    {
        $this->socioEconomicHistory = RemoveXss($value);
        return $this;
    }

    public function getNotes(): ?string
    {
        return HtmlDecode($this->notes);
    }

    public function setNotes(?string $value): static
    {
        $this->notes = RemoveXss($value);
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
