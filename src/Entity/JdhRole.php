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
 * Entity class for "jdh_roles" table
 */
#[Entity]
#[Table(name: "jdh_roles")]
class JdhRole extends AbstractEntity
{
    public static array $propertyNames = [
        'role_id' => 'roleId',
        'role_name' => 'roleName',
        'role_description' => 'roleDescription',
    ];

    #[Id]
    #[Column(name: "role_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $roleId;

    #[Column(name: "role_name", type: "string")]
    private string $roleName;

    #[Column(name: "role_description", type: "text", nullable: true)]
    private ?string $roleDescription;

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function setRoleId(int $value): static
    {
        $this->roleId = $value;
        return $this;
    }

    public function getRoleName(): string
    {
        return HtmlDecode($this->roleName);
    }

    public function setRoleName(string $value): static
    {
        $this->roleName = RemoveXss($value);
        return $this;
    }

    public function getRoleDescription(): ?string
    {
        return HtmlDecode($this->roleDescription);
    }

    public function setRoleDescription(?string $value): static
    {
        $this->roleDescription = RemoveXss($value);
        return $this;
    }
}
