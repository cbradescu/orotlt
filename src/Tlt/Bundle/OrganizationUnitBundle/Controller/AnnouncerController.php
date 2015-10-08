<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 15:22
 */
namespace Tlt\Bundle\OrganizationUnitBundle\Controller;

use Tlt\Bundle\OrganizationUnitBundle\Entity\Announcer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * @Route("/announcer")
 */
class AnnouncerController extends Controller
{
    /**
     * @Route("/index", name="tlt_organization_unit_announcer_index")
     * @Template()
     * @AclAncestor("tlt_organization_unit_announcer_view")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/view/{id}", name="tlt_organization_unit_announcer_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_announcer_view")
     */
    public function viewAction(Announcer $announcer)
    {
        return [
            'entity' => $announcer
        ];
    }

    /**
     * @Route("/create", name="tlt_organization_unit_announcer_create")
     * @AclAncestor("tlt_organization_unit_announcer_create")
     * @Template("TltOrganizationUnitBundle:Announcer:update.html.twig")
     */
    public function createAction()
    {
        $announcer = $this->get('tlt_organization_unit_announcer.manager')->createAnnouncer();

        return $this->update($announcer);
    }

    /**
     * @Route("/update/{id}", name="tlt_organization_unit_announcer_update", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_announcer_update")
     */
    public function updateAction(Announcer $announcer)
    {
        return $this->update($announcer);
    }

    /**
     * @param Announcer $announcer
     * @return array
     */
    protected function update(Announcer $announcer)
    {
        if ($this->get('tlt_organization_unit_announcer.form.handler.entity')->process($announcer)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('tlt_organization_unit.announcer.message.saved')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'tlt_organization_unit_announcer_update', 'parameters' => ['id' => $announcer->getId()]],
                ['route' => 'tlt_organization_unit_announcer_view', 'parameters' => ['id' => $announcer->getId()]]
            );
        }

        return array(
            'entity' => $announcer,
            'form' => $this->get('tlt_organization_unit_announcer.form.entity')->createView()
        );
    }
}