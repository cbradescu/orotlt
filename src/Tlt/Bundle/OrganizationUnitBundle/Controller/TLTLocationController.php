<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 14:37
 */
namespace Tlt\Bundle\OrganizationUnitBundle\Controller;

use Tlt\Bundle\OrganizationUnitBundle\Entity\TLTLocation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * @Route("/tlt_location")
 */
class TLTLocationController extends Controller
{
    /**
     * @Route("/index", name="tlt_organization_unit_tlt_location_index")
     * @Template()
     * @AclAncestor("tlt_organization_unit_tlt_location_view")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/view/{id}", name="tlt_organization_unit_tlt_location_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_tlt_location_view")
     */
    public function viewAction(TLTLocation $tltLocation)
    {
        return [
            'entity' => $tltLocation
        ];
    }

    /**
     * @Route("/create", name="tlt_organization_unit_tlt_location_create")
     * @AclAncestor("tlt_organization_unit_tlt_location_create")
     * @Template("TltOrganizationUnitBundle:TLTLocation:update.html.twig")
     */
    public function createAction()
    {
        $tltLocation = $this->get('tlt_organization_unit_tlt_location.manager')->createTLTLocation();

        return $this->update($tltLocation);
    }

    /**
     * @Route("/update/{id}", name="tlt_organization_unit_tlt_location_update", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_tlt_location_update")
     */
    public function updateAction(TLTLocation $tltLocation)
    {
        return $this->update($tltLocation);
    }

    /**
     * @param TLTLocation $tltLocation
     * @return array
     */
    protected function update(TLTLocation $tltLocation)
    {
        if ($this->get('tlt_organization_unit_tlt_location.form.handler.entity')->process($tltLocation)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('tlt_organization_unit.tlt_location.message.saved')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'tlt_organization_unit_tlt_location_update', 'parameters' => ['id' => $tltLocation->getId()]],
                ['route' => 'tlt_organization_unit_tlt_location_view', 'parameters' => ['id' => $tltLocation->getId()]]
            );
        }

        return array(
            'entity' => $tltLocation,
            'form' => $this->get('tlt_organization_unit_tlt_location.form.entity')->createView()
        );
    }
}