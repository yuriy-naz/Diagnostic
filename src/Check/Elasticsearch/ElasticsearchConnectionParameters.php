<?php

declare(strict_types = 1);

namespace FiveLab\Component\Diagnostic\Check\Elasticsearch;

/**
 * The model for store parameters for connect to Elasticsearch.
 */
class ElasticsearchConnectionParameters
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var bool
     */
    private $ssl;

    /**
     * Constructor.
     *
     * @param string $host
     * @param int    $port
     * @param string $username
     * @param string $password
     * @param bool   $ssl
     */
    public function __construct(string $host, int $port = 9200, string $username = null, string $password = null, bool $ssl = false)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->ssl = $ssl;
    }

    /**
     * Get DSN
     *
     * @return string
     */
    public function getDsn(): string
    {
        return \sprintf(
            '%s://%s:%s@%s:%s',
            $this->ssl ? 'https' : 'http',
            $this->username,
            $this->password,
            $this->host,
            $this->port
        );
    }

    /**
     * Get the host for connect to Elasticsearch
     *
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Get the port for connect to Elasticsearch
     *
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Get the username for connect to Elasticsearch
     *
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Get the password for connect to Elasticsearch
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Is must use SSL connection?
     *
     * @return bool
     */
    public function isSsl(): bool
    {
        return $this->ssl;
    }
}