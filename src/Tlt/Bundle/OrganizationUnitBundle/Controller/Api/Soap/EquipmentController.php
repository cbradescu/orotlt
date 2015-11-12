<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 09/Oct/15
 * Time: 10:24
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Controller\Api\Soap;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;

use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Oro\Bundle\SoapBundle\Controller\Api\Soap\SoapController;

class EquipmentController  extends SoapController
{
    /**
     * @Soap\Method("getEquipments")
     * @Soap\Param("page", phpType="int")
     * @Soap\Param("limit", phpType="int")
     * @Soap\Param("order", phpType="string")
     * @Soap\Result(phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\EquipmentSoap[]")
     * @AclAncestor("tlt_organization_unit_equipment_view")
     */
    public function cgetAction($page = 1, $limit = 10, $order = 'DESC')
    {
        $order = (strtoupper($order) == 'ASC') ? $order : 'DESC';
        return $this->handleGetListRequest($page, $limit, [], array('reportedAt' => $order));
    }

    /**
     * @Soap\Method("getequipment")
     * @Soap\Param("id", phpType="int")
     * @Soap\Result(phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\EquipmentSoap")
     * @AclAncestor("tlt_organization_unit_equipment_view")
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * @Soap\Method("createEquipment")
     * @Soap\Param("equipment", phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\EquipmentSoap")
     * @Soap\Result(phpType="int")
     * @AclAncestor("tlt_organization_unit_equipment_create")
     */
    public function createAction()
    {
        return $this->handleCreateRequest();
    }

    /**
     * @Soap\Method("updateEquipment")
     * @Soap\Param("id", phpType="int")
     * @Soap\Param("equipment", phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\EquipmentSoap")
     * @Soap\Result(phpType="boolean")
     * @AclAncestor("tlt_organization_unit_equipment_update")
     */
    public function updateAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * @Soap\Method("deleteEquipment")
     * @Soap\Param("id", phpType="int")
     * @Soap\Result(phpType="boolean")
     * @AclAncestor("tlt_organization_unit_equipment_delete")
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
        return $this->container->get('tlt_organization_unit_equipment.manager.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        return $this->container->get('tlt_organization_unit_equipment.form.entity.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return $this->container->get('tlt_organization_unit_equipment.form.handler.entity.api');
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