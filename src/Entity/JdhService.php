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
 * Entity class for "jdh_services" table
 */
#[Entity]
#[Table(name: "jdh_services")]
class JdhService extends AbstractEntity
{
    public static array $propertyNames = [
        'service_id' => 'serviceId',
        'category_id' => 'categoryId',
        'subcategory_id' => 'subcategoryId',
        'service_name' => 'serviceName',
        'service_cost' => 'serviceCost',
        'service_description' => 'serviceDescription',
        'date_created' => 'dateCreated',
        'date_updated' => 'dateUpdated',
        'submitted_by_user_id' => 'submittedByUserId',
    ];

    #[Id]
    #[Column(name: "service_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $serviceId;

    #[Column(name: "category_id", type: "integer")]
    private int $categoryId;

    #[Column(name: "subcategory_id", type: "integer")]
    private int $subcategoryId;

    #[Column(name: "service_name", type: "string")]
    private string $serviceName;

    #[Column(name: "service_cost", type: "integer")]
    private int $serviceCost;

    #[Column(name: "service_description", type: "text", nullable: true)]
    private ?string $serviceDescription;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    #[Column(name: "submitted_by_user_id", type: "integer")]
    private int $submittedByUserId;

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function setServiceId(int $value): static
    {
        $this->serviceId = $value;
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

    public function getSubcategoryId(): int
    {
        return $this->subcategoryId;
    }

    public function setSubcategoryId(int $value): static
    {
        $this->subcategoryId = $value;
        return $this;
    }

    public function getServiceName(): string
    {
        return HtmlDecode($this->serviceName);
    }

    public function setServiceName(string $value): static
    {
        $this->serviceName = RemoveXss($value);
        return $this;
    }

    public function getServiceCost(): int
    {
        return $this->serviceCost;
    }

    public function setServiceCost(int $value): static
    {
        $this->serviceCost = $value;
        return $this;
    }

    public function getServiceDescription(): ?string
    {
        return HtmlDecode($this->serviceDescription);
    }

    public function setServiceDescription(?string $value): static
    {
        $this->serviceDescription = RemoveXss($value);
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
