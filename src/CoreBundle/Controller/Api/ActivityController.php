<?php

namespace Runalyze\Bundle\CoreBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/api")
 */
class ActivityController extends Controller
{
    /**
     * @Route("v1/activities/uploads", name="api-activity-upload")
     * @Security("has_role('ROLE_USER')")
     */
    public function activityUpload(Account $account)
    {
        //
    }
}
