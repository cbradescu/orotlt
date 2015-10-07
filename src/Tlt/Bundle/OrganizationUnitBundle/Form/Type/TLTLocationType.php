<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 14:24
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Form\Type;

use Tlt\Bundle\OrganizationUnitBundle\Entity\TLTLocation;
use Tlt\Bundle\OrganizationUnitBundle\Entity\TLTLocationType as TLTLocationTypeEntity;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;

use Oro\Bundle\LocaleBundle\Formatter\NameFormatter;
use Oro\Bundle\SecurityBundle\SecurityFacade;
use Oro\Bundle\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Routing\Router;

class TLTLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'tltEntity',
                'entity',
                array(
                    'label'       => 'tlt.organizationunit.tltlocation.tlt_entity.label',
                    'class'       => 'TltOrganizationUnitBundle:TLTEntity',
                    'property'    => 'name',
                    'empty_value' => 'tlt.organizationunit.tltlocation.form.choose_tlt_entity',
                    'required'    => true
                )
            )
            ->add(
                'generalLocation',
                'entity',
                array(
                    'label'       => 'tlt.organizationunit.tltlocation.general_location.label',
                    'class'       => 'TltOrganizationUnitBundle:GeneralLocation',
                    'property'    => 'name',
                    'empty_value' => 'tlt.organizationunit.tltlocation.form.choose_general_location',
                    'required'    => true
                )
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Tlt\\Bundle\\OrganizationUnitBundle\\Entity\\TLTLocation',
                'intention' => 'tlt_organization_unit_tlt_location_entity',
                'cascade_validation' => true,
                'ownership_disabled' => true
            ]
        );
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'tlt_organization_unit_tlt_location';
    }

}