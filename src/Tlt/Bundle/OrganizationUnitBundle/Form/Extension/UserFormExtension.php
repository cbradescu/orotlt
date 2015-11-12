<?php

namespace Tlt\Bundle\OrganizationUnitBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

class UserFormExtension extends AbstractTypeExtension
{

    /**
     * build the orocrm_account form
     * since you're listing (in this case) to a specific form (orocrm_account)
     * you can modify it to your own extend.
     *
     * In this case I wanted custom (many-to-one) fields being placed in the general
     * section and use the oro_user_select since it looks better in the frontend than
     * the oro_entity_select field type.
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        //check if your custom field exists.
        if($builder->has('service_types')) {
            //remove your custom field.
            $builder->remove('service_types');
        }

        /**
         * add the custom fields to the "general section of the Organization form"
         * use the normal $builder->add() like you would with any form
         */
        $builder->add(
            'service_types',
            'entity',
            array(
                'label'         => 'tlt.organizationunit.servicetype.entity_label',
                'class'         => 'TltOrganizationUnitBundle:ServiceType',
                'property'      => 'name',
                'multiple'      => true,
                'expanded'      => true,
                'required'      => true
            )
        );
    }

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return 'oro_user_user';
    }
}