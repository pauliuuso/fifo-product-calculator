<?php

namespace App\Entity\Traits;

/**
 * Trait WithCreatedAt
 */
trait WithCreatedAt
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

}