<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 07/Oct/15
 * Time: 14:33
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Form\Type;

use Tlt\Bundle\OrganizationUnitBundle\Entity\WorkingSchedule;
use Tlt\Bundle\OrganizationUnitBundle\Entity\WorkingScheduleType as WorkingScheduleTypeEntity;
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

class WorkingScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                'text',
                [
                    'label' => 'tlt.organizationunit.workingschedule.name.label',
                    'required' => true
                ]
            )
            ->add(
                'minHour',
                'time',
                [
                    'model_timezone' => 'UTC',
                    'view_timezone' => 'UTC',
                    'with_seconds' => true,
                    'widget' => 'choice',
                    'required' => true,
                    'label'    => 'tlt.organizationunit.workingschedule.min_hour.label',
                ]
            )
            ->add(
                'maxHour',
                'time',
                [
                    'model_timezone' => 'UTC',
                    'view_timezone' => 'UTC',
                    'with_seconds' => true,
                    'widget' => 'choice',
                    'required' => true,
                    'label'    => 'tlt.organizationunit.workingschedule.max_hour.label',
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
                'data_class' => 'Tlt\\Bundle\\OrganizationUnitBundle\\Entity\\WorkingSchedule',
                'intention' => 'tlt_organization_unit_working_schedule_entity',
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
        return 'tlt_organization_unit_working_schedule';
    }

}