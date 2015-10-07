<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 15:22
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Controller\Api\Soap;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;

use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Oro\Bundle\SoapBundle\Controller\Api\Soap\SoapController;

class AnnouncerController  extends SoapController
{
    /**
     * @Soap\Method("getAnnouncers")
     * @Soap\Param("page", phpType="int")
     * @Soap\Param("limit", phpType="int")
     * @Soap\Param("order", phpType="string")
     * @Soap\Result(phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\AnnouncerSoap[]")
     * @AclAncestor("tlt_organization_unit_announcer_view")
     */
    public function cgetAction($page = 1, $limit = 10, $order = 'DESC')
    {
        $order = (strtoupper($order) == 'ASC') ? $order : 'DESC';
        return $this->handleGetListRequest($page, $limit, [], array('reportedAt' => $order));
    }

    /**
     * @Soap\Method("getannouncer")
     * @Soap\Param("id", phpType="int")
     * @Soap\Result(phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\AnnouncerSoap")
     * @AclAncestor("tlt_organization_unit_announcer_view")
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * @Soap\Method("createAnnouncer")
     * @Soap\Param("announcer", phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\AnnouncerSoap")
     * @Soap\Result(phpType="int")
     * @AclAncestor("tlt_organization_unit_announcer_create")
     */
    public function createAction()
    {
        return $this->handleCreateRequest();
    }

    /**
     * @Soap\Method("updateAnnouncer")
     * @Soap\Param("id", phpType="int")
     * @Soap\Param("announcer", phpType="Tlt\Bundle\OrganizationUnitBundle\Entity\AnnouncerSoap")
     * @Soap\Result(phpType="boolean")
     * @AclAncestor("tlt_organization_unit_announcer_update")
     */
    public function updateAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * @Soap\Method("deleteAnnouncer")
     * @Soap\Param("id", phpType="int")
     * @Soap\Result(phpType="boolean")
     * @AclAncestor("tlt_organization_unit_announcer_delete")
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
        return $this->container->get('tlt_organization_unit_announcer.manager.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        return $this->container->get('tlt_organization_unit_announcer.form.entity.api');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return $this->container->get('tlt_organization_unit_announcer.form.handler.entity.api');
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