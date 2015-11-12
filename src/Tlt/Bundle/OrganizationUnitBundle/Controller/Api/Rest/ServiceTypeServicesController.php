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

use Oro\Bundle\AddressBundle\Entity\Country;
use Oro\Bundle\AddressBundle\Entity\Repository\RegionRepository;
use Tlt\Bundle\OrganizationUnitBundle\Entity\ServiceType;

/**
 * @RouteResource("services")
 * @NamePrefix("tlt_api_service_type_")
 * TODO: Discuss ACL impl.
 */
class ServiceTypeServicesController extends FOSRestController
{
    /**
     * REST GET services by service_type
     *
     * @param ServiceType $serviceType
     *
     * @ApiDoc(
     *      description="Get services by service_type id",
     *      resource=true
     * )
     * @return Response
     */
    public function getAction(ServiceType $serviceType = null)
    {
        if (!$serviceType) {
            return $this->handleView(
                $this->view(null, Codes::HTTP_NOT_FOUND)
            );
        }

        /** @var $serviceRepository ServiceRepository */
        $serviceRepository = $this->getDoctrine()->getRepository('TltOrganizationUnitBundle:Service');
        $services = $serviceRepository->getServiceTypeServices($serviceType);

        return $this->handleView(
            $this->view($services, Codes::HTTP_OK)
        );
    }
}