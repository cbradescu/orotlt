<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 11:39
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Tlt\Bundle\OrganizationUnitBundle\Entity\Service;
use Doctrine\ORM\EntityManager;

use Oro\Bundle\SecurityBundle\ORM\Walker\AclHelper;

class ServiceManager
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
     * @return Service
     */
    public function createService()
    {
        return $this->createServiceObject();
    }

    /**
     * @return Service
     */
    protected function createServiceObject()
    {
        return new Service();
    }
}