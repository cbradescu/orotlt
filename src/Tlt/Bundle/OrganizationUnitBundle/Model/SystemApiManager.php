<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 07/Oct/15
 * Time: 14:01
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;

class SystemApiManager extends ApiEntityManager
{
    /**
     * @var SystemManager
     */
    protected $systemManager;

    /**
     * Constructor
     *
     * @param string $class Entity name
     * @param ObjectManager $om Object manager
     * @param SystemManager $systemManager
     */
    public function __construct($class, ObjectManager $om, SystemManager $systemManager)
    {
        $this->systemManager = $systemManager;
        parent::__construct($class, $om);
    }

    /**
     * {@inheritdoc}
     */
    public function createEntity()
    {
        return $this->systemManager->createSystem();
    }
}