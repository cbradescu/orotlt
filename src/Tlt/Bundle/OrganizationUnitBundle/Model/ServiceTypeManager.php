<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 02/Oct/15
 * Time: 11:51
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Tlt\Bundle\OrganizationUnitBundle\Entity\ServiceType;
use Doctrine\ORM\EntityManager;

use Oro\Bundle\SecurityBundle\ORM\Walker\AclHelper;

class ServiceTypeManager
{
    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var AclHelper
     */
    protected $aclHelper;

    /**
     * @param EntityManager $entityManager
     * @param AclHelper $aclHelper
     */
    public function __construct(
        EntityManager $entityManager,
        AclHelper $aclHelper
    )
    {
        $this->entityManager = $entityManager;
        $this->aclHelper = $aclHelper;
    }

    /**
     * @return ServiceType
     */
    public function createServiceType()
    {
        return $this->createServiceTypeObject();
    }

    /**
     * @return ServiceType
     */
    protected function createServiceTypeObject()
    {
        return new ServiceType();
    }
}