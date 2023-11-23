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
 * Entity class for "jdh_patients" table
 */
#[Entity]
#[Table(name: "jdh_patients")]
class JdhPatient extends AbstractEntity
{
    public static array $propertyNames = [
        'patient_id' => 'patientId',
        'photo' => 'photo',
        'patient_ip_number' => 'patientIpNumber',
        'patient_name' => 'patientName',
        'patient_dob_year' => 'patientDobYear',
        'patient_age' => 'patientAge',
        'patient_gender' => 'patientGender',
        'patient_phone' => 'patientPhone',
        'patient_kin_name' => 'patientKinName',
        'patient_kin_phone' => 'patientKinPhone',
        'service_id' => 'serviceId',
        'patient_registration_date' => 'patientRegistrationDate',
        'time' => 'time',
        'is_inpatient' => 'isInpatient',
        'submitted_by_user_id' => 'submittedByUserId',
    ];

    #[Id]
    #[Column(name: "patient_id", type: "bigint", unique: true)]
    #[GeneratedValue]
    private string $patientId;

    #[Column(type: "blob", nullable: true)]
    private mixed $photo;

    #[Column(name: "patient_ip_number", type: "string", unique: true, nullable: true)]
    private ?string $patientIpNumber;

    #[Column(name: "patient_name", type: "string")]
    private string $patientName;

    #[Column(name: "patient_dob_year", type: "integer")]
    private int $patientDobYear;

    #[Column(name: "patient_age", type: "bigint", nullable: true, insertable: false, updatable: false)]
    private ?string $patientAge;

    #[Column(name: "patient_gender", type: "string")]
    private string $patientGender;

    #[Column(name: "patient_phone", type: "string", unique: true)]
    private string $patientPhone;

    #[Column(name: "patient_kin_name", type: "string", nullable: true)]
    private ?string $patientKinName;

    #[Column(name: "patient_kin_phone", type: "string", nullable: true)]
    private ?string $patientKinPhone;

    #[Column(name: "service_id", type: "integer")]
    private int $serviceId;

    #[Column(name: "patient_registration_date", type: "datetime")]
    private DateTime $patientRegistrationDate;

    #[Column(type: "time", nullable: true, insertable: false, updatable: false)]
    private ?DateTime $time;

    #[Column(name: "is_inpatient", type: "integer")]
    private int $isInpatient;

    #[Column(name: "submitted_by_user_id", type: "integer")]
    private int $submittedByUserId;

    public function getPatientId(): string
    {
        return $this->patientId;
    }

    public function setPatientId(string $value): static
    {
        $this->patientId = $value;
        return $this;
    }

    public function getPhoto(): mixed
    {
        return $this->photo;
    }

    public function setPhoto(mixed $value): static
    {
        $this->photo = $value;
        return $this;
    }

    public function getPatientIpNumber(): ?string
    {
        return HtmlDecode($this->patientIpNumber);
    }

    public function setPatientIpNumber(?string $value): static
    {
        $this->patientIpNumber = RemoveXss($value);
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

    public function getPatientDobYear(): int
    {
        return $this->patientDobYear;
    }

    public function setPatientDobYear(int $value): static
    {
        $this->patientDobYear = $value;
        return $this;
    }

    public function getPatientAge(): ?string
    {
        return $this->patientAge;
    }

    public function setPatientAge(?string $value): static
    {
        $this->patientAge = $value;
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

    public function getPatientPhone(): string
    {
        return HtmlDecode($this->patientPhone);
    }

    public function setPatientPhone(string $value): static
    {
        $this->patientPhone = RemoveXss($value);
        return $this;
    }

    public function getPatientKinName(): ?string
    {
        return HtmlDecode($this->patientKinName);
    }

    public function setPatientKinName(?string $value): static
    {
        $this->patientKinName = RemoveXss($value);
        return $this;
    }

    public function getPatientKinPhone(): ?string
    {
        return HtmlDecode($this->patientKinPhone);
    }

    public function setPatientKinPhone(?string $value): static
    {
        $this->patientKinPhone = RemoveXss($value);
        return $this;
    }

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function setServiceId(int $value): static
    {
        $this->serviceId = $value;
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

    public function getTime(): ?DateTime
    {
        return $this->time;
    }

    public function setTime(?DateTime $value): static
    {
        $this->time = $value;
        return $this;
    }

    public function getIsInpatient(): int
    {
        return $this->isInpatient;
    }

    public function setIsInpatient(int $value): static
    {
        $this->isInpatient = $value;
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
