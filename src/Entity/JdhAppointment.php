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
 * Entity class for "jdh_appointments" table
 */
#[Entity]
#[Table(name: "jdh_appointments")]
class JdhAppointment extends AbstractEntity
{
    public static array $propertyNames = [
        'appointment_id' => 'appointmentId',
        'patient_id' => 'patientId',
        'user_id' => 'userId',
        'appointment_title' => 'appointmentTitle',
        'appointment_start_date' => 'appointmentStartDate',
        'appointment_end_date' => 'appointmentEndDate',
        'appointment_all_day' => 'appointmentAllDay',
        'appointment_description' => 'appointmentDescription',
        'submission_date' => 'submissionDate',
        'subbmitted_by_user_id' => 'subbmittedByUserId',
    ];

    #[Id]
    #[Column(name: "appointment_id", type: "bigint", unique: true)]
    #[GeneratedValue]
    private string $appointmentId;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "user_id", type: "integer")]
    private int $userId;

    #[Column(name: "appointment_title", type: "string")]
    private string $appointmentTitle;

    #[Column(name: "appointment_start_date", type: "datetime")]
    private DateTime $appointmentStartDate;

    #[Column(name: "appointment_end_date", type: "datetime")]
    private DateTime $appointmentEndDate;

    #[Column(name: "appointment_all_day", type: "boolean")]
    private bool $appointmentAllDay;

    #[Column(name: "appointment_description", type: "text")]
    private string $appointmentDescription;

    #[Column(name: "submission_date", type: "datetime")]
    private DateTime $submissionDate;

    #[Column(name: "subbmitted_by_user_id", type: "integer")]
    private int $subbmittedByUserId;

    public function getAppointmentId(): string
    {
        return $this->appointmentId;
    }

    public function setAppointmentId(string $value): static
    {
        $this->appointmentId = $value;
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

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $value): static
    {
        $this->userId = $value;
        return $this;
    }

    public function getAppointmentTitle(): string
    {
        return HtmlDecode($this->appointmentTitle);
    }

    public function setAppointmentTitle(string $value): static
    {
        $this->appointmentTitle = RemoveXss($value);
        return $this;
    }

    public function getAppointmentStartDate(): DateTime
    {
        return $this->appointmentStartDate;
    }

    public function setAppointmentStartDate(DateTime $value): static
    {
        $this->appointmentStartDate = $value;
        return $this;
    }

    public function getAppointmentEndDate(): DateTime
    {
        return $this->appointmentEndDate;
    }

    public function setAppointmentEndDate(DateTime $value): static
    {
        $this->appointmentEndDate = $value;
        return $this;
    }

    public function getAppointmentAllDay(): bool
    {
        return $this->appointmentAllDay;
    }

    public function setAppointmentAllDay(bool $value): static
    {
        $this->appointmentAllDay = $value;
        return $this;
    }

    public function getAppointmentDescription(): string
    {
        return HtmlDecode($this->appointmentDescription);
    }

    public function setAppointmentDescription(string $value): static
    {
        $this->appointmentDescription = RemoveXss($value);
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
