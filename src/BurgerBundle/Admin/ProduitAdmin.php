<?php

namespace BurgerBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProduitAdmin extends AbstractAdmin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('id')
                ->add('intitule')
                ->add('description')
                ->add('prix')

        ;
    }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('clone', $this->getRouterIdParameter() . '/clone');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('intitule')
                ->add('description')
                ->add('prix')
                ->add('type')
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
    protected function configureFormFields(FormMapper $formMapper) {
        if ($this->id($this->getSubject())) {
            // EDIT
            $formMapper
                    ->add('intitule')
                    ->add('description')
                    ->add('prix',"money")
                    ->add('seul',"money",array( "label" =>"Prix seul: (à remplir pour les menus Burger, woop et sandwich)" , 'required' => false))
                    ->add('type', "choice", array("choices" => array("Burger" => "Burger", "Woop's" => "Woop", "Sandwich" => "Sandwich", "Tex mex" => "Tex mex", "Dessert" => "Dessert", "Boisson" => "Boisson")))
                    ->add('image', "sonata_type_admin", array(
                        'label' => false,
                        'required' => false))
            ;
        } else {
            $formMapper
                    ->add('intitule')
                    ->add('description')
                    ->add('prix',"money")
                    ->add('seul',"money",array( "label" =>"Prix seul: (à remplir pour les menus Burger, woop et sandwich)" , 'required' => false))
                    ->add('type', "choice", array("choices" => array("Burger" => "Burger", "Woop's" => "Woop", "Sandwich" => "Sandwich", "Tex mex" => "Tex mex", "Dessert" => "Dessert", "Boisson" => "Boisson")))
                    ->add('image', "sonata_type_admin", array(
                        'label' => false,
                        'required' => true))
            ;
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->add('intitule')
                ->add('description')
                ->add('prix')
                ->add('type')
                ->add('seul')
                ->add('Image', null, array('template' => 'BurgerBundle:Admin:Produit/show_image.html.twig'))
        ;
    }

}
