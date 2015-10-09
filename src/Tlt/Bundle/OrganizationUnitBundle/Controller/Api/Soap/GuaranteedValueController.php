<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 09/Oct/15
 * Time: 08:23
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Controller\Api\Soap;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;

use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Oro\Bundle\SoapBundle\Controller\Api\Soap\SoapController;

class GuaranteedValueController  extends SoapController
{
    /**
     * @Soap\Method("getGuaranteedValues")
     * @Soap\Param("page", phpType="int")
     * @Soap\Param("limit", phpType="int")
     * @Soap\Param("order", phpType="string")
     * @Soap\Result(phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\GuaranteedValueSoap[]")
     * @AclAncestor("tlt_organization_unit_guaranteed_value_view")
     */
    public function cgetAction($page = 1, $limit = 10, $order = 'DESC')
    {
        $order = (strtoupper($order) == 'ASC') ? $order : 'DESC';
        return $this->handleGetListRequest($page, $limit, [], array('reportedAt' => $order));
    }

    /**
     * @Soap\Method("getguaranteed_value")
     * @Soap\Param("id", phpType="int")
     * @Soap\Result(phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\GuaranteedValueSoap")
     * @AclAncestor("tlt_organization_unit_guaranteed_value_view")
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * @Soap\Method("createGuaranteedValue")
     * @Soap\Param("guaranteed_value", phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\GuaranteedValueSoap")
     * @Soap\Result(phpType="int")
     * @AclAncestor("tlt_organization_unit_guaranteed_value_create")
     */
    public function createAction()
    {
        return $this->handleCreateRequest();
    }

    /**
     * @Soap\Method("updateGuaranteedValue")
     * @Soap\Param("id", phpType="int")
     * @Soap\Param("guaranteed_value", phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\GuaranteedValueSoap")
     * @Soap\Result(phpType="boolean")
     * @AclAncestor("tlt_organization_unit_guaranteed_value_update")
     */
    public function updateAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * @Soap\Method("deleteGuaranteedValue")
     * @Soap\Param("id", phpType="int")
     * @Soap\Result(phpType="boolean")
     * @AclAncestor("tlt_organization_unit_guaranteed_value_delete")
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
        return $this->container->get('tlt_organization_unit_guaranteed_value.manager.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        return $this->container->get('tlt_organization_unit_guaranteed_value.form.entity.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return $this->container->get('tlt_organization_unit_guaranteed_value.form.handler.entity.api');
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