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
 * Entity class for "jdh_ipd_admission" table
 */
#[Entity]
#[Table(name: "jdh_ipd_admission")]
class JdhIpdAdmission extends AbstractEntity
{
    public static array $propertyNames = [
        'id' => 'id',
        'unit_id' => 'unitId',
        'ward_id' => 'wardId',
        'bed_id' => 'bedId',
        'patient_id' => 'patientId',
        'user_id' => 'userId',
        'date_added' => 'dateAdded',
        'date_updated' => 'dateUpdated',
    ];

    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "unit_id", type: "integer")]
    private int $unitId;

    #[Column(name: "ward_id", type: "integer")]
    private int $wardId;

    #[Column(name: "bed_id", type: "integer")]
    private int $bedId;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "user_id", type: "integer")]
    private int $userId;

    #[Column(name: "date_added", type: "datetime")]
    private DateTime $dateAdded;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getUnitId(): int
    {
        return $this->unitId;
    }

    public function setUnitId(int $value): static
    {
        $this->unitId = $value;
        return $this;
    }

    public function getWardId(): int
    {
        return $this->wardId;
    }

    public function setWardId(int $value): static
    {
        $this->wardId = $value;
        return $this;
    }

    public function getBedId(): int
    {
        return $this->bedId;
    }

    public function setBedId(int $value): static
    {
        $this->bedId = $value;
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

    public function getDateAdded(): DateTime
    {
        return $this->dateAdded;
    }

    public function setDateAdded(DateTime $value): static
    {
        $this->dateAdded = $value;
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
}
