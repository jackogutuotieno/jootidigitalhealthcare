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
 * Entity class for "jdh_test_reports" table
 */
#[Entity]
#[Table(name: "jdh_test_reports")]
class JdhTestReport extends AbstractEntity
{
    public static array $propertyNames = [
        'report_id' => 'reportId',
        'request_id' => 'requestId',
        'patient_id' => 'patientId',
        'report_findings' => 'reportFindings',
        'report_attachment' => 'reportAttachment',
        'report_submittedby_user_id' => 'reportSubmittedbyUserId',
        'report_date' => 'reportDate',
    ];

    #[Id]
    #[Column(name: "report_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $reportId;

    #[Column(name: "request_id", type: "integer")]
    private int $requestId;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "report_findings", type: "text")]
    private string $reportFindings;

    #[Column(name: "report_attachment", type: "blob", nullable: true)]
    private mixed $reportAttachment;

    #[Column(name: "report_submittedby_user_id", type: "integer")]
    private int $reportSubmittedbyUserId;

    #[Column(name: "report_date", type: "datetime")]
    private DateTime $reportDate;

    public function getReportId(): int
    {
        return $this->reportId;
    }

    public function setReportId(int $value): static
    {
        $this->reportId = $value;
        return $this;
    }

    public function getRequestId(): int
    {
        return $this->requestId;
    }

    public function setRequestId(int $value): static
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

    public function getReportFindings(): string
    {
        return HtmlDecode($this->reportFindings);
    }

    public function setReportFindings(string $value): static
    {
        $this->reportFindings = RemoveXss($value);
        return $this;
    }

    public function getReportAttachment(): mixed
    {
        return $this->reportAttachment;
    }

    public function setReportAttachment(mixed $value): static
    {
        $this->reportAttachment = $value;
        return $this;
    }

    public function getReportSubmittedbyUserId(): int
    {
        return $this->reportSubmittedbyUserId;
    }

    public function setReportSubmittedbyUserId(int $value): static
    {
        $this->reportSubmittedbyUserId = $value;
        return $this;
    }

    public function getReportDate(): DateTime
    {
        return $this->reportDate;
    }

    public function setReportDate(DateTime $value): static
    {
        $this->reportDate = $value;
        return $this;
    }
}
