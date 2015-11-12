<?php

namespace Tlt\Bundle\OrganizationUnitBundle\Entity\Repository;

use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

use Oro\Bundle\AddressBundle\Entity\Country;
use Oro\Bundle\AddressBundle\Entity\Region;
use Tlt\Bundle\OrganizationUnitBundle\Entity\ServiceType;

class ServiceRepository extends EntityRepository
{
    /**
     * @param ServiceType $serviceType
     * @return QueryBuilder
     */
    public function getServiceTypeServicesQueryBuilder(ServiceType $serviceType)
    {
        return $this->createQueryBuilder('s')
            ->where('s.serviceType = :serviceType')
            ->orderBy('s.name', 'ASC')
            ->setParameter('serviceType', $serviceType);
    }

    /**
     * @param ServiceType $serviceType
     * @return Service[]
     */
    public function getServiceTypeServices(ServiceType $serviceType)
    {
        $query = $this->getServiceTypeServicesQueryBuilder($serviceType)->getQuery();
        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->execute();
    }
}
