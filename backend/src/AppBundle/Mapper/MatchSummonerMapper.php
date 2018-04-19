<?php
namespace AppBundle\Mapper;

use AppBundle\Entity\MatchSummoner;
use Doctrine\ORM\EntityManagerInterface;
use RiotAPI\Definitions\Region;
use RiotAPI\RiotAPI;

/**
 * Class MatchSummonerMapper
 * @author Nicolas Touzanne
 * @package AppBundle\Mapper
 */
class MatchSummonerMapper
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
     * @param RiotAPI $api
     */
    public function __construct(EntityManagerInterface $em, RiotAPI $api)
    {
        $this->em = $em;
        $this->api = $api;
    }

    /**
     * @param int $accountId
     *
     * @param string $region
     * @return MatchSummoner[]
     */
    public function getMatchData($accountId, $region = null)
    {
        if (null === $region) {
            $region = Region::EUROPE_WEST;
        }
        $this->api->setTemporaryRegion($region);

        $data = $this->api->getRecentMatchlistByAccount($accountId);
        $matchLis = $data->matches;
        $service = $this->em->getRepository(MatchSummoner::class);

        $matchs = [];
        foreach ($matchLis as $key => $value){
            $match = $service->find($value->gameId);

            if ($match == null) {
                $match = new MatchSummoner();
                $match->setId($value->gameId);

                $matchApi = $this->api->getMatch($value->gameId);

                $match->setGameType($matchApi->gameMode);
                $match->setGameCreation(date('d-m-Y H:i',$matchApi->gameCreation/1000));
                $this->em->persist($match);
            }

            $matchs[] = $match;
        }

        $this->em->flush();

        return $matchs;
    }
}