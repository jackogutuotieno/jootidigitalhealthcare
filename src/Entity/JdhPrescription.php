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
 * Entity class for "jdh_prescriptions" table
 */
#[Entity]
#[Table(name: "jdh_prescriptions")]
class JdhPrescription extends AbstractEntity
{
    public static array $propertyNames = [
        'prescription_id' => 'prescriptionId',
        'patient_id' => 'patientId',
        'prescription_title' => 'prescriptionTitle',
        'medicine_id' => 'medicineId',
        'tabs' => 'tabs',
        'frequency' => 'frequency',
        'prescription_days' => 'prescriptionDays',
        'prescription_time' => 'prescriptionTime',
        'prescription_date' => 'prescriptionDate',
        'submitted_by_user_id' => 'submittedByUserId',
    ];

    #[Id]
    #[Column(name: "prescription_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $prescriptionId;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "prescription_title", type: "string")]
    private string $prescriptionTitle;

    #[Column(name: "medicine_id", type: "integer")]
    private int $medicineId;

    #[Column(type: "integer")]
    private int $tabs;

    #[Column(type: "integer")]
    private int $frequency;

    #[Column(name: "prescription_days", type: "integer")]
    private int $prescriptionDays;

    #[Column(name: "prescription_time", type: "string")]
    private string $prescriptionTime;

    #[Column(name: "prescription_date", type: "datetime")]
    private DateTime $prescriptionDate;

    #[Column(name: "submitted_by_user_id", type: "integer")]
    private int $submittedByUserId;

    public function getPrescriptionId(): int
    {
        return $this->prescriptionId;
    }

    public function setPrescriptionId(int $value): static
    {
        $this->prescriptionId = $value;
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

    public function getPrescriptionTitle(): string
    {
        return HtmlDecode($this->prescriptionTitle);
    }

    public function setPrescriptionTitle(string $value): static
    {
        $this->prescriptionTitle = RemoveXss($value);
        return $this;
    }

    public function getMedicineId(): int
    {
        return $this->medicineId;
    }

    public function setMedicineId(int $value): static
    {
        $this->medicineId = $value;
        return $this;
    }

    public function getTabs(): int
    {
        return $this->tabs;
    }

    public function setTabs(int $value): static
    {
        $this->tabs = $value;
        return $this;
    }

    public function getFrequency(): int
    {
        return $this->frequency;
    }

    public function setFrequency(int $value): static
    {
        $this->frequency = $value;
        return $this;
    }

    public function getPrescriptionDays(): int
    {
        return $this->prescriptionDays;
    }

    public function setPrescriptionDays(int $value): static
    {
        $this->prescriptionDays = $value;
        return $this;
    }

    public function getPrescriptionTime(): string
    {
        return HtmlDecode($this->prescriptionTime);
    }

    public function setPrescriptionTime(string $value): static
    {
        $this->prescriptionTime = RemoveXss($value);
        return $this;
    }

    public function getPrescriptionDate(): DateTime
    {
        return $this->prescriptionDate;
    }

    public function setPrescriptionDate(DateTime $value): static
    {
        $this->prescriptionDate = $value;
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
