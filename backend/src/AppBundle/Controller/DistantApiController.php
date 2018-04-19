<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Champion;
use AppBundle\Entity\Summoner;
use AppBundle\Mapper\ChampionMapper;
use AppBundle\Mapper\MatchSummonerMapper;
use AppBundle\Mapper\SummonerInMatchMapper;
use AppBundle\Mapper\SummonerMapper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use RiotAPI\Definitions\Region;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class DistantApiController
 * @author Nicolas Touzanne
 * @package AppBundle\Controller
 *
 * @Route("/")
 */
class DistantApiController extends Controller
{
    /**
     * @param ChampionMapper $mapper
     * @return JsonResponse
     *
     * @Route("/champions", name="champions")
     */
    public function ChampionAction(ChampionMapper $mapper)
    {
        $champion = $mapper->getChampionData();

        $champ = $this->getDoctrine()->getRepository(Champion::class)->findAll();
        $rep = $this->get('serializer')->serialize($champ, 'json');

        return JsonResponse::fromJsonString($rep);
    }

    /**
     * @param $pseudo
     * @param Request $request
     * @param SummonerMapper $mapper
     * @param MatchSummonerMapper $map
     * @param SummonerInMatchMapper $mappe
     * @return JsonResponse
     *
     * @Route("/summonerName/{pseudo}", name="Summoner")
     */
    public function playerAction( Request $request, SummonerMapper $mapper, MatchSummonerMapper $map, SummonerInMatchMapper $mappe, $pseudo)
    {
        $region = $request->get('region', Region::EUROPE_WEST);

        if (null === $pseudo) {
            throw new NotFoundHttpException();
        }

        $summoner = $mapper->getPlayerData($pseudo, $region);
        $accountId = $summoner->getAccountId();
        $matchSummoners = $map->getMatchData($accountId);

        foreach ($matchSummoners as $matchSummoner) {
            $mappe->getSummonerInMatchData($matchSummoner, $summoner);
        }

        $sum = $this->getDoctrine()->getRepository(Summoner::class)->findOneBy(array('summonerName' => $pseudo));
        $rep = $this->get('serializer')->serialize($sum, 'json');

        return JsonResponse::fromJsonString($rep);

    }

}
