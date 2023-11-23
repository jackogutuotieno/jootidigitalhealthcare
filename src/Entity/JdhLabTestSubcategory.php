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
 * Entity class for "jdh_lab_test_subcategories" table
 */
#[Entity]
#[Table(name: "jdh_lab_test_subcategories")]
class JdhLabTestSubcategory extends AbstractEntity
{
    public static array $propertyNames = [
        'test_subcategory_id' => 'testSubcategoryId',
        'test_category_id' => 'testCategoryId',
        'test_subcategory_name' => 'testSubcategoryName',
        'description' => 'description',
    ];

    #[Id]
    #[Column(name: "test_subcategory_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $testSubcategoryId;

    #[Column(name: "test_category_id", type: "integer")]
    private int $testCategoryId;

    #[Column(name: "test_subcategory_name", type: "string")]
    private string $testSubcategoryName;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    public function getTestSubcategoryId(): int
    {
        return $this->testSubcategoryId;
    }

    public function setTestSubcategoryId(int $value): static
    {
        $this->testSubcategoryId = $value;
        return $this;
    }

    public function getTestCategoryId(): int
    {
        return $this->testCategoryId;
    }

    public function setTestCategoryId(int $value): static
    {
        $this->testCategoryId = $value;
        return $this;
    }

    public function getTestSubcategoryName(): string
    {
        return HtmlDecode($this->testSubcategoryName);
    }

    public function setTestSubcategoryName(string $value): static
    {
        $this->testSubcategoryName = RemoveXss($value);
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
