<?php

namespace BurgerBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use BurgerBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use BurgerBundle\Entity\Produit;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class TypeProduitAdminController extends CRUDController
{


    public static $frite = "FRITE";
    public static $supplement = "SUPPLEMENT";
    public static $sauce = "SAUCE";


    // copy ProduitAdminController, variable name doesn't  have changed yet
    public function createAction()
    {
        $templateKey = 'edit';
        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();
        $form = $this->admin->getForm();
        $form->setData($object);

        if ($form->handleRequest($this->getRequest())->isValid()) {
            // persist if the form was valid and if in preview mode the preview was approved
            if (!$this->isInPreviewMode() || $this->isPreviewApproved()) {
                $object->setComposition(serialize ($object->getComposition()));
                $image = $object->getImage();
                $image->upload();
                $this->admin->create($object);
                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                        'result' => 'ok',
                        'objectId' => $this->admin->getNormalizedIdentifier($object)
                    ));
                }
                return new RedirectResponse($this->admin->generateUrl('list'));
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'create',
            'form' => $view,
            'object' => $object,
        ));

    }

    public function deleteAction($id) {
        $repositoryImage = $this->getDoctrine()->getManager()->getRepository("BurgerBundle:Image");
        $repositoryTProduit = $this->getDoctrine()->getManager()->getRepository("BurgerBundle:TypeProduit");
        $Tproduit = $repositoryTProduit->find($id);
        $image = $Tproduit->getImage();
        if (file_exists($image->getPath() . $image->getName() . "." . $image->getExtension())) {
            unlink($image->getPath() . $image->getName() . "." . $image->getExtension());
        }
        return parent::deleteAction($id);
    }

    public function editAction($id = null) {
        $templateKey = 'edit';

        $id = $this->getRequest()->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        $object->setComposition(unserialize ($object->getComposition()));

        $this->admin->setSubject($object);
        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }
        $form = $this->admin->getForm();
        $form->setData($object);

        if ($form->handleRequest($this->getRequest())->isValid()) {
            // persist if the form was valid and if in preview mode the preview was approved
            $repositoryImage = $this->getDoctrine()->getManager()->getRepository("BurgerBundle:Image");
            $repositoryTproduit = $this->getDoctrine()->getManager()->getRepository("BurgerBundle:TypeProduit");
            $object = $this->admin->getNewInstance();
            $form = $this->admin->getForm();
            $produitFromForm = $form->getData();
            $produitToEdit = $repositoryTproduit->find($id);
            $produitToEdit->setComposition(serialize ($produitFromForm->getComposition()));
            $ImageFromForm = $produitFromForm->getImage();
            $newImage = new Image();
            $newImage->setFile($ImageFromForm->getFile());
            $produitToEdit->setNom($produitFromForm->getNom());
            $em = $this->getDoctrine()->getManager();
            $em->persist($produitToEdit);
            if (!empty($ImageFromForm->getFile())) {
                $ImageToChange = $repositoryImage->find($ImageFromForm->getId());
                if (file_exists($ImageToChange->getPath() . $ImageToChange->getName() . "." . $ImageToChange->getExtension())) {
                    unlink($ImageToChange->getPath() . $ImageToChange->getName() . "." . $ImageToChange->getExtension());
                }
                $em->remove($ImageToChange);
                $newImage->upload();
                $produitToEdit->setImage($newImage);
                $em->persist($newImage);
            }
            $em->flush();
            return new RedirectResponse($this->admin->generateUrl('list'));
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'edit',
            'form' => $view,
            'object' => $object,
        ));
    }


}
