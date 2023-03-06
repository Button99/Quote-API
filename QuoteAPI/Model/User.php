<?php

namespace Model;

class User
{
    protected int $id;
    protected string $api_key, $email;
    protected $created_at;

    /**
     * @param int $id
     * @param string $api_key
     * @param string $email
     * @param $created_at
     */
    public function __construct(int $id, string $api_key, string $email, $created_at)
    {
        $this->id = $id;
        $this->api_key = $api_key;
        $this->email = $email;
        $this->created_at = $created_at;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->api_key;
    }

    /**
     * @param string $api_key
     */
    public function setApiKey(string $api_key): void
    {
        $this->api_key = $api_key;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }
}