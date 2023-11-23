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
 * Entity class for "jdh_medicines" table
 */
#[Entity]
#[Table(name: "jdh_medicines")]
class JdhMedicine extends AbstractEntity
{
    public static array $propertyNames = [
        'id' => 'id',
        'category_id' => 'categoryId',
        'name' => 'name',
        'selling_price' => 'sellingPrice',
        'buying_price' => 'buyingPrice',
        'description' => 'description',
        'expiry' => 'expiry',
        'date_created' => 'dateCreated',
        'date_updated' => 'dateUpdated',
        'submitted_by_user_id' => 'submittedByUserId',
    ];

    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "category_id", type: "integer")]
    private int $categoryId;

    #[Column(type: "string")]
    private string $name;

    #[Column(name: "selling_price", type: "float")]
    private float $sellingPrice;

    #[Column(name: "buying_price", type: "float")]
    private float $buyingPrice;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(type: "date")]
    private DateTime $expiry;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    #[Column(name: "submitted_by_user_id", type: "integer")]
    private int $submittedByUserId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
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

    public function getName(): string
    {
        return HtmlDecode($this->name);
    }

    public function setName(string $value): static
    {
        $this->name = RemoveXss($value);
        return $this;
    }

    public function getSellingPrice(): float
    {
        return $this->sellingPrice;
    }

    public function setSellingPrice(float $value): static
    {
        $this->sellingPrice = $value;
        return $this;
    }

    public function getBuyingPrice(): float
    {
        return $this->buyingPrice;
    }

    public function setBuyingPrice(float $value): static
    {
        $this->buyingPrice = $value;
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

    public function getExpiry(): DateTime
    {
        return $this->expiry;
    }

    public function setExpiry(DateTime $value): static
    {
        $this->expiry = $value;
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

    public function getSubmittedByUserId(): int
    {
        return $this->submittedByUserId;
    }

    public function setSubmittedByUserId(int $value): static
    {
        $this->submittedByUserId = $value;
        return $this;
    }
}
