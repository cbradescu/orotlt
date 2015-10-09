<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 07/Oct/15
 * Time: 14:33
 */
namespace Tlt\Bundle\OrganizationUnitBundle\Controller;

use Tlt\Bundle\OrganizationUnitBundle\Entity\WorkingSchedule;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * @Route("/working_schedule")
 */
class WorkingScheduleController extends Controller
{
    /**
     * @Route("/index", name="tlt_organization_unit_working_schedule_index")
     * @Template()
     * @AclAncestor("tlt_organization_unit_working_schedule_view")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/view/{id}", name="tlt_organization_unit_working_schedule_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_working_schedule_view")
     */
    public function viewAction(WorkingSchedule $workingSchedule)
    {
        $locale = $this->get('oro_locale.settings');
        $timeZone = $locale->getTimeZone();

        return [
            'entity' => $workingSchedule,
            'timeZone' => $timeZone
        ];
    }

    /**
     * @Route("/create", name="tlt_organization_unit_working_schedule_create")
     * @AclAncestor("tlt_organization_unit_working_schedule_create")
     * @Template("TltOrganizationUnitBundle:WorkingSchedule:update.html.twig")
     */
    public function createAction()
    {
        $workingSchedule = $this->get('tlt_organization_unit_working_schedule.manager')->createWorkingSchedule();

        return $this->update($workingSchedule);
    }

    /**
     * @Route("/update/{id}", name="tlt_organization_unit_working_schedule_update", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("tlt_organization_unit_working_schedule_update")
     */
    public function updateAction(WorkingSchedule $workingSchedule)
    {
        return $this->update($workingSchedule);
    }

    /**
     * @param WorkingSchedule $workingSchedule
     * @return array
     */
    protected function update(WorkingSchedule $workingSchedule)
    {
        if ($this->get('tlt_organization_unit_working_schedule.form.handler.entity')->process($workingSchedule)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('tlt_organization_unit.working_schedule.message.saved')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'tlt_organization_unit_working_schedule_update', 'parameters' => ['id' => $workingSchedule->getId()]],
                ['route' => 'tlt_organization_unit_working_schedule_view', 'parameters' => ['id' => $workingSchedule->getId()]]
            );
        }

        return array(
            'entity' => $workingSchedule,
            'form' => $this->get('tlt_organization_unit_working_schedule.form.entity')->createView()
        );
    }
}