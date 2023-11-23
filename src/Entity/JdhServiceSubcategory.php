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
 * Entity class for "jdh_service_subcategory" table
 */
#[Entity]
#[Table(name: "jdh_service_subcategory")]
class JdhServiceSubcategory extends AbstractEntity
{
    public static array $propertyNames = [
        'subcategory_id' => 'subcategoryId',
        'category_id' => 'categoryId',
        'subcategory_name' => 'subcategoryName',
        'description' => 'description',
    ];

    #[Id]
    #[Column(name: "subcategory_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $subcategoryId;

    #[Column(name: "category_id", type: "integer")]
    private int $categoryId;

    #[Column(name: "subcategory_name", type: "string")]
    private string $subcategoryName;

    #[Column(type: "text")]
    private string $description;

    public function getSubcategoryId(): int
    {
        return $this->subcategoryId;
    }

    public function setSubcategoryId(int $value): static
    {
        $this->subcategoryId = $value;
        return $this;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $value): static
    {
        $this->categoryId = $value;
        return $this;
    }

    public function getSubcategoryName(): string
    {
        return HtmlDecode($this->subcategoryName);
    }

    public function setSubcategoryName(string $value): static
    {
        $this->subcategoryName = RemoveXss($value);
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
}
