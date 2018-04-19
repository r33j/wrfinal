<?php
namespace AppBundle\Mapper;

use AppBundle\Entity\Champion;
use Doctrine\ORM\EntityManagerInterface;
use RiotAPI\Definitions\Region;
use RiotAPI\RiotAPI;

/**
 * Class ChampionMapper
 * @author Nicolas Touzanne
 * @package AppBundle\Mapper
 */
class ChampionMapper
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
     * @param string $region
     * @return object Champion
     */
    public function getChampionData($region = null)
    {
        if (null === $region) {
            $region = Region::EUROPE_WEST;
        }
        $this->api->setTemporaryRegion($region);


        $champion = 0;
        $data = $this->api->getStaticChampions();
        $service = $this->em->getRepository(Champion::class);
            $champ = $data->data ;
            foreach ($champ as $keys => $val){
                $champion = $service->find($val->id);
                if ($champion == null) {
                    $champion = new Champion();
                    $champion->setId($val->id);
                    $champion->setName($val->name);

                    $this->em->persist($champion);
                    $this->em->flush();
                }
            }
        return $champion;
    }
}