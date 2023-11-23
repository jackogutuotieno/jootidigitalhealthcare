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
 * Entity class for "jdh_branding" table
 */
#[Entity]
#[Table(name: "jdh_branding")]
class JdhBranding extends AbstractEntity
{
    public static array $propertyNames = [
        'id' => 'id',
        'header_image' => 'headerImage',
        'footer_image' => 'footerImage',
    ];

    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "header_image", type: "blob", nullable: true)]
    private mixed $headerImage;

    #[Column(name: "footer_image", type: "blob", nullable: true)]
    private mixed $footerImage;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getHeaderImage(): mixed
    {
        return $this->headerImage;
    }

    public function setHeaderImage(mixed $value): static
    {
        $this->headerImage = $value;
        return $this;
    }

    public function getFooterImage(): mixed
    {
        return $this->footerImage;
    }

    public function setFooterImage(mixed $value): static
    {
        $this->footerImage = $value;
        return $this;
    }
}
