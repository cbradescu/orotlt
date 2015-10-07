<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 13:46
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;

class TELEntityApiManager extends ApiEntityManager
{
    /**
     * @var TELEntityManager
     */
    protected $telEntityManager;

    /**
     * Constructor
     *
     * @param string $class Entity name
     * @param ObjectManager $om Object manager
     * @param TELEntityManager $telEntityManager
     */
    public function __construct($class, ObjectManager $om, TELEntityManager $telEntityManager)
    {
        $this->telEntityManager = $telEntityManager;
        parent::__construct($class, $om);
    }

    /**
     * {@inheritdoc}
     */
    public function createEntity()
    {
        return $this->telEntityManager->createTELEntity();
    }
}