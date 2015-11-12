<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 09/Oct/15
 * Time: 10:24
 */
namespace Tlt\Bundle\OrganizationUnitBundle\Controller;

use Tlt\Bundle\OrganizationUnitBundle\Entity\Equipment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * @Route("/equipment")
 */
class EquipmentController extends Controller
{
    /**
     * @Route("/index", name="tlt_organization_unit_equipment_index")
     * @Template()
     * @AclAncestor("tlt_organization_unit_equipment_view")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/view/{id}", name="tlt_organization_unit_equipment_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_equipment_view")
     */
    public function viewAction(Equipment $equipment)
    {
        return [
            'entity' => $equipment
        ];
    }

    /**
     * @Route("/create", name="tlt_organization_unit_equipment_create")
     * @AclAncestor("tlt_organization_unit_equipment_create")
     * @Template("TltOrganizationUnitBundle:Equipment:update.html.twig")
     */
    public function createAction()
    {
        $equipment = $this->get('tlt_organization_unit_equipment.manager')->createEquipment();

        return $this->update($equipment);
    }

    /**
     * @Route("/update/{id}", name="tlt_organization_unit_equipment_update", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_equipment_update")
     */
    public function updateAction(Equipment $equipment)
    {
        return $this->update($equipment);
    }

    /**
     * @param Equipment $equipment
     * @return array
     */
    protected function update(Equipment $equipment)
    {
        if ($this->get('tlt_organization_unit_equipment.form.handler.entity')->process($equipment)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('tlt_organization_unit.equipment.message.saved')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'tlt_organization_unit_equipment_update', 'parameters' => ['id' => $equipment->getId()]],
                ['route' => 'tlt_organization_unit_equipment_view', 'parameters' => ['id' => $equipment->getId()]]
            );
        }

        return array(
            'entity' => $equipment,
            'form' => $this->get('tlt_organization_unit_equipment.form.entity')->createView()
        );
    }
}