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
 * SummonerInMatch
 *
 * @ORM\Table(name="summoner_in_match")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SummonerInMatchRepository")
 */
class SummonerInMatch
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"Summoner"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     * @Groups({"Summoner"})
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="lane", type="string", length=255)
     * @Groups({"Summoner"})
     */
    private $lane;

    /**
     * @var bool
     *
     * @ORM\Column(name="win", type="boolean", length=255)
     * @Groups({"Summoner"})
     */
    private $win;

    /**
     * @var int
     *
     * @ORM\Column(name="kills", type="integer")
     * @Groups({"Summoner"})
     */
    private $kills;

    /**
     * @var int
     *
     * @ORM\Column(name="deaths", type="integer")
     * @Groups({"Summoner"})
     */
    private $deaths;

    /**
     * @var int
     *
     * @ORM\Column(name="assists", type="integer")
     * @Groups({"Summoner"})
     */
    private $assists;

    /**
     * @ORM\ManyToOne(targetEntity="Champion", inversedBy="summonerInMatchs", cascade={"persist"})
     * @Groups({"Summoner"})
     * @MaxDepth(1)
     */
    private $champion;

    /**
     *  @ORM\ManyToOne (targetEntity ="Summoner", inversedBy ="summonerInMatchs")
     */
    private $summoner;

    /**
     * @ORM\ManyToOne(targetEntity="MatchSummoner", inversedBy="summonerInMatchs", cascade={"persist"})
     * @Groups({"Summoner"})
     * @MaxDepth(1)
     */
    private $matchSummoner;

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
     * Set role
     *
     * @param string $role
     *
     * @return SummonerInMatch
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getLane(): string
    {
        return $this->lane;
    }

    /**
     * @param string $lane
     */
    public function setLane(string $lane)
    {
        $this->lane = $lane;
    }

    /**
     * Set win
     *
     * @param bool $win
     *
     * @return SummonerInMatch
     */
    public function setWin($win)
    {
        $this->win = $win;

        return $this;
    }

    /**
     * Get win
     *
     * @return bool
     */
    public function getWin()
    {
        return $this->win;
    }

    /**
     * Set kills
     *
     * @param integer $kills
     *
     * @return SummonerInMatch
     */
    public function setKills($kills)
    {
        $this->kills = $kills;

        return $this;
    }

    /**
     * Get kills
     *
     * @return int
     */
    public function getKills()
    {
        return $this->kills;
    }

    /**
     * Set deaths
     *
     * @param integer $deaths
     *
     * @return SummonerInMatch
     */
    public function setDeaths($deaths)
    {
        $this->deaths = $deaths;

        return $this;
    }

    /**
     * Get deaths
     *
     * @return int
     */
    public function getDeaths()
    {
        return $this->deaths;
    }

    /**
     * Set assists
     *
     * @param integer $assists
     *
     * @return SummonerInMatch
     */
    public function setAssists($assists)
    {
        $this->assists = $assists;

        return $this;
    }

    /**
     * Get assists
     *
     * @return int
     */
    public function getAssists()
    {
        return $this->assists;
    }

    


    /**
     * Set champion
     *
     * @param \AppBundle\Entity\Champion $champion
     *
     * @return SummonerInMatch
     */
    public function setChampion(\AppBundle\Entity\Champion $champion = null)
    {
        $this->champion = $champion;

        return $this;
    }

    /**
     * Get champion
     *
     * @return \AppBundle\Entity\Champion
     */
    public function getChampion()
    {
        return $this->champion;
    }

    /**
     * Set summoner
     *
     * @param \AppBundle\Entity\Summoner $summoner
     *
     * @return SummonerInMatch
     */
    public function setSummoner(\AppBundle\Entity\Summoner $summoner = null)
    {
        $this->summoner = $summoner;

        return $this;
    }

    /**
     * Get summoner
     *
     * @return \AppBundle\Entity\Summoner
     */
    public function getSummoner()
    {
        return $this->summoner;
    }

    /**
     * Set matchSummoner
     *
     * @param \AppBundle\Entity\MatchSummoner $matchSummoner
     *
     * @return SummonerInMatch
     */
    public function setMatchSummoner(\AppBundle\Entity\MatchSummoner $matchSummoner = null)
    {
        $this->matchSummoner = $matchSummoner;

        return $this;
    }

    /**
     * Get matchSummoner
     *
     * @return \AppBundle\Entity\MatchSummoner
     */
    public function getMatchSummoner()
    {
        return $this->matchSummoner;
    }
}
