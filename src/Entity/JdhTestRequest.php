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
 * Entity class for "jdh_test_requests" table
 */
#[Entity]
#[Table(name: "jdh_test_requests")]
class JdhTestRequest extends AbstractEntity
{
    public static array $propertyNames = [
        'request_id' => 'requestId',
        'patient_id' => 'patientId',
        'request_title' => 'requestTitle',
        'request_service_id' => 'requestServiceId',
        'request_description' => 'requestDescription',
        'requested_by_user_id' => 'requestedByUserId',
        'request_date' => 'requestDate',
        'status_id' => 'statusId',
    ];

    #[Id]
    #[Column(name: "request_id", type: "bigint", unique: true)]
    #[GeneratedValue]
    private string $requestId;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "request_title", type: "string")]
    private string $requestTitle;

    #[Column(name: "request_service_id", type: "integer")]
    private int $requestServiceId;

    #[Column(name: "request_description", type: "text", nullable: true)]
    private ?string $requestDescription;

    #[Column(name: "requested_by_user_id", type: "integer")]
    private int $requestedByUserId;

    #[Column(name: "request_date", type: "datetime")]
    private DateTime $requestDate;

    #[Column(name: "status_id", type: "integer")]
    private int $statusId;

    public function getRequestId(): string
    {
        return $this->requestId;
    }

    public function setRequestId(string $value): static
    {
        $this->requestId = $value;
        return $this;
    }

    public function getPatientId(): int
    {
        return $this->patientId;
    }

    public function setPatientId(int $value): static
    {
        $this->patientId = $value;
        return $this;
    }

    public function getRequestTitle(): string
    {
        return HtmlDecode($this->requestTitle);
    }

    public function setRequestTitle(string $value): static
    {
        $this->requestTitle = RemoveXss($value);
        return $this;
    }

    public function getRequestServiceId(): int
    {
        return $this->requestServiceId;
    }

    public function setRequestServiceId(int $value): static
    {
        $this->requestServiceId = $value;
        return $this;
    }

    public function getRequestDescription(): ?string
    {
        return HtmlDecode($this->requestDescription);
    }

    public function setRequestDescription(?string $value): static
    {
        $this->requestDescription = RemoveXss($value);
        return $this;
    }

    public function getRequestedByUserId(): int
    {
        return $this->requestedByUserId;
    }

    public function setRequestedByUserId(int $value): static
    {
        $this->requestedByUserId = $value;
        return $this;
    }

    public function getRequestDate(): DateTime
    {
        return $this->requestDate;
    }

    public function setRequestDate(DateTime $value): static
    {
        $this->requestDate = $value;
        return $this;
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function setStatusId(int $value): static
    {
        $this->statusId = $value;
        return $this;
    }
}
