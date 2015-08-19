<?php
    namespace Back\ProgrammeBundle\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolverInterface;

    class PeriodeType extends AbstractType
    {
        /**
         * @param FormBuilderInterface $builder
         * @param array $options
         */
        public function buildForm(FormBuilderInterface $builder,array $options)
        {
            $builder
                ->add('libelle')
                ->add('depart','date',array(
                    'required' => FALSE,
                    'widget'   => 'single_text',
                    'format'   => 'yyyy-MM-dd',
                ))
                ->add('retour','date',array(
                    'required' => FALSE,
                    'widget'   => 'single_text',
                    'format'   => 'yyyy-MM-dd',
                ))
                ->add('min')
                ->add('max')
                ->add('debutInscription','date',array(
                    'required' => FALSE,
                    'widget'   => 'single_text',
                    'format'   => 'yyyy-MM-dd',
                ))
                ->add('finInscription','date',array(
                    'required' => FALSE,
                    'widget'   => 'single_text',
                    'format'   => 'yyyy-MM-dd',
                ))
                ->add('nombreInscriptionInitiale')
                ->add('prix');
        }

        /**
         * @param OptionsResolverInterface $resolver
         */
        public function setDefaultOptions(OptionsResolverInterface $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => 'Back\ProgrammeBundle\Entity\Periode',
            ));
        }

        /**
         * @return string
         */
        public function getName()
        {
            return 'back_programmebundle_periode';
        }
    }
