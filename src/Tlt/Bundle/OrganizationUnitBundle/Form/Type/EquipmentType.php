<?php
/**
 * Created by orm-generator.
 * User: catalin
 * Date: 09/Oct/15
 * Time: 10:24
 */

namespace Tlt\Bundle\OrganizationUnitBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Oro\Bundle\SecurityBundle\SecurityFacade;

use Doctrine\ORM\EntityRepository;

class EquipmentType extends AbstractType
{
    /** @var TokenStorage */
    protected $tokenStorage;

    /** @var SecurityFacade */
    protected $securityFacade;

    /**
     * @param TokenStorage $tokenStorage
     * @param SecurityFacade $securityFacade
     */
    public function __construct(TokenStorage $tokenStorage, SecurityFacade $securityFacade)
    {
        $this->securityFacade = $securityFacade;
        $this->tokenStorage = $tokenStorage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'manufacturer',
                'text',
                [
                    'label' => 'tlt.organizationunit.equipment.manufacturer.label',
                    'required' => false
                ]
            )
            ->add(
                'model',
                'text',
                [
                    'label' => 'tlt.organizationunit.equipment.model.label',
                    'required' => false
                ]
            )
            ->add(
                'name',
                'text',
                [
                    'label' => 'tlt.organizationunit.equipment.name.label',
                    'required' => true
                ]
            )
            ->add(
                'quantity',
                'text',
                [
                    'label' => 'tlt.organizationunit.equipment.quantity.label',
                    'required' => true
                ]
            )
            ->add(
                'description',
                'textarea',
                [
                    'required' => false,
                    'label' => 'tlt.organizationunit.equipment.description.label'
                ]
            )
        ;

        if ($this->securityFacade->isGranted('tlt_organization_unit_service_type_view')) {
            $builder->
                add(
                    'serviceType',
                    'entity',
                    array(
                        'label' => 'tlt.organizationunit.equipment.service_type.label',
                        'class' => 'TltOrganizationUnitBundle:ServiceType',
                        'property' => 'name',
                        'empty_value' => 'Choose a service type',
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('st')
                                ->where('st.id IN (:serviceTypes)')
                                ->setParameter('serviceTypes', $this->tokenStorage->getToken()->getUser()->getServiceTypes());
                        },
                        'mapped' => false,
                        'required' => true
                    )
                )
            ;
        }

        $builder->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'preSetData']);
        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'preSubmit']);
    }

    /**
     * @param FormEvent $event
     */
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor = PropertyAccess::createPropertyAccessor();
        $service = $accessor->getValue($data, 'service');
//        $serviceType = ($service) ? $service->getServiceType() : $this->tokenStorage->getToken()->getUser()->getServiceTypes()->first();
        $serviceTypeId = ($service) ? $service->getServiceType()->getId() : null;

        $this->addServiceForm($form, $serviceTypeId);

    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $serviceTypeId = array_key_exists('serviceType', $data) ? $data['serviceType'] : null;
        $this->addServiceForm($form, $serviceTypeId);
    }

    private function addServiceForm(FormInterface $form, $serviceTypeId = null)
    {
        $formOptions = array(
            'label' => 'tlt.organizationunit.equipment.service.label',
            'class' => 'TltOrganizationUnitBundle:Service',
            'property' => 'name',
            'required' => true,
            'empty_value' => 'Choose a service',
            'query_builder' => function (EntityRepository $repository) use ($serviceTypeId) {
                $qb = $repository->createQueryBuilder('s')
                    ->innerJoin('s.serviceType', 'st')
                    ->where('st.id = :serviceTypeId')
                    ->setParameter('serviceTypeId', ($serviceTypeId) ? $serviceTypeId : null)
                ;

                return $qb;
            }
        );

        $form->add(
            'service',
            'entity',
            $formOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Tlt\\Bundle\\OrganizationUnitBundle\\Entity\\Equipment',
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
        return 'tlt_organization_unit_equipment';
    }

}