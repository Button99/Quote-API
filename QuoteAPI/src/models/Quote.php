<?php

namespace Src\models;

class Quote
{
    protected int $id;
    protected string $name, $quote;
    protected $created_at, $added_at;

    /**
     * @param int $id
     * @param string $name
     * @param string $quote
     * @param $created_at
     * @param $added_at
     */
    public function __construct(int $id, string $name, string $quote, $created_at, $added_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->quote = $quote;
        $this->created_at = $created_at;
        $this->added_at = $added_at;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getQuote(): string
    {
        return $this->quote;
    }

    /**
     * @param string $quote
     */
    public function setQuote(string $quote): void
    {
        $this->quote = $quote;
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

    /**
     * @return mixed
     */
    public function getAddedAt()
    {
        return $this->added_at;
    }

    /**
     * @param mixed $added_at
     */
    public function setAddedAt($added_at): void
    {
        $this->added_at = $added_at;
    }




}