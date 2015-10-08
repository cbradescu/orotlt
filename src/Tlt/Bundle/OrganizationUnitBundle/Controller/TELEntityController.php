<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 13:46
 */
namespace Tlt\Bundle\OrganizationUnitBundle\Controller;

use Tlt\Bundle\OrganizationUnitBundle\Entity\TELEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * @Route("/tel_entity")
 */
class TELEntityController extends Controller
{
    /**
     * @Route("/index", name="tlt_organization_unit_tel_entity_index")
     * @Template()
     * @AclAncestor("tlt_organization_unit_tel_entity_view")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/view/{id}", name="tlt_organization_unit_tel_entity_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_tel_entity_view")
     */
    public function viewAction(TELEntity $telEntity)
    {
        return [
            'entity' => $telEntity
        ];
    }

    /**
     * @Route("/create", name="tlt_organization_unit_tel_entity_create")
     * @AclAncestor("tlt_organization_unit_tel_entity_create")
     * @Template("TltOrganizationUnitBundle:TELEntity:update.html.twig")
     */
    public function createAction()
    {
        $telEntity = $this->get('tlt_organization_unit_tel_entity.manager')->createTELEntity();

        return $this->update($telEntity);
    }

    /**
     * @Route("/update/{id}", name="tlt_organization_unit_tel_entity_update", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_tel_entity_update")
     */
    public function updateAction(TELEntity $telEntity)
    {
        return $this->update($telEntity);
    }

    /**
     * @param TELEntity $telEntity
     * @return array
     */
    protected function update(TELEntity $telEntity)
    {
        if ($this->get('tlt_organization_unit_tel_entity.form.handler.entity')->process($telEntity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('tlt_organization_unit.tel_entity.message.saved')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'tlt_organization_unit_tel_entity_update', 'parameters' => ['id' => $telEntity->getId()]],
                ['route' => 'tlt_organization_unit_tel_entity_view', 'parameters' => ['id' => $telEntity->getId()]]
            );
        }

        return array(
            'entity' => $telEntity,
            'form' => $this->get('tlt_organization_unit_tel_entity.form.entity')->createView()
        );
    }
}