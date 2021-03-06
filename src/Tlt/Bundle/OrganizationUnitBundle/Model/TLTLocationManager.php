<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 14:37
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Tlt\Bundle\OrganizationUnitBundle\Entity\TLTLocation;
use Doctrine\ORM\EntityManager;

use Oro\Bundle\SecurityBundle\ORM\Walker\AclHelper;

class TLTLocationManager
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
     * @return TLTLocation
     */
    public function createTLTLocation()
    {
        return $this->createTLTLocationObject();
    }

    /**
     * @return TLTLocation
     */
    protected function createTLTLocationObject()
    {
        return new TLTLocation();
    }
}