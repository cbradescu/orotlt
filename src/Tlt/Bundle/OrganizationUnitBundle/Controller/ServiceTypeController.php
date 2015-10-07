<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 02/Oct/15
 * Time: 11:51
 */
namespace Tlt\Bundle\OrganizationUnitBundle\Controller;

use Tlt\Bundle\OrganizationUnitBundle\Entity\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * @Route("/service_type")
 */
class ServiceTypeController extends Controller
{
    /**
     * @Route("/index", name="tlt_organization_unit_service_type_index")
     * @Template()
     * @AclAncestor("tlt_organization_unit_service_type_view")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/view/{id}", name="tlt_organization_unit_service_type_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_service_type_view")
     */
    public function viewAction(ServiceType $serviceType)
    {
        return [
            'entity' => $serviceType
        ];
    }

    /**
     * @Route("/create", name="tlt_organization_unit_service_type_create")
     * @AclAncestor("tlt_organization_unit_service_type_create")
     * @Template("TltOrganizationUnitBundle:ServiceType:update.html.twig")
     */
    public function createAction()
    {
        $serviceType = $this->get('tlt_organization_unit_service_type.manager')->createServiceType();

        return $this->update($serviceType);
    }

    /**
     * @Route("/update/{id}", name="tlt_organization_unit_service_type_update", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_service_type_update")
     */
    public function updateAction(ServiceType $serviceType)
    {
        return $this->update($serviceType);
    }

    /**
     * @param ServiceType $serviceType
     * @return array
     */
    protected function update(ServiceType $serviceType)
    {
        if ($this->get('tlt_organization_unit_service_type.form.handler.entity')->process($serviceType)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('tlt_organization_unit.service_type.message.saved')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'tlt_organization_unit_service_type_update', 'parameters' => ['id' => $serviceType->getId()]],
                ['route' => 'tlt_organization_unit_service_type_view', 'parameters' => ['id' => $serviceType->getId()]]
            );
        }

        return array(
            'entity' => $serviceType,
            'form' => $this->get('tlt_organization_unit_service_type.form.entity')->createView()
        );
    }
}