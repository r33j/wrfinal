<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 *
 *
 * @ApiResource
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="summonerName", type="string", length=255)
     * @Assert\NotBlank
     */
    private $summonerName;

    /**
     * @var int
     *
     * @ORM\Column(name="UserId", type="integer", length=255)
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="gameId", type="integer", length=255)
     */
    private $gameId;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="Game")
     * @ORM\JoinTable(name="users_games",
     *     joinColumns={@ORM\JoinColumn (name="user_id ", referencedColumnName ="id")},
     *     inverseJoinColumns ={ @ORM\JoinColumn (name ="game_id ", referencedColumnName ="id")}
     * )
     */
    private $games;

    /**
     * @ORM\OneToMany(targetEntity="Summoner", mappedBy="user")
     */
    private $summoners;

    public function _construct()
    {
        $this->games = new ArrayCollection();
        $this->features = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param int $userId
     *
     * @return User
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set gameId
     *
     * @param int $gameId
     *
     * @return User
     */
    public function setGameId($gameId)
    {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * Get gameId
     *
     * @return int
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * Set summonerName
     *
     * @param string $summonerName
     *
     * @return User
     */
    public function setSummonerName($summonerName)
    {
        $this->summonerName = $summonerName;

        return $this;
    }

    /**
     * Get summonerName
     *
     * @return string
     */
    public function getSummonerName()
    {
        return $this->summonerName;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
