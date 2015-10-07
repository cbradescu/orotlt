<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 15:22
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Controller\Api\Rest;

use Tlt\Bundle\OrganizationUnitBundle\Entity\Announcer;
use Symfony\Component\HttpFoundation\Response;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;

use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;

/**
 * @Rest\RouteResource("announcer")
 * @Rest\NamePrefix("tlt_organization_unit_announcer_api_")
 */
class AnnouncerController extends RestController implements ClassResourceInterface
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
     *     description="Get all Announcer items",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_announcer_view")
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
     *     description="Get Announcer item",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_announcer_view")
     * @return Response
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * REST PUT
     *
     * @param int $id Announcer item id
     *
     * @ApiDoc(
     *     description="Update Announcer",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_announcer_update")
     * @return Response
     */
    public function putAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * Create new announcer
     *
     * @ApiDoc(
     *     description="Create new Announcer",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_announcer_create")
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
     *     description="Delete Announcer",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_announcer_delete")
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
        return $this->get('tlt_organization_unit_announcer.manager.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        return $this->get('tlt_organization_unit_announcer.form.entity.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return $this->get('tlt_organization_unit_announcer.form.handler.entity.api');
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
        /** @var Announcer $entity */
        parent::fixFormData($data, $entity);

        unset($data['id']);

        return true;
    }
}