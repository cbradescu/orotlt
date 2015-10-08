<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 14:24
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;

class GeneralLocationApiManager extends ApiEntityManager
{
    /**
     * @var GeneralLocationManager
     */
    protected $generalLocationManager;

    /**
     * Constructor
     *
     * @param string $class Entity name
     * @param ObjectManager $om Object manager
     * @param GeneralLocationManager $generalLocationManager
     */
    public function __construct($class, ObjectManager $om, GeneralLocationManager $generalLocationManager)
    {
        $this->generalLocationManager = $generalLocationManager;
        parent::__construct($class, $om);
    }

    /**
     * {@inheritdoc}
     */
    public function createEntity()
    {
        return $this->generalLocationManager->createGeneralLocation();
    }
}