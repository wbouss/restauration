<?php

namespace BurgerBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class UserAdmin extends AbstractAdmin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('username')
                ->add('email')
                ->add('enabled')
                ->add('salt')
                ->add('password')
                ->add('lastLogin')
                ->add('confirmationToken')
                ->add('passwordRequestedAt')
                ->add('roles')
                ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('username')
                ->add('email')
                ->add('roles')
                ->add('telephone')
                ->add('_action', null, array(
                    'actions' => array(
                        'show' => array(),
                        'edit' => array(),
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
                    ->add('email')
                    ->add('adresse')
                    ->add('codepostale')
                    ->add('ville')
                    ->add('firstName')
                    ->add('lastName')
                    ->add('informationComplementairesAdresse')
                    ->add('codeImmeuble')
                    ->add('interphone')
                    ->add('roles')

            ;
        } else {
            // CREATE
            $formMapper
                    ->add('username')
                    ->add('email')
                    ->add('password')
            ;
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->add('username')
                ->add('email')
                ->add('adresse')
                ->add('codepostale')
                ->add('ville')
                ->add('firstName')
                ->add('lastName')
                ->add('telephone')
                ->add('lastLogin')
                ->add('roles')
                ->add('informationComplementairesAdresse')
                ->add('codeImmeuble')
                ->add('interphone')
        ;
    }

    protected function configureRoutes(RouteCollection $collection) {
        // to remove a single route
        $collection->remove('create');
        $collection->remove('delete');
    }

}
