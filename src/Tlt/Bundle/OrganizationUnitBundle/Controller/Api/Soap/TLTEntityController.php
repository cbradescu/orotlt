<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 14:12
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Controller\Api\Soap;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;

use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Oro\Bundle\SoapBundle\Controller\Api\Soap\SoapController;

class TLTEntityController  extends SoapController
{
    /**
     * @Soap\Method("getTLTEntities")
     * @Soap\Param("page", phpType="int")
     * @Soap\Param("limit", phpType="int")
     * @Soap\Param("order", phpType="string")
     * @Soap\Result(phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\TLTEntitySoap[]")
     * @AclAncestor("tlt_organization_unit_tlt_entity_view")
     */
    public function cgetAction($page = 1, $limit = 10, $order = 'DESC')
    {
        $order = (strtoupper($order) == 'ASC') ? $order : 'DESC';
        return $this->handleGetListRequest($page, $limit, [], array('reportedAt' => $order));
    }

    /**
     * @Soap\Method("gettlt_entity")
     * @Soap\Param("id", phpType="int")
     * @Soap\Result(phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\TLTEntitySoap")
     * @AclAncestor("tlt_organization_unit_tlt_entity_view")
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * @Soap\Method("createTLTEntity")
     * @Soap\Param("tlt_entity", phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\TLTEntitySoap")
     * @Soap\Result(phpType="int")
     * @AclAncestor("tlt_organization_unit_tlt_entity_create")
     */
    public function createAction()
    {
        return $this->handleCreateRequest();
    }

    /**
     * @Soap\Method("updateTLTEntity")
     * @Soap\Param("id", phpType="int")
     * @Soap\Param("tlt_entity", phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\TLTEntitySoap")
     * @Soap\Result(phpType="boolean")
     * @AclAncestor("tlt_organization_unit_tlt_entity_update")
     */
    public function updateAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * @Soap\Method("deleteTLTEntity")
     * @Soap\Param("id", phpType="int")
     * @Soap\Result(phpType="boolean")
     * @AclAncestor("tlt_organization_unit_tlt_entity_delete")
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
        return $this->container->get('tlt_organization_unit_tlt_entity.manager.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        return $this->container->get('tlt_organization_unit_tlt_entity.form.entity.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return $this->container->get('tlt_organization_unit_tlt_entity.form.handler.entity.api');
    }

    /**
     * {@inheritDoc}
     */
    protected function fixFormData(array &$data, $entity)
    {
        parent::fixFormData($data, $entity);

        unset($data['id']);
        unset($data['createdAt']);
        unset($data['updatedAt']);

        return true;
    }

}