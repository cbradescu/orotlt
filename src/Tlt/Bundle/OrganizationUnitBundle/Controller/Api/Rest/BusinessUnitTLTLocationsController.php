<?php

namespace Tlt\Bundle\OrganizationUnitBundle\Controller\Api\Rest;

use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\Query;

use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

use Tlt\Bundle\OrganizationUnitBundle\Entity\Repository\TLTLocationRepository;
use Oro\Bundle\OrganizationBundle\Entity\BusinessUnit;

/**
 * @RouteResource("tltlocations")
 * @NamePrefix("tlt_api_business_unit_")
 * TODO: Discuss ACL impl.
 */
class BusinessUnitTLTLocationsController extends FOSRestController
{
    /**
     * REST GET tltLocations by businessUnit
     *
     * @param BusinessUnit $businessUnit
     *
     * @ApiDoc(
     *      description="Get tlt locations by business unit id",
     *      resource=true
     * )
     * @return Response
     */
    public function getAction(BusinessUnit $businessUnit = null)
    {
        if (!$businessUnit) {
            return $this->handleView(
                $this->view(null, Codes::HTTP_NOT_FOUND)
            );
        }

        /** @var $tltLocationRepository TLTLocationRepository */
        $tltLocationRepository = $this->getDoctrine()->getRepository('TltOrganizationUnitBundle:TLTLocation');
        $tltLocations = $tltLocationRepository->getBusinessUnitTLTLocations($businessUnit);

        return $this->handleView(
            $this->view($tltLocations, Codes::HTTP_OK)
        );
    }
}