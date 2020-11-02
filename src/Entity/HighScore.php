<?php

namespace App\Entity;

use App\Repository\HighScoreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HighScoreRepository::class)
 */
class HighScore
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->joinedAt = new \DateTime();
        $this->lastLogAt= new \DateTime();
        $this->nickname = "new";
        $this->game     = "default";
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $nickname;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $game;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        if ($nickname)
        {
            if (strlen($nickname) > 3)
            {
                substr($nickname, 0, 3);
                $this->nickname = $nickname;
            }
            else
            {
                $this->nickname = $nickname;
            }
        }

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getGame(): ?string
    {
        return $this->game;
    }

    public function setGame(?string $game): self
    {
        if ($game)
        {
            $this->game = $game;
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}