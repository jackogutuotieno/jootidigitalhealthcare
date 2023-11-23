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
 * Entity class for "jdh_medicine_categories" table
 */
#[Entity]
#[Table(name: "jdh_medicine_categories")]
class JdhMedicineCategory extends AbstractEntity
{
    public static array $propertyNames = [
        'category_id' => 'categoryId',
        'category_name' => 'categoryName',
        'category_description' => 'categoryDescription',
    ];

    #[Id]
    #[Column(name: "category_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $categoryId;

    #[Column(name: "category_name", type: "string")]
    private string $categoryName;

    #[Column(name: "category_description", type: "text")]
    private string $categoryDescription;

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $value): static
    {
        $this->categoryId = $value;
        return $this;
    }

    public function getCategoryName(): string
    {
        return HtmlDecode($this->categoryName);
    }

    public function setCategoryName(string $value): static
    {
        $this->categoryName = RemoveXss($value);
        return $this;
    }

    public function getCategoryDescription(): string
    {
        return HtmlDecode($this->categoryDescription);
    }

    public function setCategoryDescription(string $value): static
    {
        $this->categoryDescription = RemoveXss($value);
        return $this;
    }
}
