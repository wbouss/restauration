<?php

namespace BurgerBundle\Admin;

use BurgerBundle\Controller\TypeProduitAdminController;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TypeProduitAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nom')
            ->add('composition')

        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nom')
            ->add('composition')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {

        $choices[TypeProduitAdminController::$frite] = TypeProduitAdminController::$frite;
        $choices[TypeProduitAdminController::$supplement] = TypeProduitAdminController::$supplement;
        $choices[TypeProduitAdminController::$sauce] = TypeProduitAdminController::$sauce;
        $formMapper
            ->add('nom')
            ->add('composition', "choice" , array( "multiple" => true , "choices" => array( $choices)))
            ->add('image', "sonata_type_admin", array(
                'label' => false,
                'required' => false))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nom')
            ->add('composition')
            ->add('Image', null, array('template' => 'BurgerBundle:Admin:Produit/show_image.html.twig'))

        ;
    }
}
