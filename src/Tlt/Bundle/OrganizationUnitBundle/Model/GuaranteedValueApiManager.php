<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 09/Oct/15
 * Time: 08:23
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;

class GuaranteedValueApiManager extends ApiEntityManager
{
    /**
     * @var GuaranteedValueManager
     */
    protected $guaranteedValueManager;

    /**
     * Constructor
     *
     * @param string $class Entity name
     * @param ObjectManager $om Object manager
     * @param GuaranteedValueManager $guaranteedValueManager
     */
    public function __construct($class, ObjectManager $om, GuaranteedValueManager $guaranteedValueManager)
    {
        $this->guaranteedValueManager = $guaranteedValueManager;
        parent::__construct($class, $om);
    }

    /**
     * {@inheritdoc}
     */
    public function createEntity()
    {
        return $this->guaranteedValueManager->createGuaranteedValue();
    }
}