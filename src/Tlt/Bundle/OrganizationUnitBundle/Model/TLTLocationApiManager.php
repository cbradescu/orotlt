<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 14:37
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;

class TLTLocationApiManager extends ApiEntityManager
{
    /**
     * @var TLTLocationManager
     */
    protected $tltLocationManager;

    /**
     * Constructor
     *
     * @param string $class Entity name
     * @param ObjectManager $om Object manager
     * @param TLTLocationManager $tltLocationManager
     */
    public function __construct($class, ObjectManager $om, TLTLocationManager $tltLocationManager)
    {
        $this->tltLocationManager = $tltLocationManager;
        parent::__construct($class, $om);
    }

    /**
     * {@inheritdoc}
     */
    public function createEntity()
    {
        return $this->tltLocationManager->createTLTLocation();
    }
}