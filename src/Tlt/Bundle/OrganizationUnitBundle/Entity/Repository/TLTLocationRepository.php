<?php

namespace Tlt\Bundle\OrganizationUnitBundle\Entity\Repository;

use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

use Oro\Bundle\OrganizationBundle\Entity\BusinessUnit;
use Tlt\Bundle\OrganizationUnitBundle\Entity\TLTLocation;

class TLTLocationRepository extends EntityRepository
{
    /**
     * @param BusinessUnit $businessUnit
     * @return QueryBuilder
     */
    public function getBusinessUnitTLTLocationsQueryBuilder(BusinessUnit $businessUnit)
    {
        return $this->createQueryBuilder('tl')
            ->select(array('tl.id', 'gl.name as generalLocation'))
            ->where('tl.owner = :businessUnit')
            ->leftJoin('tl.generalLocation', 'gl')
            ->orderBy('gl.name', 'ASC')
            ->setParameter('businessUnit', $businessUnit);
    }

    /**
     * @param BusinessUnit $businessUnit
     * @return TLTLocation[]
     */
    public function getBusinessUnitTLTLocations(BusinessUnit $businessUnit)
    {
        $query = $this->getBusinessUnitTLTLocationsQueryBuilder($businessUnit)->getQuery();
        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->execute();
    }
}