<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 09/Oct/15
 * Time: 08:23
 */
namespace Tlt\Bundle\OrganizationUnitBundle\Controller;

use Tlt\Bundle\OrganizationUnitBundle\Entity\GuaranteedValue;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * @Route("/guaranteed_value")
 */
class GuaranteedValueController extends Controller
{
    /**
     * @Route("/index", name="tlt_organization_unit_guaranteed_value_index")
     * @Template()
     * @AclAncestor("tlt_organization_unit_guaranteed_value_view")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/view/{id}", name="tlt_organization_unit_guaranteed_value_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_guaranteed_value_view")
     */
    public function viewAction(GuaranteedValue $guaranteedValue)
    {
        return [
            'entity' => $guaranteedValue
        ];
    }

    /**
     * @Route("/create", name="tlt_organization_unit_guaranteed_value_create")
     * @AclAncestor("tlt_organization_unit_guaranteed_value_create")
     * @Template("TltOrganizationUnitBundle:GuaranteedValue:update.html.twig")
     */
    public function createAction()
    {
        $guaranteedValue = $this->get('tlt_organization_unit_guaranteed_value.manager')->createGuaranteedValue();

        return $this->update($guaranteedValue);
    }

    /**
     * @Route("/update/{id}", name="tlt_organization_unit_guaranteed_value_update", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_guaranteed_value_update")
     */
    public function updateAction(GuaranteedValue $guaranteedValue)
    {
        return $this->update($guaranteedValue);
    }

    /**
     * @param GuaranteedValue $guaranteedValue
     * @return array
     */
    protected function update(GuaranteedValue $guaranteedValue)
    {
        if ($this->get('tlt_organization_unit_guaranteed_value.form.handler.entity')->process($guaranteedValue)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('tlt_organization_unit.guaranteed_value.message.saved')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'tlt_organization_unit_guaranteed_value_update', 'parameters' => ['id' => $guaranteedValue->getId()]],
                ['route' => 'tlt_organization_unit_guaranteed_value_view', 'parameters' => ['id' => $guaranteedValue->getId()]]
            );
        }

        return array(
            'entity' => $guaranteedValue,
            'form' => $this->get('tlt_organization_unit_guaranteed_value.form.entity')->createView()
        );
    }
}