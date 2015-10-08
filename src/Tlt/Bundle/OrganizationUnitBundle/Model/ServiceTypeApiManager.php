<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 02/Oct/15
 * Time: 11:51
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;

class ServiceTypeApiManager extends ApiEntityManager
{
    /**
     * @var ServiceTypeManager
     */
    protected $serviceTypeManager;

    /**
     * Constructor
     *
     * @param string $class Entity name
     * @param ObjectManager $om Object manager
     * @param ServiceTypeManager $serviceTypeManager
     */
    public function __construct($class, ObjectManager $om, ServiceTypeManager $serviceTypeManager)
    {
        $this->service_typeManager = $serviceTypeManager;
        parent::__construct($class, $om);
    }

    /**
     * {@inheritdoc}
     */
    public function createEntity()
    {
        return $this->service_typeManager->createServiceType();
    }
}