<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 07/Oct/15
 * Time: 14:33
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
 *      name="tlt_organization_unit_working_schedule"
 * )
 * @ORM\HasLifecycleCallbacks()
 * @Config(
 *      routeName="tlt_organization_unit_working_schedule_index",
 *      routeView="tlt_organization_unit_working_schedule_view",
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

class WorkingSchedule
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @ConfigField(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $name;

    /**
     * @var \time
     *
     * @ORM\Column(name="min_hour", type="time")
     * @ConfigField(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $minHour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="max_hour", type="time")
     * @ConfigField(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $maxHour;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->name;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return \time
     */
    public function getMinHour()
    {
        return $this->minHour;
    }

    /**
     * @param \time $minHour
     */
    public function setMinHour($minHour)
    {
        $this->minHour = $minHour;
    }

    /**
     * @return \time
     */
    public function getMaxHour()
    {
        return $this->maxHour;
    }

    /**
     * @param \time $maxHour
     */
    public function setMaxHour($maxHour)
    {
        $this->maxHour = $maxHour;
    }
}