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
     * @ORM\Column(type="float", nullable=true)
     */
    private $turnover;

    /**
     * @ORM\Column(type="float", nullable=true)
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
     * @return float|null
     */
    public function getProfit(): ?float
    {
        return $this->profit;
    }

    /**
     * @param float $profit
     *
     * @return Profit
     */
    public function setProfit(float $profit): self
    {
        $this->profit = $profit;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTurnover(): ?float
    {
        return $this->turnover;
    }

    /**
     * @param float $turnover
     *
     * @return Profit
     */
    public function setTurnover(float $turnover): self
    {
        $this->turnover = $turnover;

        return $this;
    }
}
