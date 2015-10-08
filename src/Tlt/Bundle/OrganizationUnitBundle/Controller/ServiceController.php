<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 11:39
 */
namespace Tlt\Bundle\OrganizationUnitBundle\Controller;

use Tlt\Bundle\OrganizationUnitBundle\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * @Route("/service")
 */
class ServiceController extends Controller
{
    /**
     * @Route("/index", name="tlt_organization_unit_service_index")
     * @Template()
     * @AclAncestor("tlt_organization_unit_service_view")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/view/{id}", name="tlt_organization_unit_service_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_service_view")
     */
    public function viewAction(Service $service)
    {
        return [
            'entity' => $service
        ];
    }

    /**
     * @Route("/create", name="tlt_organization_unit_service_create")
     * @AclAncestor("tlt_organization_unit_service_create")
     * @Template("TltOrganizationUnitBundle:Service:update.html.twig")
     */
    public function createAction()
    {
        $service = $this->get('tlt_organization_unit_service.manager')->createService();

        return $this->update($service);
    }

    /**
     * @Route("/update/{id}", name="tlt_organization_unit_service_update", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_service_update")
     */
    public function updateAction(Service $service)
    {
        return $this->update($service);
    }

    /**
     * @param Service $service
     * @return array
     */
    protected function update(Service $service)
    {
        if ($this->get('tlt_organization_unit_service.form.handler.entity')->process($service)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('tlt_organization_unit.service.message.saved')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'tlt_organization_unit_service_update', 'parameters' => ['id' => $service->getId()]],
                ['route' => 'tlt_organization_unit_service_view', 'parameters' => ['id' => $service->getId()]]
            );
        }

        return array(
            'entity' => $service,
            'form' => $this->get('tlt_organization_unit_service.form.entity')->createView()
        );
    }
}