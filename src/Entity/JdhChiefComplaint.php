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
 * Entity class for "jdh_chief_complaints" table
 */
#[Entity]
#[Table(name: "jdh_chief_complaints")]
class JdhChiefComplaint extends AbstractEntity
{
    public static array $propertyNames = [
        'id' => 'id',
        'patient_id' => 'patientId',
        'chief_compaints' => 'chiefCompaints',
        'addedby_user_id' => 'addedbyUserId',
        'modifiedby_user_id' => 'modifiedbyUserId',
        'date_created' => 'dateCreated',
        'date_updated' => 'dateUpdated',
    ];

    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "chief_compaints", type: "text")]
    private string $chiefCompaints;

    #[Column(name: "addedby_user_id", type: "integer")]
    private int $addedbyUserId;

    #[Column(name: "modifiedby_user_id", type: "integer")]
    private int $modifiedbyUserId;

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

    public function getPatientId(): int
    {
        return $this->patientId;
    }

    public function setPatientId(int $value): static
    {
        $this->patientId = $value;
        return $this;
    }

    public function getChiefCompaints(): string
    {
        return HtmlDecode($this->chiefCompaints);
    }

    public function setChiefCompaints(string $value): static
    {
        $this->chiefCompaints = RemoveXss($value);
        return $this;
    }

    public function getAddedbyUserId(): int
    {
        return $this->addedbyUserId;
    }

    public function setAddedbyUserId(int $value): static
    {
        $this->addedbyUserId = $value;
        return $this;
    }

    public function getModifiedbyUserId(): int
    {
        return $this->modifiedbyUserId;
    }

    public function setModifiedbyUserId(int $value): static
    {
        $this->modifiedbyUserId = $value;
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
