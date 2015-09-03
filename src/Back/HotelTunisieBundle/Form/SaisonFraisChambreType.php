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
                ->add('valeur1Adulte')
                ->add('marge1Adulte')
                ->add('margePourc1Adulte','checkbox',array(
                    'label'    => 'En pourcentage',
                    'required' => FALSE,
                ))
                ->add('reduction1Enf1Adulte')
                ->add('reduction2Enf1Adulte')
                ->add('valeur2Adulte')
                ->add('marge2Adulte')
                ->add('margePourc2Adulte','checkbox',array(
                    'label'    => 'En pourcentage',
                    'required' => FALSE,
                ))
                ->add('reduction1Enf2Adulte')
                ->add('reduction2Enf2Adulte')
                ->add('valeur3Adulte')
                ->add('marge3Adulte')
                ->add('margePourc3Adulte','checkbox',array(
                    'label'    => 'En pourcentage',
                    'required' => FALSE,
                ))
                ->add('reduction1Enf3Adulte')
                ->add('reduction2Enf3Adulte')
                ->add('valeur4Adulte')
                ->add('marge4Adulte')
                ->add('margePourc4Adulte','checkbox',array(
                    'label'    => 'En pourcentage',
                    'required' => FALSE,
                ))
                ->add('reduction1Enf4Adulte')
                ->add('reduction2Enf4Adulte')
                ->add('valeur5Adulte')
                ->add('marge5Adulte')
                ->add('margePourc5Adulte','checkbox',array(
                    'label'    => 'En pourcentage',
                    'required' => FALSE,
                ))
                ->add('reduction1Enf5Adulte')
                ->add('reduction2Enf5Adulte')
                ->add('valeur6Adulte')
                ->add('marge6Adulte')
                ->add('margePourc6Adulte','checkbox',array(
                    'label'    => 'En pourcentage',
                    'required' => FALSE,
                ))
                ->add('reduction1Enf6Adulte')
                ->add('reduction2Enf6Adulte')
                ->add('valeur7Adulte')
                ->add('marge7Adulte')
                ->add('margePourc7Adulte','checkbox',array(
                    'label'    => 'En pourcentage',
                    'required' => FALSE,
                ))
                ->add('reduction1Enf7Adulte')
                ->add('reduction2Enf7Adulte')
                ->add('valeur8Adulte')
                ->add('marge8Adulte')
                ->add('margePourc8Adulte','checkbox',array(
                    'label'    => 'En pourcentage',
                    'required' => FALSE,
                ))
                ->add('reduction1Enf8Adulte')
                ->add('reduction2Enf8Adulte')
                ->add('valeur9Adulte')
                ->add('marge9Adulte')
                ->add('margePourc9Adulte','checkbox',array(
                    'label'    => 'En pourcentage',
                    'required' => FALSE,
                ))
                ->add('reduction1Enf9Adulte')
                ->add('reduction2Enf9Adulte')
                ->add('valeur10Adulte')
                ->add('marge10Adulte')
                ->add('margePourc10Adulte','checkbox',array(
                    'label'    => 'En pourcentage',
                    'required' => FALSE,
                ))
                ->add('reduction1Enf10Adulte')
                ->add('reduction2Enf10Adulte')
                ->add('suppSingle')
                ->add('margeSuppSingle')
                ->add('margePourcSuppSingle','checkbox',array(
                    'label'    => 'En pourcentage',
                    'required' => FALSE,
                ))
                ->add('suppSingle1Enf','checkbox',array(
                    'label'    => 'Appliquer supplémenet single pour un adulte avec 1 enfant',
                    'required' => FALSE,
                ))
                ->add('suppSingle2Enf','checkbox',array(
                    'label'    => 'Appliquer supplémenet single pour un adulte avec 2 enfants ou plus',
                    'required' => FALSE,
                ));
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
