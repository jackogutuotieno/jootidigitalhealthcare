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
 * Entity class for "jdh_users" table
 */
#[Entity]
#[Table(name: "jdh_users")]
class JdhUser extends AbstractEntity
{
    public static array $propertyNames = [
        'user_id' => 'userId',
        'photo' => 'photo',
        'first_name' => 'firstName',
        'last_name' => 'lastName',
        'national_id' => 'nationalId',
        'email_address' => 'emailAddress',
        'phone' => 'phone',
        'department_id' => 'departmentId',
        'password' => 'password',
        'biography' => 'biography',
        'registration_date' => 'registrationDate',
        'role_id' => 'roleId',
    ];

    #[Id]
    #[Column(name: "user_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $userId;

    #[Column(type: "blob", nullable: true)]
    private mixed $photo;

    #[Column(name: "first_name", type: "string")]
    private string $firstName;

    #[Column(name: "last_name", type: "string")]
    private string $lastName;

    #[Column(name: "national_id", type: "string", nullable: true)]
    private ?string $nationalId;

    #[Column(name: "email_address", type: "string")]
    private string $emailAddress;

    #[Column(type: "string")]
    private string $phone;

    #[Column(name: "department_id", type: "integer")]
    private int $departmentId;

    #[Column(type: "string")]
    private string $password;

    #[Column(type: "text")]
    private string $biography;

    #[Column(name: "registration_date", type: "datetime")]
    private DateTime $registrationDate;

    #[Column(name: "role_id", type: "integer")]
    private int $roleId;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $value): static
    {
        $this->userId = $value;
        return $this;
    }

    public function getPhoto(): mixed
    {
        return $this->photo;
    }

    public function setPhoto(mixed $value): static
    {
        $this->photo = $value;
        return $this;
    }

    public function getFirstName(): string
    {
        return HtmlDecode($this->firstName);
    }

    public function setFirstName(string $value): static
    {
        $this->firstName = RemoveXss($value);
        return $this;
    }

    public function getLastName(): string
    {
        return HtmlDecode($this->lastName);
    }

    public function setLastName(string $value): static
    {
        $this->lastName = RemoveXss($value);
        return $this;
    }

    public function getNationalId(): ?string
    {
        return HtmlDecode($this->nationalId);
    }

    public function setNationalId(?string $value): static
    {
        $this->nationalId = RemoveXss($value);
        return $this;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $value): static
    {
        $this->emailAddress = $value;
        return $this;
    }

    public function getPhone(): string
    {
        return HtmlDecode($this->phone);
    }

    public function setPhone(string $value): static
    {
        $this->phone = RemoveXss($value);
        return $this;
    }

    public function getDepartmentId(): int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(int $value): static
    {
        $this->departmentId = $value;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $value): static
    {
        $this->password = EncryptPassword(Config("CASE_SENSITIVE_PASSWORD") ? $value : strtolower($value));
        return $this;
    }

    public function getBiography(): string
    {
        return HtmlDecode($this->biography);
    }

    public function setBiography(string $value): static
    {
        $this->biography = RemoveXss($value);
        return $this;
    }

    public function getRegistrationDate(): DateTime
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(DateTime $value): static
    {
        $this->registrationDate = $value;
        return $this;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function setRoleId(int $value): static
    {
        $this->roleId = $value;
        return $this;
    }

    // Get login arguments
    public function getLoginArguments(): array
    {
        return [
            "userName" => $this->get('email_address'),
            "userId" => $this->get('user_id'),
            "parentUserId" => null,
            "userLevel" => $this->get('role_id') ?? AdvancedSecurity::ANONYMOUS_USER_LEVEL_ID,
            "userPrimaryKey" => $this->get('user_id'),
        ];
    }

    // Flush
    public function flush()
    {
        EntityManager("DB")->flush();
    }
}
