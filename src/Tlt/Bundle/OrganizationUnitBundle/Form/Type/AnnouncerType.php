<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 06/Oct/15
 * Time: 15:22
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Form\Type;

use Tlt\Bundle\OrganizationUnitBundle\Entity\Announcer;
use Tlt\Bundle\OrganizationUnitBundle\Entity\AnnouncerType as AnnouncerTypeEntity;
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

class AnnouncerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'enabled',
                'choice',
                [
                    'required' => true,
                    'label'    => 'tlt.organizationunit.announcer.enabled.label',
                    'choices'  => [1 => 'Active', 0 => 'Inactive']
                ]
            )
            ->add(
                'tltEntity',
                'entity',
                array(
                    'label'       => 'tlt.organizationunit.announcer.tlt_entity.label',
                    'class'       => 'TltOrganizationUnitBundle:TLTEntity',
                    'property'    => 'name',
                    'empty_value' => 'tlt.organizationunit.announcer.form.choose_tlt_entity',
                    'required'    => true
                )
            )
            ->add(
                'firstName',
                'text',
                [
                    'label' => 'tlt.organizationunit.announcer.firstname.label',
                    'required' => true
                ]
            )
            ->add(
                'lastName',
                'text',
                [
                    'label' => 'tlt.organizationunit.announcer.lastname.label',
                    'required' => true
                ]
            )
            ->add(
                'compartment',
                'text',
                [
                    'label' => 'tlt.organizationunit.announcer.compartment.label',
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
                'data_class' => 'Tlt\\Bundle\\OrganizationUnitBundle\\Entity\\Announcer',
                'intention' => 'tlt_organization_unit_announcer_entity',
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
        return 'tlt_organization_unit_announcer';
    }

}