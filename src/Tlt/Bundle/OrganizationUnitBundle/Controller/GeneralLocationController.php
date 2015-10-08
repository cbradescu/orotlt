<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 14:24
 */
namespace Tlt\Bundle\OrganizationUnitBundle\Controller;

use Tlt\Bundle\OrganizationUnitBundle\Entity\GeneralLocation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * @Route("/general_location")
 */
class GeneralLocationController extends Controller
{
    /**
     * @Route("/index", name="tlt_organization_unit_general_location_index")
     * @Template()
     * @AclAncestor("tlt_organization_unit_general_location_view")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/view/{id}", name="tlt_organization_unit_general_location_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_general_location_view")
     */
    public function viewAction(GeneralLocation $generalLocation)
    {
        return [
            'entity' => $generalLocation
        ];
    }

    /**
     * @Route("/create", name="tlt_organization_unit_general_location_create")
     * @AclAncestor("tlt_organization_unit_general_location_create")
     * @Template("TltOrganizationUnitBundle:GeneralLocation:update.html.twig")
     */
    public function createAction()
    {
        $generalLocation = $this->get('tlt_organization_unit_general_location.manager')->createGeneralLocation();

        return $this->update($generalLocation);
    }

    /**
     * @Route("/update/{id}", name="tlt_organization_unit_general_location_update", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_general_location_update")
     */
    public function updateAction(GeneralLocation $generalLocation)
    {
        return $this->update($generalLocation);
    }

    /**
     * @param GeneralLocation $generalLocation
     * @return array
     */
    protected function update(GeneralLocation $generalLocation)
    {
        if ($this->get('tlt_organization_unit_general_location.form.handler.entity')->process($generalLocation)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('tlt_organization_unit.general_location.message.saved')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'tlt_organization_unit_general_location_update', 'parameters' => ['id' => $generalLocation->getId()]],
                ['route' => 'tlt_organization_unit_general_location_view', 'parameters' => ['id' => $generalLocation->getId()]]
            );
        }

        return array(
            'entity' => $generalLocation,
            'form' => $this->get('tlt_organization_unit_general_location.form.entity')->createView()
        );
    }
}