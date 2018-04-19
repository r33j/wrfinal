<?php

namespace AppBundle\Mapper;


use AppBundle\Entity\Summoner;
use Doctrine\ORM\EntityManagerInterface;
use RiotAPI\Definitions\Region;
use RiotAPI\RiotAPI;
use DataDragonAPI\DataDragonAPI;
use Symfony\Component\Form\Tests\Extension\Core\DataTransformer\DateTimeToLocalizedStringTransformerTest;

/**
 * Class SummonerMapper
 * @author Nicolas Touzanne
 * @package AppBundle\Mapper
 */
class SummonerMapper
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
     * @param string $name
     *
     * @param string $region
     * @return Summoner
     */
    public function getPlayerData($name,$region = null)
    {
        //verify region of player
        if (null === $region) {
            $region = Region::EUROPE_WEST;
        }
        $this->api->setTemporaryRegion($region);

        //retrieve Data with name
        $data = $this->api->getSummonerByName($name);
        $summonerId = $data->id;

        $service = $this->em->getRepository(Summoner::class);
        $summoner = $service->find($data->id);
        //création de l'objet Summoner
        if ($summoner == null){
            $summoner = new Summoner();
            $summoner->setId($data->id);
            $summoner->setSummonerName($data->name);
            $summoner->setLevel($data->summonerLevel);
            $summoner->setAccountId($data->accountId);
            $summoner->setProfilIconId($data->profileIconId);
            // to show profilIcon:  http://ddragon.leagueoflegends.com/cdn/6.24.1/img/profileicon/{{{{$summoner->getProfilIconId()}}}}}.png
            // to show champion image:  http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/{{{{$champion->getName()}}}}.png
         $summoner->setRevisionDate(date('d-m-Y H:i', $data->revisionDate/1000));

        }

        //$summoner->setLeaguePoints($dataLeague->leaguePoints);
        //$summoner->setSeasonTier($dataLeague->tier);
        //$dataLeague = $this->api->getLeaguePositionsForSummoner($summonerId);

        $this->em->persist($summoner);
        $this->em->flush();
        //$partData2 = $partData->participants[]->stats;
        return $summoner;
    }
}