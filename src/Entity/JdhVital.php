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
 * Entity class for "jdh_vitals" table
 */
#[Entity]
#[Table(name: "jdh_vitals")]
class JdhVital extends AbstractEntity
{
    public static array $propertyNames = [
        'vitals_id' => 'vitalsId',
        'patient_id' => 'patientId',
        'pressure' => 'pressure',
        'height' => 'height',
        'weight' => 'weight',
        'body_mass_index' => 'bodyMassIndex',
        'pulse_rate' => 'pulseRate',
        'respiratory_rate' => 'respiratoryRate',
        'temperature' => 'temperature',
        'random_blood_sugar' => 'randomBloodSugar',
        'spo_2' => 'spo2',
        'submission_date' => 'submissionDate',
        'submitted_by_user_id' => 'submittedByUserId',
        'patient_status' => 'patientStatus',
    ];

    #[Id]
    #[Column(name: "vitals_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $vitalsId;

    #[Column(name: "patient_id", type: "integer", nullable: true)]
    private ?int $patientId;

    #[Column(type: "integer")]
    private int $pressure;

    #[Column(type: "float")]
    private float $height;

    #[Column(type: "integer")]
    private int $weight;

    #[Column(name: "body_mass_index", type: "decimal", nullable: true, insertable: false, updatable: false)]
    private ?string $bodyMassIndex;

    #[Column(name: "pulse_rate", type: "integer")]
    private int $pulseRate;

    #[Column(name: "respiratory_rate", type: "integer")]
    private int $respiratoryRate;

    #[Column(type: "float")]
    private float $temperature;

    #[Column(name: "random_blood_sugar", type: "string")]
    private string $randomBloodSugar;

    #[Column(name: "spo_2", type: "integer")]
    private int $spo2;

    #[Column(name: "submission_date", type: "datetime")]
    private DateTime $submissionDate;

    #[Column(name: "submitted_by_user_id", type: "integer")]
    private int $submittedByUserId;

    #[Column(name: "patient_status", type: "string", insertable: false, updatable: false)]
    private string $patientStatus;

    public function getVitalsId(): int
    {
        return $this->vitalsId;
    }

    public function setVitalsId(int $value): static
    {
        $this->vitalsId = $value;
        return $this;
    }

    public function getPatientId(): ?int
    {
        return $this->patientId;
    }

    public function setPatientId(?int $value): static
    {
        $this->patientId = $value;
        return $this;
    }

    public function getPressure(): int
    {
        return $this->pressure;
    }

    public function setPressure(int $value): static
    {
        $this->pressure = $value;
        return $this;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setHeight(float $value): static
    {
        $this->height = $value;
        return $this;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $value): static
    {
        $this->weight = $value;
        return $this;
    }

    public function getBodyMassIndex(): ?string
    {
        return $this->bodyMassIndex;
    }

    public function setBodyMassIndex(?string $value): static
    {
        $this->bodyMassIndex = $value;
        return $this;
    }

    public function getPulseRate(): int
    {
        return $this->pulseRate;
    }

    public function setPulseRate(int $value): static
    {
        $this->pulseRate = $value;
        return $this;
    }

    public function getRespiratoryRate(): int
    {
        return $this->respiratoryRate;
    }

    public function setRespiratoryRate(int $value): static
    {
        $this->respiratoryRate = $value;
        return $this;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function setTemperature(float $value): static
    {
        $this->temperature = $value;
        return $this;
    }

    public function getRandomBloodSugar(): string
    {
        return HtmlDecode($this->randomBloodSugar);
    }

    public function setRandomBloodSugar(string $value): static
    {
        $this->randomBloodSugar = RemoveXss($value);
        return $this;
    }

    public function getSpo2(): int
    {
        return $this->spo2;
    }

    public function setSpo2(int $value): static
    {
        $this->spo2 = $value;
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

    public function getPatientStatus(): string
    {
        return HtmlDecode($this->patientStatus);
    }

    public function setPatientStatus(string $value): static
    {
        $this->patientStatus = RemoveXss($value);
        return $this;
    }
}
