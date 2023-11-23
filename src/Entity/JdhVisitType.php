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
 * Entity class for "jdh_visit_types" table
 */
#[Entity]
#[Table(name: "jdh_visit_types")]
class JdhVisitType extends AbstractEntity
{
    public static array $propertyNames = [
        'visit_type_id' => 'visitTypeId',
        'visit_type' => 'visitType',
        'visit_description' => 'visitDescription',
    ];

    #[Id]
    #[Column(name: "visit_type_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $visitTypeId;

    #[Column(name: "visit_type", type: "string")]
    private string $visitType;

    #[Column(name: "visit_description", type: "text", nullable: true)]
    private ?string $visitDescription;

    public function getVisitTypeId(): int
    {
        return $this->visitTypeId;
    }

    public function setVisitTypeId(int $value): static
    {
        $this->visitTypeId = $value;
        return $this;
    }

    public function getVisitType(): string
    {
        return HtmlDecode($this->visitType);
    }

    public function setVisitType(string $value): static
    {
        $this->visitType = RemoveXss($value);
        return $this;
    }

    public function getVisitDescription(): ?string
    {
        return HtmlDecode($this->visitDescription);
    }

    public function setVisitDescription(?string $value): static
    {
        $this->visitDescription = RemoveXss($value);
        return $this;
    }
}
