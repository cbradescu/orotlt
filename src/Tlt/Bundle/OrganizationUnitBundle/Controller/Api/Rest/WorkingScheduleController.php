<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 07/Oct/15
 * Time: 14:33
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Controller\Api\Rest;

use Tlt\Bundle\OrganizationUnitBundle\Entity\WorkingSchedule;
use Symfony\Component\HttpFoundation\Response;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;

use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;

/**
 * @Rest\RouteResource("working_schedule")
 * @Rest\NamePrefix("tlt_organization_unit_working_schedule_api_")
 */
class WorkingScheduleController extends RestController implements ClassResourceInterface
{
    /**
     * REST GET list
     *
     * @Rest\QueryParam(
     *     name="page",
     *     requirements="\d+",
     *     nullable=true,
     *     description="Page number, starting from 1. Defaults to 1."
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     nullable=true,
     *     description="Number of items per page. defaults to 10."
     * )
     * @ApiDoc(
     *     description="Get all WorkingSchedule items",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_working_schedule_view")
     * @return Response
     */
    public function cgetAction()
    {
        $page  = (int)$this->getRequest()->get('page', 1);
        $limit = (int)$this->getRequest()->get('limit', self::ITEMS_PER_PAGE);

        return $this->handleGetListRequest($page, $limit);
    }

    /**
     * REST GET item
     *
     * @param string $id
     *
     * @ApiDoc(
     *     description="Get WorkingSchedule item",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_working_schedule_view")
     * @return Response
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * REST PUT
     *
     * @param int $id WorkingSchedule item id
     *
     * @ApiDoc(
     *     description="Update WorkingSchedule",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_working_schedule_update")
     * @return Response
     */
    public function putAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * Create new working_schedule
     *
     * @ApiDoc(
     *     description="Create new WorkingSchedule",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_working_schedule_create")
     */
    public function postAction()
    {
        return $this->handleCreateRequest();
    }

    /**
     * REST DELETE
     *
     * @param int $id
     *
     * @ApiDoc(
     *     description="Delete WorkingSchedule",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_working_schedule_delete")
     * @return Response
     */
    public function deleteAction($id)
    {
        return $this->handleDeleteRequest($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getManager()
    {
        return $this->get('tlt_organization_unit_working_schedule.manager.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        return $this->get('tlt_organization_unit_working_schedule.form.entity.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return $this->get('tlt_organization_unit_working_schedule.form.handler.entity.api');
    }

    /**
     * {@inheritdoc}
     */
    protected function transformEntityField($field, &$value)
    {
        switch ($field) {
            case 'owner':
                //TODO add here any other entity
            default:
                parent::transformEntityField($field, $value);
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function fixFormData(array &$data, $entity)
    {
        /** @var WorkingSchedule $entity */
        parent::fixFormData($data, $entity);

        unset($data['id']);

        return true;
    }
}