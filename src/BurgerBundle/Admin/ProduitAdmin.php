<?php

namespace BurgerBundle\Admin;

use BurgerBundle\BurgerBundle;
use BurgerBundle\Entity\TypeProduit;
use BurgerBundle\Repository\TypeProduitRepository;
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
                ->add('type', null, array('associated_property' => 'nom'))
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

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $repo_type_produit = $em->getRepository(TypeProduit::class);
        $typeProduits = $repo_type_produit->getTypeProduitIdName();

        if ($this->id($this->getSubject())) {
            // EDIT
            $formMapper
                    ->add('intitule')
                    ->add('description')
                    ->add('prix',"money")
                    ->add('seul',"money",array( "label" =>"Prix seul: (à remplir si le type de produit comprend une composition de menu)" , 'required' => false))
                    ->add('type', "choice", array("choices" => $typeProduits  ))
                    ->add('image', "sonata_type_admin", array(
                        'label' => false,
                        'required' => false))
            ;
        } else {


            $formMapper
                    ->add('intitule')
                    ->add('description')
                    ->add('prix',"money")
                    ->add('seul',"money",array( "label" =>"Prix seul: (à remplir si le type de produit comprend une composition de menu)" , 'required' => false))
                    ->add('type', "choice", array("choices" => $typeProduits  ))
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
                ->add('type', null, array('associated_property' => 'nom'))
                ->add('seul')
                ->add('Image', null, array('template' => 'BurgerBundle:Admin:Produit/show_image.html.twig'))
        ;
    }

}
