<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 07/Oct/15
 * Time: 14:33
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;

class WorkingScheduleApiManager extends ApiEntityManager
{
    /**
     * @var WorkingScheduleManager
     */
    protected $workingScheduleManager;

    /**
     * Constructor
     *
     * @param string $class Entity name
     * @param ObjectManager $om Object manager
     * @param WorkingScheduleManager $workingScheduleManager
     */
    public function __construct($class, ObjectManager $om, WorkingScheduleManager $workingScheduleManager)
    {
        $this->workingScheduleManager = $workingScheduleManager;
        parent::__construct($class, $om);
    }

    /**
     * {@inheritdoc}
     */
    public function createEntity()
    {
        return $this->workingScheduleManager->createWorkingSchedule();
    }
}