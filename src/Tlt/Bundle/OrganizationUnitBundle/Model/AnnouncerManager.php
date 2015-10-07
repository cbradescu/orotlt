<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 15:22
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Tlt\Bundle\OrganizationUnitBundle\Entity\Announcer;
use Doctrine\ORM\EntityManager;

use Oro\Bundle\SecurityBundle\ORM\Walker\AclHelper;

class AnnouncerManager
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
     * @return Announcer
     */
    public function createAnnouncer()
    {
        return $this->createAnnouncerObject();
    }

    /**
     * @return Announcer
     */
    protected function createAnnouncerObject()
    {
        return new Announcer();
    }
}