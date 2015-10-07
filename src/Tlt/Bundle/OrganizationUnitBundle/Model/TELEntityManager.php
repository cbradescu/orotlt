<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 13:46
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Tlt\Bundle\OrganizationUnitBundle\Entity\TELEntity;
use Doctrine\ORM\EntityManager;

use Oro\Bundle\SecurityBundle\ORM\Walker\AclHelper;

class TELEntityManager
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
     * @return TELEntity
     */
    public function createTELEntity()
    {
        return $this->createTELEntityObject();
    }

    /**
     * @return TELEntity
     */
    protected function createTELEntityObject()
    {
        return new TELEntity();
    }
}