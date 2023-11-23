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
 * Entity class for "jdh_beds" table
 */
#[Entity]
#[Table(name: "jdh_beds")]
class JdhBed extends AbstractEntity
{
    public static array $propertyNames = [
        'id' => 'id',
        'facility_id' => 'facilityId',
        'ward_id' => 'wardId',
        'bed_number' => 'bedNumber',
        'assigned' => 'assigned',
    ];

    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "facility_id", type: "integer")]
    private int $facilityId;

    #[Column(name: "ward_id", type: "integer")]
    private int $wardId;

    #[Column(name: "bed_number", type: "integer")]
    private int $bedNumber;

    #[Column(type: "boolean")]
    private bool $assigned;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getFacilityId(): int
    {
        return $this->facilityId;
    }

    public function setFacilityId(int $value): static
    {
        $this->facilityId = $value;
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

    public function getBedNumber(): int
    {
        return $this->bedNumber;
    }

    public function setBedNumber(int $value): static
    {
        $this->bedNumber = $value;
        return $this;
    }

    public function getAssigned(): bool
    {
        return $this->assigned;
    }

    public function setAssigned(bool $value): static
    {
        $this->assigned = $value;
        return $this;
    }
}
