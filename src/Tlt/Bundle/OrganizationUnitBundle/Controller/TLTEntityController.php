<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 14:12
 */
namespace Tlt\Bundle\OrganizationUnitBundle\Controller;

use Tlt\Bundle\OrganizationUnitBundle\Entity\TLTEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * @Route("/tlt_entity")
 */
class TLTEntityController extends Controller
{
    /**
     * @Route("/index", name="tlt_organization_unit_tlt_entity_index")
     * @Template()
     * @AclAncestor("tlt_organization_unit_tlt_entity_view")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/view/{id}", name="tlt_organization_unit_tlt_entity_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_tlt_entity_view")
     */
    public function viewAction(TLTEntity $tltEntity)
    {
        return [
            'entity' => $tltEntity
        ];
    }

    /**
     * @Route("/create", name="tlt_organization_unit_tlt_entity_create")
     * @AclAncestor("tlt_organization_unit_tlt_entity_create")
     * @Template("TltOrganizationUnitBundle:TLTEntity:update.html.twig")
     */
    public function createAction()
    {
        $tltEntity = $this->get('tlt_organization_unit_tlt_entity.manager')->createTLTEntity();

        return $this->update($tltEntity);
    }

    /**
     * @Route("/update/{id}", name="tlt_organization_unit_tlt_entity_update", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_tlt_entity_update")
     */
    public function updateAction(TLTEntity $tltEntity)
    {
        return $this->update($tltEntity);
    }

    /**
     * @param TLTEntity $tltEntity
     * @return array
     */
    protected function update(TLTEntity $tltEntity)
    {
        if ($this->get('tlt_organization_unit_tlt_entity.form.handler.entity')->process($tltEntity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('tlt_organization_unit.tlt_entity.message.saved')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'tlt_organization_unit_tlt_entity_update', 'parameters' => ['id' => $tltEntity->getId()]],
                ['route' => 'tlt_organization_unit_tlt_entity_view', 'parameters' => ['id' => $tltEntity->getId()]]
            );
        }

        return array(
            'entity' => $tltEntity,
            'form' => $this->get('tlt_organization_unit_tlt_entity.form.entity')->createView()
        );
    }
}