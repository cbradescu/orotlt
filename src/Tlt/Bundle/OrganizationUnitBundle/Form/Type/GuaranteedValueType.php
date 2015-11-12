<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 09/Oct/15
 * Time: 08:23
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Form\Type;

use Tlt\Bundle\OrganizationUnitBundle\Entity\GuaranteedValue;
use Tlt\Bundle\OrganizationUnitBundle\Entity\GuaranteedValueType as GuaranteedValueTypeEntity;
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

class GuaranteedValueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'system',
                'entity',
                array(
                    'label'       => 'tlt.organizationunit.guaranteedvalue.system.label',
                    'class'       => 'TltOrganizationUnitBundle:System',
                    'property'    => 'name',
                    'group_by'    => 'service_type',
                    'empty_value' => 'tlt.organizationunit.guaranteedvalue.form.choose_system',
                    'required'    => true
                )
            )
            ->add(
                'workingSchedule',
                'entity',
                array(
                    'label'       => 'tlt.organizationunit.guaranteedvalue.working_schedule.label',
                    'class'       => 'TltOrganizationUnitBundle:WorkingSchedule',
                    'property'    => 'name',
                    'empty_value' => 'tlt.organizationunit.guaranteedvalue.form.choose_working_schedule',
                    'required'    => true
                )
            )
            ->add(
                'value',
                'percent',
                [
                    'type' => 'fractional',
                    'scale' => 2,
                    'label' => 'tlt.organizationunit.guaranteedvalue.value.label',
                    'required' => true
                ]
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
                'data_class' => 'Tlt\\Bundle\\OrganizationUnitBundle\\Entity\\GuaranteedValue',
                'intention' => 'tlt_organization_unit_guaranteed_value_entity',
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
        return 'tlt_organization_unit_guaranteed_value';
    }

}