<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 13:46
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\DataAuditBundle\Metadata\Annotation as Oro;
use Oro\Bundle\OrganizationBundle\Entity\BusinessUnit;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\UserBundle\Entity\User;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

/**
 * @ORM\Entity
 * @ORM\Table(
 *      name="tlt_organization_unit_tlt_location"
 * )
 * @ORM\Entity(repositoryClass="Tlt\Bundle\OrganizationUnitBundle\Entity\Repository\TLTLocationRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Oro\Loggable
 * @Config(
 *      routeName="tlt_organization_unit_tlt_location_index",
 *      routeView="tlt_organization_unit_tlt_location_view",
 *      defaultValues={
 *          "dataaudit"={
 *              "auditable"=true
 *          },
 *          "entity"={
 *              "icon"="icon-list-alt"
 *          },
 *          "ownership"={
 *              "owner_type"="BUSINESS_UNIT",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="business_unit_owner_id",
 *              "organization_field_name"="organization",
 *              "organization_column_name"="organization_id"
 *          },
 *          "security"={
 *              "type"="ACL"
 *          }
 *      }
 * )
 */

class TLTLocation
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
     * @var BusinessUnit
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\OrganizationBundle\Entity\BusinessUnit", cascade={"persist"})
     * @ORM\JoinColumn(name="business_unit_owner_id", referencedColumnName="id", onDelete="SET NULL")
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "excluded"=true
     *          }
     *      }
     * )
     */
    protected $owner;

    /**
     * @var Organization
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\OrganizationBundle\Entity\Organization")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $organization;

//    /**
//     * @var TLTEntity
//     *
//     * @ORM\ManyToOne(targetEntity="Tlt\Bundle\OrganizationUnitBundle\Entity\TLTEntity")
//     * @ORM\JoinColumn(name="tlt_entity_id", referencedColumnName="id", onDelete="SET NULL")
//     * @ConfigField(
//     *      defaultValues={
//     *          "dataaudit"={
//     *              "auditable"=true
//     *          }
//     *      }
//     * )
//     */
//    protected $tltEntity;

    /**
     * @var GeneralLocation
     *
     * @ORM\ManyToOne(targetEntity="Tlt\Bundle\OrganizationUnitBundle\Entity\GeneralLocation")
     * @ORM\JoinColumn(name="general_location_id", referencedColumnName="id", onDelete="SET NULL")
     * @ConfigField(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    protected $generalLocation;


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
     * @param BusinessUnit $owningBusinessUnit
     */
    public function setOwner($owningBusinessUnit)
    {
        $this->owner = $owningBusinessUnit;
    }

    /**
     * @return BusinessUnit
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param Organization $organization
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    /**
     * @return Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

//    /**
//     * @return TLTEntity
//     */
//    public function getTltEntity()
//    {
//        return $this->tltEntity;
//    }
//
//    /**
//     * @param TLTEntity $tltEntity
//     */
//    public function setTltEntity($tltEntity)
//    {
//        $this->tltEntity = $tltEntity;
//    }

    /**
     * @return GeneralLocation
     */
    public function getGeneralLocation()
    {
        return $this->generalLocation;
    }

    /**
     * @param GeneralLocation $generalLocation
     */
    public function setGeneralLocation($generalLocation)
    {
        $this->generalLocation = $generalLocation;
    }
}