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
 * Entity class for "jdh_doctor_charges" table
 */
#[Entity]
#[Table(name: "jdh_doctor_charges")]
class JdhDoctorCharge extends AbstractEntity
{
    public static array $propertyNames = [
        'id' => 'id',
        'user_id' => 'userId',
        'service_id' => 'serviceId',
        'description' => 'description',
        'submission_date' => 'submissionDate',
        'date_updated' => 'dateUpdated',
        'submitted_by_user_id' => 'submittedByUserId',
    ];

    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "user_id", type: "integer")]
    private int $userId;

    #[Column(name: "service_id", type: "integer")]
    private int $serviceId;

    #[Column(type: "text")]
    private string $description;

    #[Column(name: "submission_date", type: "datetime")]
    private DateTime $submissionDate;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    #[Column(name: "submitted_by_user_id", type: "integer")]
    private int $submittedByUserId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
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

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function setServiceId(int $value): static
    {
        $this->serviceId = $value;
        return $this;
    }

    public function getDescription(): string
    {
        return HtmlDecode($this->description);
    }

    public function setDescription(string $value): static
    {
        $this->description = RemoveXss($value);
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

    public function getDateUpdated(): DateTime
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(DateTime $value): static
    {
        $this->dateUpdated = $value;
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
