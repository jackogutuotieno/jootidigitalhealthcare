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
 * Entity class for "jdh_lab_test_categories" table
 */
#[Entity]
#[Table(name: "jdh_lab_test_categories")]
class JdhLabTestCategory extends AbstractEntity
{
    public static array $propertyNames = [
        'test_category_id' => 'testCategoryId',
        'test_category_name' => 'testCategoryName',
        'test_category_description' => 'testCategoryDescription',
    ];

    #[Id]
    #[Column(name: "test_category_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $testCategoryId;

    #[Column(name: "test_category_name", type: "string")]
    private string $testCategoryName;

    #[Column(name: "test_category_description", type: "text", nullable: true)]
    private ?string $testCategoryDescription;

    public function getTestCategoryId(): int
    {
        return $this->testCategoryId;
    }

    public function setTestCategoryId(int $value): static
    {
        $this->testCategoryId = $value;
        return $this;
    }

    public function getTestCategoryName(): string
    {
        return HtmlDecode($this->testCategoryName);
    }

    public function setTestCategoryName(string $value): static
    {
        $this->testCategoryName = RemoveXss($value);
        return $this;
    }

    public function getTestCategoryDescription(): ?string
    {
        return HtmlDecode($this->testCategoryDescription);
    }

    public function setTestCategoryDescription(?string $value): static
    {
        $this->testCategoryDescription = RemoveXss($value);
        return $this;
    }
}
