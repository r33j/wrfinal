<?php
namespace AppBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use AppBundle\Entity\Summoner;
use AppBundle\Entity\SummonerInMatch;
use AppBundle\Entity\MatchSummoner;
use AppBundle\Mapper\MatchSummonerMapper;
use AppBundle\Mapper\SummonerInMatchMapper;
use AppBundle\Mapper\SummonerMapper;
use RiotAPI\Definitions\Region;
use Symfony\Component\HttpFoundation\RequestStack;

final class SummonerDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var SummonerMapper
     */
    private $mapper;

    /**
     * @var MatchSummonerMapper
     */
    private $map;

    /**
     * @var SummonerInMatchMapper
     */
    private $mappe;

    /**
     * SummonerDataProvider constructor.
     * @param RequestStack $requestStack
     * @param SummonerMapper $mapper
     * @param MatchSummonerMapper $map
     * @param SummonerInMatchMapper $mappe
     */
    public function __construct(RequestStack $requestStack, SummonerMapper $mapper, MatchSummonerMapper $map, SummonerInMatchMapper $mappe)
    {
        $this->requestStack = $requestStack;
        $this->mapper = $mapper;
        $this->map = $map;
        $this->mappe = $mappe;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Summoner::class === $resourceClass && $operationName == 'by_name';
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        $request = $this->requestStack->getMasterRequest();

        $params = $request->attributes->get('_route_params');
        $name = $params['name'];
        $region = $request->get('region', Region::EUROPE_WEST);

        $summoner = $this->mapper->getPlayerData($name, $region);
        $accountId = $summoner->getAccountId();
        $matchSummoners = $this->map->getMatchData($accountId);

        foreach ($matchSummoners as $matchSummoner) {
            $this->mappe->getSummonerInMatchData($matchSummoner, $summoner);
        }

        return $summoner;
    }
}