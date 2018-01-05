<?php

namespace Runalyze\Bundle\CoreBundle\Controller\Internal\Data;

use Runalyze\Bundle\CoreBundle\Entity\Account;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Runalyze\Bundle\CoreBundle\Entity\Sport;

/**
 * @Route("/_internal/data/sport")
 */
class SportController extends Controller
{
    /**
     * @return \Runalyze\Bundle\CoreBundle\Entity\SportRepository
     */
    protected function getSportRepository()
    {
        return $this->getDoctrine()->getRepository('CoreBundle:Sport');
    }

    /**
     * @Route("/all", name="internal-data-race-results-all")
     * @Security("has_role('ROLE_USER')")
     */
    public function allRaceResultsAction(Account $account)
    {
        $result = [];
        $sports = $this->getSportRepository()->findAllFor($account);

        foreach ($sports as $sport) {
            /** @var Sport $sport */

            /** These are not all fields as we don't need all in the moment */
            $result[] = [
                'id' => $sport->getId(),
                'name' => $sport->getName(),
                'internal_id' => $sport->getInternalSportId(),
                'is_main' => $sport->isMain(),
                'speed' => $sport->getSpeed(),
                'has_distance' => $sport->getDistances()
            ];
        }

        return new JsonResponse($result);
    }
}
