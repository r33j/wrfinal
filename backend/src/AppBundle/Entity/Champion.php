<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Champion
 *
 * @ORM\Table(name="champion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChampionRepository")
 *
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={"groups"={"champion"}},
 *         "pagination_enabled"=false
 *     },
 *     itemOperations={
 *          "get"={"method"="GET"}
 *     },
 *     collectionOperations={"get"={"method"="GET"}},
 *     )
 */
class Champion
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank
     * @Groups({"champion","Summoner"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="SummonerInMatch", mappedBy="champion")
     */
    private $summonerInMatchs;

    /**
     * Set id
     *
     * @param int $id
     *
     * @return Champion
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
 * Set name
 *
 * @param string $name
 *
 * @return Champion
 */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->summonerInMatchs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add summonerInMatch
     *
     * @param \AppBundle\Entity\SummonerInMatch $summonerInMatch
     *
     * @return Champion
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
