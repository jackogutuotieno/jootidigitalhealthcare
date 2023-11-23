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
 * Entity class for "jdh_prescriptions_actions" table
 */
#[Entity]
#[Table(name: "jdh_prescriptions_actions")]
class JdhPrescriptionsAction extends AbstractEntity
{
    public static array $propertyNames = [
        'id' => 'id',
        'medicine_id' => 'medicineId',
        'patient_id' => 'patientId',
        'units_given' => 'unitsGiven',
        'submittedby_user_id' => 'submittedbyUserId',
        'submission_date' => 'submissionDate',
    ];

    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "medicine_id", type: "integer")]
    private int $medicineId;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "units_given", type: "integer")]
    private int $unitsGiven;

    #[Column(name: "submittedby_user_id", type: "integer")]
    private int $submittedbyUserId;

    #[Column(name: "submission_date", type: "datetime")]
    private DateTime $submissionDate;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
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

    public function getPatientId(): int
    {
        return $this->patientId;
    }

    public function setPatientId(int $value): static
    {
        $this->patientId = $value;
        return $this;
    }

    public function getUnitsGiven(): int
    {
        return $this->unitsGiven;
    }

    public function setUnitsGiven(int $value): static
    {
        $this->unitsGiven = $value;
        return $this;
    }

    public function getSubmittedbyUserId(): int
    {
        return $this->submittedbyUserId;
    }

    public function setSubmittedbyUserId(int $value): static
    {
        $this->submittedbyUserId = $value;
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
}
