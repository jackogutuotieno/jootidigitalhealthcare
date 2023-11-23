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
 * Entity class for "subscriptions" table
 */
#[Entity]
#[Table(name: "subscriptions")]
class Subscription extends AbstractEntity
{
    public static array $propertyNames = [
        'Id' => 'id',
        'User' => 'user',
        'Endpoint' => 'endpoint',
        'PublicKey' => 'publicKey',
        'AuthenticationToken' => 'authenticationToken',
        'ContentEncoding' => 'contentEncoding',
    ];

    #[Id]
    #[Column(name: "Id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "User", type: "string", nullable: true)]
    private ?string $user;

    #[Column(name: "Endpoint", type: "text")]
    private string $endpoint;

    #[Column(name: "PublicKey", type: "string")]
    private string $publicKey;

    #[Column(name: "AuthenticationToken", type: "string")]
    private string $authenticationToken;

    #[Column(name: "ContentEncoding", type: "string")]
    private string $contentEncoding;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getUser(): ?string
    {
        return HtmlDecode($this->user);
    }

    public function setUser(?string $value): static
    {
        $this->user = RemoveXss($value);
        return $this;
    }

    public function getEndpoint(): string
    {
        return HtmlDecode($this->endpoint);
    }

    public function setEndpoint(string $value): static
    {
        $this->endpoint = RemoveXss($value);
        return $this;
    }

    public function getPublicKey(): string
    {
        return HtmlDecode($this->publicKey);
    }

    public function setPublicKey(string $value): static
    {
        $this->publicKey = RemoveXss($value);
        return $this;
    }

    public function getAuthenticationToken(): string
    {
        return HtmlDecode($this->authenticationToken);
    }

    public function setAuthenticationToken(string $value): static
    {
        $this->authenticationToken = RemoveXss($value);
        return $this;
    }

    public function getContentEncoding(): string
    {
        return HtmlDecode($this->contentEncoding);
    }

    public function setContentEncoding(string $value): static
    {
        $this->contentEncoding = RemoveXss($value);
        return $this;
    }
}
