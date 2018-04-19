<?php
namespace AppBundle\Mapper;

use AppBundle\Entity\Champion;
use AppBundle\Entity\MatchSummoner;
use AppBundle\Entity\Summoner;
use AppBundle\Entity\SummonerInMatch;
use Doctrine\ORM\EntityManagerInterface;
use RiotAPI\Definitions\Region;
use RiotAPI\RiotAPI;

/**
 * Class SummonerInMatchMapper
 * @author Nicolas Touzanne
 * @package AppBundle\Mapper
 */
class SummonerInMatchMapper
{
    /** @var RiotAPI  */
    private $api;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * SummonerMapper constructor.
     * @param EntityManagerInterface $em
     * @param $api
     */
    public function __construct(EntityManagerInterface $em,RiotAPI $api)
    {
        $this->em = $em;
        $this->api = $api;
    }

    /**
     *
     * @param string $region
     * @return SummonerInMatch|null
     */
    public function getSummonerInMatchData(MatchSummoner $match, Summoner $summoner, $region = null)
    {
        if (null === $region) {
            $region = Region::EUROPE_WEST;
        }
        $this->api->setTemporaryRegion($region);

        $service = $this->em->getRepository(SummonerInMatch::class);

        $sumInMatch = null;
        $partData = $this->api->getMatch($match->getId());
        foreach ($partData->participantIdentities as $keys => $values) {
            if ($values->player->summonerId == $summoner->getId()) {
                $sta = $partData->participants;
                foreach ($sta as $keyd => $valu){
                    if ($values->participantId == $valu->participantId){
                        $ro = $valu->timeline;
                        $stats = $valu->stats;

                        if(null == $sumInMatch = $service->find($values->player->summonerId)) {
                            $sumInMatch = new SummonerInMatch();
                            $sumInMatch->setRole($ro->role);
                            $sumInMatch->setLane($ro->lane);
                            $sumInMatch->setWin($stats->win);
                            $sumInMatch->setKills($stats->kills);
                            $sumInMatch->setDeaths($stats->deaths);
                            $sumInMatch->setAssists($stats->assists);
                            $sumInMatch->setMatchSummoner($match);
                            $sumInMatch->setChampion($this->em->getRepository(Champion::class)->find($valu->championId));
                            $sumInMatch->setSummoner($summoner);
                            $this->em->persist($sumInMatch);
                        }
                    }
                }
            }
        }
        $this->em->flush();

        return $sumInMatch;

    }
}