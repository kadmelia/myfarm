<?php

namespace Myfarm\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $site = $this->getCurrentSite();
        return array(
            "name" => $site->getName(),
            "description" => $site->getDescription(),
        );

    }

    /**
     * Get current site according to slug (subdomain).
     *
     * @return object
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    private function getCurrentSite()
    {

        $site = $this->getDoctrine()
            ->getRepository('MyfarmSiteBundle:Site')
            ->findOneBy(array("slug" => "collines"));

        if (!$site) {
            throw $this->createNotFoundException(
                'Aucun site trouvé pour ce slug : '
            );
        }

        return $site;

    }
}
