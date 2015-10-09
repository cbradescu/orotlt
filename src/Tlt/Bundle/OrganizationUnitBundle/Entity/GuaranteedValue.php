<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 09/Oct/15
 * Time: 08:23
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\DataAuditBundle\Metadata\Annotation as Oro;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

/**
 * @ORM\Entity
 * @ORM\Table(
 *      name="tlt_organization_unit_guaranteed_value"
 * )
 * @ORM\HasLifecycleCallbacks()
 * @Oro\Loggable
 * @Config(
 *      routeName="tlt_organization_unit_guaranteed_value_index",
 *      routeView="tlt_organization_unit_guaranteed_value_view",
 *      defaultValues={
 *          "dataaudit"={
 *              "auditable"=true
 *          },
 *          "entity"={
 *              "icon"="icon-list-alt"
 *          },
 *          "ownership"={
 *              "owner_type"="ORGANIZATION",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="organization_id",
 *          },
 *          "security"={
 *              "type"="ACL"
 *          }
 *      }
 * )
 */

class GuaranteedValue
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ConfigField(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $id;

    /**
     * @var Organization
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\OrganizationBundle\Entity\Organization")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $owner;

    /**
     * @var System
     *
     * @ORM\ManyToOne(targetEntity="Tlt\Bundle\OrganizationUnitBundle\Entity\System")
     * @ORM\JoinColumn(name="system_id", referencedColumnName="id", onDelete="SET NULL")
     * @ConfigField(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $system;

    /**
     * @var WorkingSchedule
     *
     * @ORM\ManyToOne(targetEntity="Tlt\Bundle\OrganizationUnitBundle\Entity\WorkingSchedule")
     * @ORM\JoinColumn(name="working_schedule_id", referencedColumnName="id", onDelete="SET NULL")
     * @ConfigField(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $workingSchedule;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=5, scale=4)
     * @ConfigField(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $value;


    /**
     * @return string
     */
    public function __toString()
    {
        //return (string)$this->name;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Organization $organization
     */
    public function setOwner($organization)
    {
        $this->owner = $organization;
    }

    /**
     * @return Organization
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @return System
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * @param System $system
     */
    public function setSystem($system)
    {
        $this->system = $system;
    }

    /**
     * @return ServiceType
     */
    public function getWorkingSchedule()
    {
        return $this->workingSchedule;
    }

    /**
     * @param ServiceType $workingSchedule
     */
    public function setWorkingSchedule($workingSchedule)
    {
        $this->workingSchedule = $workingSchedule;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}