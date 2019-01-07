<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfitRepository")
 */
class Profit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $profit;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getProfit(): ?int
    {
        return $this->profit;
    }

    /**
     * @param int $profit
     *
     * @return Profit
     */
    public function setProfit(int $profit): self
    {
        $this->profit = $profit;

        return $this;
    }
}
