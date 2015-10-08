<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 07/Oct/15
 * Time: 14:01
 */
namespace Tlt\Bundle\OrganizationUnitBundle\Controller;

use Tlt\Bundle\OrganizationUnitBundle\Entity\System;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * @Route("/system")
 */
class SystemController extends Controller
{
    /**
     * @Route("/index", name="tlt_organization_unit_system_index")
     * @Template()
     * @AclAncestor("tlt_organization_unit_system_view")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/view/{id}", name="tlt_organization_unit_system_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_system_view")
     */
    public function viewAction(System $system)
    {
        return [
            'entity' => $system
        ];
    }

    /**
     * @Route("/create", name="tlt_organization_unit_system_create")
     * @AclAncestor("tlt_organization_unit_system_create")
     * @Template("TltOrganizationUnitBundle:System:update.html.twig")
     */
    public function createAction()
    {
        $system = $this->get('tlt_organization_unit_system.manager')->createSystem();

        return $this->update($system);
    }

    /**
     * @Route("/update/{id}", name="tlt_organization_unit_system_update", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_system_update")
     */
    public function updateAction(System $system)
    {
        return $this->update($system);
    }

    /**
     * @param System $system
     * @return array
     */
    protected function update(System $system)
    {
        if ($this->get('tlt_organization_unit_system.form.handler.entity')->process($system)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('tlt_organization_unit.system.message.saved')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'tlt_organization_unit_system_update', 'parameters' => ['id' => $system->getId()]],
                ['route' => 'tlt_organization_unit_system_view', 'parameters' => ['id' => $system->getId()]]
            );
        }

        return array(
            'entity' => $system,
            'form' => $this->get('tlt_organization_unit_system.form.entity')->createView()
        );
    }
}