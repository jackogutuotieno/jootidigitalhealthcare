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
 * Entity class for "jdh_wards" table
 */
#[Entity]
#[Table(name: "jdh_wards")]
class JdhWard extends AbstractEntity
{
    public static array $propertyNames = [
        'ward_id' => 'wardId',
        'facility_id' => 'facilityId',
        'ward_name' => 'wardName',
        'description' => 'description',
    ];

    #[Id]
    #[Column(name: "ward_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $wardId;

    #[Column(name: "facility_id", type: "integer")]
    private int $facilityId;

    #[Column(name: "ward_name", type: "string")]
    private string $wardName;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    public function getWardId(): int
    {
        return $this->wardId;
    }

    public function setWardId(int $value): static
    {
        $this->wardId = $value;
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

    public function getWardName(): string
    {
        return HtmlDecode($this->wardName);
    }

    public function setWardName(string $value): static
    {
        $this->wardName = RemoveXss($value);
        return $this;
    }

    public function getDescription(): ?string
    {
        return HtmlDecode($this->description);
    }

    public function setDescription(?string $value): static
    {
        $this->description = RemoveXss($value);
        return $this;
    }
}
