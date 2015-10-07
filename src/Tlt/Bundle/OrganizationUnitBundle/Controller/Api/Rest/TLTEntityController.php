<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 14:12
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Controller\Api\Rest;

use Tlt\Bundle\OrganizationUnitBundle\Entity\TLTEntity;
use Symfony\Component\HttpFoundation\Response;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;

use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;

/**
 * @Rest\RouteResource("tlt_entity")
 * @Rest\NamePrefix("tlt_organization_unit_tlt_entity_api_")
 */
class TLTEntityController extends RestController implements ClassResourceInterface
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
     *     description="Get all TLTEntity items",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_tlt_entity_view")
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
     *     description="Get TLTEntity item",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_tlt_entity_view")
     * @return Response
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * REST PUT
     *
     * @param int $id TLTEntity item id
     *
     * @ApiDoc(
     *     description="Update TLTEntity",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_tlt_entity_update")
     * @return Response
     */
    public function putAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * Create new tlt_entity
     *
     * @ApiDoc(
     *     description="Create new TLTEntity",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_tlt_entity_create")
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
     *     description="Delete TLTEntity",
     *     resource=true
     * )
     * @AclAncestor("tlt_organization_unit_tlt_entity_delete")
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
        return $this->get('tlt_organization_unit_tlt_entity.manager.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        return $this->get('tlt_organization_unit_tlt_entity.form.entity.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return $this->get('tlt_organization_unit_tlt_entity.form.handler.entity.api');
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
        /** @var TLTEntity $entity */
        parent::fixFormData($data, $entity);

        unset($data['id']);

        return true;
    }
}