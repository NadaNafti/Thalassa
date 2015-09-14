<?php
    namespace Back\HotelTunisieBundle\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolverInterface;

    class SaisonFraisChambreType extends AbstractType
    {
        /**
         * @param FormBuilderInterface $builder
         * @param array $options
         */
        public function buildForm(FormBuilderInterface $builder,array $options)
        {
            $builder
                ->add('lignes', 'collection', array('type'=>new SaisonFraisChambreLigneType()));
            //->add('saison')
            //->add('chambre');
        }

        /**
         * @param OptionsResolverInterface $resolver
         */
        public function setDefaultOptions(OptionsResolverInterface $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => 'Back\HotelTunisieBundle\Entity\SaisonFraisChambre',
            ));
        }

        /**
         * @return string
         */
        public function getName()
        {
            return 'back_hoteltunisiebundle_saisonfraischambre';
        }
    }
