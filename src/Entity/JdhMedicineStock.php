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
 * Entity class for "jdh_medicine_stock" table
 */
#[Entity]
#[Table(name: "jdh_medicine_stock")]
class JdhMedicineStock extends AbstractEntity
{
    public static array $propertyNames = [
        'id' => 'id',
        'medicine_id' => 'medicineId',
        'units_available' => 'unitsAvailable',
        'expiry_date' => 'expiryDate',
        'status' => 'status',
        'submittedby_user_id' => 'submittedbyUserId',
        'date_created' => 'dateCreated',
        'date_updated' => 'dateUpdated',
    ];

    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "medicine_id", type: "integer")]
    private int $medicineId;

    #[Column(name: "units_available", type: "integer")]
    private int $unitsAvailable;

    #[Column(name: "expiry_date", type: "date")]
    private DateTime $expiryDate;

    #[Column(type: "string", insertable: false, updatable: false)]
    private string $status;

    #[Column(name: "submittedby_user_id", type: "integer")]
    private int $submittedbyUserId;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

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

    public function getMedicineId(): int
    {
        return $this->medicineId;
    }

    public function setMedicineId(int $value): static
    {
        $this->medicineId = $value;
        return $this;
    }

    public function getUnitsAvailable(): int
    {
        return $this->unitsAvailable;
    }

    public function setUnitsAvailable(int $value): static
    {
        $this->unitsAvailable = $value;
        return $this;
    }

    public function getExpiryDate(): DateTime
    {
        return $this->expiryDate;
    }

    public function setExpiryDate(DateTime $value): static
    {
        $this->expiryDate = $value;
        return $this;
    }

    public function getStatus(): string
    {
        return HtmlDecode($this->status);
    }

    public function setStatus(string $value): static
    {
        $this->status = RemoveXss($value);
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

    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(DateTime $value): static
    {
        $this->dateCreated = $value;
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
