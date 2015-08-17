<?php
    namespace Back\VoyageOrganiseBundle\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolverInterface;
    use Back\VoyageOrganiseBundle\Form\LigneType;

    class PackType extends AbstractType
    {
        /**
         * @param FormBuilderInterface $builder
         * @param array $options
         */
        public function buildForm(FormBuilderInterface $builder,array $options)
        {
            $builder
                ->add('file','file',array('required' => FALSE))
                ->add('updateAt')
                ->add('libelle')
                ->add('singleAchat')
                ->add('singleVente')
                ->add('doubleAchat')
                ->add('doubleVente')
                ->add('tripleAchat')
                ->add('tripleVente')
                ->add('quadrupleAchat')
                ->add('quadrupleVente')
                ->add('periode')
                ->add('hotels')
                ->add('single','checkbox',array(
                    'label'    => 'Chambre Single',
                    'required' => FALSE,
                ))
                ->add('double','checkbox',array(
                    'label'    => 'Chambre Double',
                    'required' => FALSE,
                ))
                ->add('quadruple','checkbox',array(
                    'label'    => 'Chambre Quadruple',
                    'required' => FALSE,
                ))
                ->add('triple','checkbox',array(
                    'label'    => 'Chambre Triple',
                    'required' => FALSE,
                ))
                ->add('supplements','collection',array(
                    'type'         => new LigneType(),'label' => ' ',
                    'allow_add'    => TRUE,
                    'allow_delete' => TRUE,
                    'by_reference' => FALSE,
                ));
        }

        /**
         * @param OptionsResolverInterface $resolver
         */
        public function setDefaultOptions(OptionsResolverInterface $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => 'Back\VoyageOrganiseBundle\Entity\Pack',
            ));
        }

        /**
         * @return string
         */
        public function getName()
        {
            return 'back_voyageorganisebundle_pack';
        }
    }
