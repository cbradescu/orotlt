<?php

namespace Tlt\Bundle\OrganizationUnitBundle\Migrations\Schema\v1_0;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;


class ExtendUserEntity implements Migration, ExtendExtensionAwareInterface
{
    /** @var ExtendExtension */
    protected $extendExtension;

    /**
     * {@inheritdoc}
     */
    public function setExtendExtension(ExtendExtension $extendExtension)
    {
        $this->extendExtension = $extendExtension;
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $schema->getTable(
            'tlt_organization_unit_service_type'
        );

        $this->extendExtension->addManyToManyRelation(
            $schema,
            $schema->getTable('oro_user'),
            'service_types',
            $table,
            ['name'],
            ['name'],
            ['name'],
            [
                'extend' => [
                    'without_default' => true,
                    'is_extend' => true,
                    'owner' => ExtendScope::OWNER_CUSTOM
                ]
            ]
        );
    }
}