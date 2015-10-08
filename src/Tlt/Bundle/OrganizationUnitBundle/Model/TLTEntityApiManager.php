<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 14:12
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;

class TLTEntityApiManager extends ApiEntityManager
{
    /**
     * @var TLTEntityManager
     */
    protected $tltEntityManager;

    /**
     * Constructor
     *
     * @param string $class Entity name
     * @param ObjectManager $om Object manager
     * @param TLTEntityManager $tltEntityManager
     */
    public function __construct($class, ObjectManager $om, TLTEntityManager $tltEntityManager)
    {
        $this->tltEntityManager = $tltEntityManager;
        parent::__construct($class, $om);
    }

    /**
     * {@inheritdoc}
     */
    public function createEntity()
    {
        return $this->tltEntityManager->createTLTEntity();
    }
}