<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * MatchSummoner
 *
 * @ORM\Table(name="match_summoner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MatchSummonerRepository")
 */
class MatchSummoner
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
     * @ORM\Column(name="gameType", type="string", length=255)
     * @Groups({"Summoner"})
     */
    private $gameType;

    /**
     * @var string
     *
     * @ORM\Column(name="gameCreation", type="string")
     * @Groups({"Summoner"})
     */
    private $gameCreation;

    /**
     * @var array
     *
     * @ORM\Column(name="participantsIdentities", type="array")
     * @Groups({"Summoner"})
     */
    private $participantsIdentities;

    /**
     * @ORM\OneToMany(targetEntity="SummonerInMatch", mappedBy="matchSummoner")
     * @ApiSubResource(maxDepth=1)
     */
    private $summonerInMatchs;

    public function _construct()
    {
        $this->summonerInMatchs = new ArrayCollection();
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
     * Set gameType
     *
     * @param string $gameType
     *
     * @return MatchSummoner
     */
    public function setGameType($gameType)
    {
        $this->gameType = $gameType;

        return $this;
    }

    /**
     * Get gameType
     *
     * @return string
     */
    public function getGameType()
    {
        return $this->gameType;
    }

    /**
     * Set gameCreation
     *
     * @param \DateTime $gameCreation
     *
     * @return MatchSummoner
     */
    public function setGameCreation($gameCreation)
    {
        $this->gameCreation = $gameCreation;

        return $this;
    }

    /**
     * Get gameCreation
     *
     * @return \DateTime
     */
    public function getGameCreation()
    {
        return $this->gameCreation;
    }

    /**
     * Set participantsIdentities
     *
     * @param array $participantsIdentities
     *
     * @return MatchSummoner
     */
    public function setParticipantsIdentities($participantsIdentities)
    {
        $this->participantsIdentities = $participantsIdentities;

        return $this;
    }

    /**
     * Get participantsIdentities
     *
     * @return array
     */
    public function getParticipantsIdentities()
    {
        return $this->participantsIdentities;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->summonerInMatchs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return MatchSummoner
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Add summonerInMatch
     *
     * @param \AppBundle\Entity\SummonerInMatch $summonerInMatch
     *
     * @return MatchSummoner
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
