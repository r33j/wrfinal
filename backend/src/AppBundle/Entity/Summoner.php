<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Summoner
 *
 * @ORM\Table(name="summoner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SummonerRepository")
 *
 * @ApiResource(
 *     collectionOperations={},
 *     itemOperations={
 *          "get"={"method"="GET"},
 *          "by_name"={
 *              "method"="GET",
 *              "path"="/summoners/{name}/by-name",
 *              "swagger_context" = {
 *                  "parameters" = {
 *                      {
 *                          "name" = "name",
 *                          "required" = true,
 *                          "type" = "string",
 *                          "in" = "path",
 *                          "description" = "The summoner's name."
 *                      }
 *                   }
 *              }
 *            }
 *     },
 *     attributes={"normalization_context"={"groups"={"Summoner"}}}
 *     )
 */
class Summoner
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Groups({"Summoner"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="summonerName", type="string", length=255)
     * @Assert\NotBlank
     * @Groups({"Summoner"})
     */
    private $summonerName;

    /**
     * @var int
     *
     * @ORM\Column(name="AccountId", type="integer")
     * @Groups({"Summoner"})
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="profilIconId", type="string", length=255)
     * @Groups({"Summoner"})
     */
    private $profilIconId;

    /**
     * @var int
     *
     * @ORM\Column(name="Level", type="integer")
     * @Groups({"Summoner"})
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(name="leaguePoints", nullable=true, type="integer")
     * @Groups({"Summoner"})
     */
    private $leaguePoints;

    /**
     * @var string
     *
     * @ORM\Column(name="SeasonTier", nullable=true, type="string")
     * @Groups({"Summoner"})
     */
    private $SeasonTier;

    /**
     * @var string
     *
     * @ORM\Column(name="revisionDate", type="string")
     * @Groups({"Summoner"})
     */
    private $revisionDate;

    /**
     * @ORM\ManyToOne (targetEntity="User", inversedBy="summoners")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="SummonerInMatch", mappedBy="summoner", cascade={"persist"})
     * @Groups({"Summoner"})
     * @MaxDepth(1)
     */
    private $summonerInMatchs;

    public function _construct ()
   {
       $this->summonerInMatchs =  new ArrayCollection();
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
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set summonerName
     *
     * @param string $summonerName
     *
     * @return Summoner
     */
    public function setSummonerName($summonerName)
    {
        $this->summonerName= $summonerName;

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
     * Set accountId
     *
     * @param integer $accountId
     *
     * @return Summoner
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get accountId
     *
     * @return integer
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set profilIconId
     *
     * @param string $profilIconId
     *
     * @return Summoner
     */
    public function setProfilIconId($profilIconId)
    {
        $this->profilIconId = $profilIconId;

        return $this;
    }

    /**
     * Get profilIconId
     *
     * @return string
     */
    public function getProfilIconId()
    {
        return $this->profilIconId;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Summoner
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set leaguePoints
     *
     * @param integer $leaguePoints
     *
     * @return Summoner
     */
    public function setLeaguePoints($leaguePoints)
    {
        $this->leaguePoints = $leaguePoints;

        return $this;
    }

    /**
     * Get leaguePoints
     *
     * @return int
     */
    public function getLeaguePoints()
    {
        return $this->leaguePoints;
    }

    /**
     * Set SeasonTier
     *
     * @param string $SeasonTier
     *
     * @return Summoner
     */
    public function setSeasonTier($SeasonTier)
    {
        $this->SeasonTier= $SeasonTier;

        return $this;
    }

    /**
     * Get SeasonTier
     *
     * @return string
     */
    public function getSeasonTier()
    {
        return $this->SeasonTier;
    }

    /**
     * Set revisionDate
     *
     * @param \DateTime $revisionDate
     *
     * @return Summoner
     */
    public function setRevisionDate($revisionDate)
    {
        $this->revisionDate= $revisionDate;

        return $this;
    }

    /**
     * Get revisionDate
     *
     * @return \DateTime
     */
    public function getRevisionDate()
    {
        return $this->revisionDate;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->summonerInMatchs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Summoner
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add summonerInMatch
     *
     * @param \AppBundle\Entity\SummonerInMatch $summonerInMatch
     *
     * @return Summoner
     */
    public function addSummonerInMatch(\AppBundle\Entity\SummonerInMatch $summonerInMatch)
    {
        $this->summonerInMatchs[] = $summonerInMatch;

        return $this;
    }

    /**
     * Remove summonerInMatch
     *
     * @param \AppBundle\Entity\SummonerInMatch $summonerInMatch
     */
    public function removeSummonerInMatch(\AppBundle\Entity\SummonerInMatch $summonerInMatch)
    {
        $this->summonerInMatchs->removeElement($summonerInMatch);
    }

    /**
     * Get summonerInMatchs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSummonerInMatchs()
    {
        return $this->summonerInMatchs;
    }
}
