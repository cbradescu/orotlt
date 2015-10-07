<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 02/Oct/15
 * Time: 11:51
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Form\Type;

use Tlt\Bundle\OrganizationUnitBundle\Entity\ServiceType;
use Tlt\Bundle\OrganizationUnitBundle\Entity\ServiceTypeType as ServiceTypeTypeEntity;
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

class ServiceTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                'text',
                [
                    'label' => 'tlt.organizationunit.servicetype.name.label',
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
                'data_class' => 'Tlt\Bundle\OrganizationUnitBundle\Entity\ServiceType',
                'intention' => 'tlt_organization_unit_service_type_entity',
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
        return 'tlt_organization_unit_service_type';
    }

}