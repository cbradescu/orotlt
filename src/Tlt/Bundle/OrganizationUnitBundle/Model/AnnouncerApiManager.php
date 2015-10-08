<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 15:22
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;

class AnnouncerApiManager extends ApiEntityManager
{
    /**
     * @var AnnouncerManager
     */
    protected $announcerManager;

    /**
     * Constructor
     *
     * @param string $class Entity name
     * @param ObjectManager $om Object manager
     * @param AnnouncerManager $announcerManager
     */
    public function __construct($class, ObjectManager $om, AnnouncerManager $announcerManager)
    {
        $this->announcerManager = $announcerManager;
        parent::__construct($class, $om);
    }

    /**
     * {@inheritdoc}
     */
    public function createEntity()
    {
        return $this->announcerManager->createAnnouncer();
    }
}