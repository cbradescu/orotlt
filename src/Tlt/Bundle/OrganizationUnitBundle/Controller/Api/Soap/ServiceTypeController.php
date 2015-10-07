<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 02/Oct/15
 * Time: 11:51
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Controller\Api\Soap;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;

use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Oro\Bundle\SoapBundle\Controller\Api\Soap\SoapController;

class ServiceTypeController  extends SoapController
{
    /**
     * @Soap\Method("getServiceTypes")
     * @Soap\Param("page", phpType="int")
     * @Soap\Param("limit", phpType="int")
     * @Soap\Param("order", phpType="string")
     * @Soap\Result(phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\ServiceTypeSoap[]")
     * @AclAncestor("tlt_organization_unit_service_type_view")
     */
    public function cgetAction($page = 1, $limit = 10, $order = 'DESC')
    {
        $order = (strtoupper($order) == 'ASC') ? $order : 'DESC';
        return $this->handleGetListRequest($page, $limit, [], array('reportedAt' => $order));
    }

    /**
     * @Soap\Method("getservice_type")
     * @Soap\Param("id", phpType="int")
     * @Soap\Result(phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\ServiceTypeSoap")
     * @AclAncestor("tlt_organization_unit_service_type_view")
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * @Soap\Method("createServiceType")
     * @Soap\Param("service_type", phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\ServiceTypeSoap")
     * @Soap\Result(phpType="int")
     * @AclAncestor("tlt_organization_unit_service_type_create")
     */
    public function createAction()
    {
        return $this->handleCreateRequest();
    }

    /**
     * @Soap\Method("updateServiceType")
     * @Soap\Param("id", phpType="int")
     * @Soap\Param("service_type", phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\ServiceTypeSoap")
     * @Soap\Result(phpType="boolean")
     * @AclAncestor("tlt_organization_unit_service_type_update")
     */
    public function updateAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * @Soap\Method("deleteServiceType")
     * @Soap\Param("id", phpType="int")
     * @Soap\Result(phpType="boolean")
     * @AclAncestor("tlt_organization_unit_service_type_delete")
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
        return $this->container->get('tlt_organization_unit_service_type.manager.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        return $this->container->get('tlt_organization_unit_service_type.form.entity.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return $this->container->get('tlt_organization_unit_service_type.form.handler.entity.api');
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