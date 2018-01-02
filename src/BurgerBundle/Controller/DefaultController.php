<?php

namespace BurgerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DefaultController extends Controller {

    private $livraison = "magasin";
    public static $MailResp = "wbouss@gmail.com";
    public static $MailWebSite = "noreply-burger@restauration.fr";
    public static $tarifSup = 0.5;

    /**
     * Matches 
     *
     * @Route("/", name="burger_homepage")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $repositoryProduit = $em->getRepository("BurgerBundle:Produit");
        $produits = $repositoryProduit->findAll();

        if (isset($_POST['nom'])) {
            $nom = addslashes($_POST['nom']);
            $tel = addslashes($_POST['tel']);
            $email = addslashes($_POST['email']);
            $msg = addslashes($_POST['message']);
            $prenom = addslashes($_POST['prenom']);


            $to = DefaultController::$MailResp;
            $subject = 'Message de '.DefaultController::$MailWebSite;
            $message = 'As Salam Alaykoum !
		Voici un message envoyé par :' . $nom . '' . $prenom . '.
		Téléphone :' . $tel . '. 
		Email :' . $email .
                    '. Message : ' . $msg;
            $headers = 'From: ' . $email . "\r\n" .
                    'Reply-To: ' . $email . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);

            echo "<script>alert('Message envoyé !');</script>";
        }


        return $this->render('BurgerBundle:Default:main.html.twig', array("produits" => $produits));
    }

    /**
     * 
     * @Route("/liveOrder" , name="burger_liveorder")
     */
    public function liveOrderAction(Request $request) {
        return $this->render("BurgerBundle:Admin:Live/liveOrder.html.twig");
    }

    /**
     * 
     * @Route("/liveOrderData" , name="burger_liveorderdata")
     */
    public function liveOrderDataAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repositoryCommande = $em->getRepository("BurgerBundle:Commande");
        $commandes = $repositoryCommande->findAll();

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($commandes, 'json');

        return new Response($jsonContent);
    }

    /**
     * Matches 
     *
     * @Route("/carte/{type}", name="burger_carte")
     */
    public function carteAction(Request $request, $type = 0 ) {

        $em = $this->getDoctrine()->getManager();
        $repositoryProduit = $em->getRepository("BurgerBundle:Produit");
        $repositorySauce = $em->getRepository("BurgerBundle:Sauce");
        $repositoryCrudite = $em->getRepository("BurgerBundle:Crudite");
        $repositoryTypeFrite = $em->getRepository("BurgerBundle:TypeFrite");
        $repositorySupplement = $em->getRepository("BurgerBundle:Supplement");
        $repositoryTypeProduit = $em->getRepository("BurgerBundle:TypeProduit");

        if( $type == 0 ){
                if(!empty($repositoryTypeProduit->findAll()))
                {
                    $typeObject = $repositoryTypeProduit->findAll()[0];
                    $produits = $repositoryProduit->findByType($typeObject->getId());
                }
                else
                {
                    $typeObject =  0;
                    $produits = array();
                }
        }
        else{
            $typeObject = $repositoryTypeProduit->find($type);
            $produits = $repositoryProduit->findByType($type);
        }
        if(!empty($typeObject))
            $typeObject = unserialize($typeObject->getComposition());

        $typeObjectArray = [];
        foreach ( $typeObject as $e ){
            $typeObjectArray[] = $e;
        }

        $boissons = $repositoryProduit->findByType($repositoryTypeProduit->findByNom("Boisson"));
        $sauces = $repositorySauce->findAll();
        $crudites = $repositoryCrudite->findAll();
        $frites = $repositoryTypeFrite->findAll();
        $supplements = $repositorySupplement->findAll();


        return $this->render('BurgerBundle:Default:carte.html.twig', array( "typeProduitObjectComposition" => $typeObjectArray , "typeProduits" => $repositoryTypeProduit->findAll() ,"typeProduit" => $type, "produits" => $produits, "sauces" => $sauces, "crudites" => $crudites, "boissons" => $boissons, "frites" => $frites, "supplements" => $supplements));
    }

    /**
     * Matches 
     *
     * @Route("/changepasseword/", name="burger_changepassword")
     */
    public function changePassewordAction(Request $request) {
        return $this->render('BurgerBundle:Default:changepassword.html.twig', array("etape" => "initial"));
    }

    /**
     * Matches 
     *
     * @Route("/panier", name="burger_panier",
     * options = { "expose" = true })
     */
    public function panierAction(Request $request) {
        $total = $this->MontantGlobal($request);
        return $this->render('BurgerBundle:Default:panier.html.twig', array("total" => $total));
    }

    /**
     * Matches 
     *
     * @Route("/register_confirm", name="burger_register_confirm")
     */
    public function registerConfirmAction(Request $request) {
        return $this->render('BurgerBundle:Default:register_confirm.html.twig');
    }

    /**
     * Matches 
     *
     * @Route("/register_confirm", name="burger_update_confirm")
     */
    public function updateConfirmAction(Request $request) {
        return $this->render('BurgerBundle:Default:update_confirm.html.twig');
    }

    /**
     * Matches 
     *
     * @Route("/moncompte", name="burger_moncompte")
     */
    public function monCompteAction(Request $request) {
        return $this->render('BurgerBundle:Default:moncompte.html.twig');
    }

    /**
     * Matches 
     *
     * @Route("/commander/{livraison}", name="burger_commander")
     */
    public function commanderAction(Request $request, $livraison = "magasin") {
        $total = $this->MontantGlobal($request);
        $public_key = $this->container->getParameter('stripe.public_key');

        return $this->render('BurgerBundle:Default:commander.html.twig', (array( "public_key" => $public_key , "typeLivraison" => $livraison, "total" => $total)));
    }

    /**
     * Matches 
     *
     * @Route("/livraison/{type}", name="burger_livraison")
     */
    public function livraisonAction(Request $request, $type = "") {
        $nb = count($request->getSession()->get("panier")["idProduit"]);
        $montantTotal = $this->MontantGlobal($request);
        if ($type != "" && $type == "magasin")
            $livraison = "magasin";
        else if ($type != "" && $type == "domicile")
            $livraison = "domicile";
        else
            $livraison = "magasin";

        $mag_enabled = $this->container->getParameter('livraison.magasin_enabled');
        $livraison_min = $this->container->getParameter('livraison.min_total');

        return $this->render('BurgerBundle:Default:livraison.html.twig', array("livraisonMin" => $livraison_min, "MagasinEnabled" => $mag_enabled , "montantTotal" => $montantTotal, "nbArticlePanier" => $nb, "type" => $livraison));
    }


    /**
     * Matches 
     *
     * @Route("/pok", name="burger_paiementok")
     */
    public function pokAction(Request $request) {
        return $this->render('BurgerBundle:Default:paiementOk.html.twig');
    }

    /**
     * Matches 
     *
     * @Route("/pnok", name="burger_paiementnok")
     */
    public function pnokAction(Request $request) {
        return $this->render('BurgerBundle:Default:paiementNok.html.twig');
    }

    /**
     * Matches 
     *
     * @Route("/paiement/{livraison}", name="burger_paiement")
     */
    public function paiementAction(Request $request, $livraison = "magasin") {

        $name_website = $this->container->getParameter('name_website');
        $private_key = $this->container->getParameter('stripe.private_key');
        $public_key = $this->container->getParameter('stripe.public_key');

        $em = $this->getDoctrine()->getManager();
        $total = $this->MontantGlobal($request);

        // on vérifie s'il n'y a pas d'erreur
        // On test si on peut passer des commandes
        $repositoryParametre = $em->getRepository("BurgerBundle:Parametre");
        $autorisation = $repositoryParametre->findOneByNom("Activation des commandes");
        if (empty($autorisation) || $autorisation->getValeur() != "En marche") {
            $message = "Les commandes sont suspendu, veuillez réessayer plus tard";
            return $this->render('BurgerBundle:Default:commander.html.twig', (array( "public_key" => $public_key , "message" => $message, "typeLivraison" => $livraison, "total" => $total)));
        }

        // On test si la commande est conforme aux règles
        if ($livraison == "domicile" && $total < 15) {
            $message = "Les commandes en dessous de 15 euros ne peuvent être à domicile";
            return $this->render('BurgerBundle:Default:commander.html.twig', (array( "public_key" => $public_key  ,"message" => $message, "typeLivraison" => $livraison, "total" => $total)));
        }

        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey($private_key);

        // Token is created using Stripe.js or Checkout!
        // Get the payment token submitted by the form:
        $token = $request->get('stripeToken');


        if (empty($token))
        {
            return $this->render('BurgerBundle:Default:panier.html.twig', array("total" => $total));
        }

        $total = $this->MontantGlobal($request);

        // Charge the user's card:
        $charge = \Stripe\Charge::create(array(
                    "amount" => $total * 100,
                    "currency" => "eur",
                    "description" => "Commande",
                    "source" => $token,
        ));






        $repositoryProduit = $em->getRepository("BurgerBundle:Produit");
        $panier = $request->getSession()->get("panier");
        $translationP = $this->panierD($request);

        // creation de la commande
        $commande = new \BurgerBundle\Entity\Commande();
        $commande->setAdresse($this->getUser()->getAdresse());
        $commande->setCodepostale($this->getUser()->getCodePostale());
        $commande->setVille($this->getUser()->getVille());
        $commande->setInformationComplementairesAdresse($this->getUser()->getInformationComplementairesAdresse());
        $commande->setCodeImmeuble($this->getUser()->getCodeImmeuble());
        $commande->setInterphone($this->getUser()->getInterphone());
        $commande->setNom($this->getUser()->getLastName());
        $commande->setTelephone($this->getUser()->getTelephone());
        $commande->setEtat("Emise");
        $commande->setDate(new \DateTime());
        $commande->setAmount($total);
        $commande->setTypepaiement("carte bancaire");
        if ($livraison == "domicile") {
            $commande->setLivraison("domicile");
            $mailtosend = DefaultController::$MailResp;}
        else if ($livraison == "magasin") {
            $commande->setLivraison("magasin");
            $mailtosend = DefaultController::$MailResp;
        }
         else {
            $commande->setLivraison($livraison); // cas non existant
        }

        $em->persist($commande);

        $lignes = array();
        // creation des ligne de commande
        for ($i = 0; $i < count($panier["idProduit"]); $i++) {
            $ligne = new \BurgerBundle\Entity\LigneCommande();
            $p = $repositoryProduit->find($panier["idProduit"][$i][0]);
            $ligne->setProduit($p->getIntitule());
            $ligne->setQuantite($panier["qteProduit"][$i]);
            $ligne->setPrix($panier["prixProduit"][$i]);
            $ligne->setCommande($commande);
            $ligne->setOptions(json_encode($translationP[$i]["optionsProduit"]));
            $em->persist($ligne);
            $lignes[] = $ligne;
        }

        $em->flush();
        $this->viderPanier($request);

        /*
         *  mail au fournisseur
         */
        $titre = "Nouvelle commande";
        $from =  DefaultController::$MailWebSite;


        $body = $this->get("templating")->render('BurgerBundle:Mail:nouvelleCommandeResponsable.html.twig', array('commande' => $commande, "lignes" => $lignes , "websiteName" => $name_website));

        $message = \Swift_Message::newInstance()
                ->setSubject($titre)
                ->setFrom($from)
                ->setTo($mailtosend)
                ->setBody($body)
                ->setContentType('text/html');
        $this->get('mailer')->send($message);

        /*
         *  mail au client
         */
        $titre = "Votre commande ".$name_website;
        $from =  DefaultController::$MailWebSite;


        $body = $this->get("templating")->render('BurgerBundle:Mail:nouvelleCommandeClient.html.twig', array('commande' => $commande, "lignes" => $lignes, "websiteName" => $name_website));

        $message = \Swift_Message::newInstance()
                ->setSubject($titre)
                ->setFrom($from)
                ->setTo($this->getUser()->getEmail())
                ->setBody($body)
                ->setContentType('text/html');
        $this->get('mailer')->send($message);

        return $this->render('BurgerBundle:Default:paiementOk.html.twig');
    }


    /**
     * Matches
     *
     * @Route("/pan",
     * name="pan")
     */
    public function panAction(Request $request) {
        dump($request->getSession()->get("panier"));
        die();

    }
    /**
     * Matches 
     *
     * @Route("/panierData", 
     * options = { "expose" = true },
     * name="panier_data")
     */
    public function panierDataAction(Request $request) {
        // on retourne vide si le panier n'existe pas
        if (empty($request->getSession()->get("panier"))) {
            return new response('{"aaData":{}}');
        }
        $em = $this->getDoctrine()->getManager();
        $repositoryProduit = $em->getRepository("BurgerBundle:Produit");
        $session = $request->getSession()->get("panier");

        $repositoryFrite = $em->getRepository("BurgerBundle:TypeFrite");
        $repositorySauce = $em->getRepository("BurgerBundle:Sauce");
        $repositorySupplement = $em->getRepository("BurgerBundle:Supplement");
        $repositoryCrudite = $em->getRepository("BurgerBundle:Crudite");

        $retour = array();
        $i = 0;
        foreach ($session["idProduit"] as $s) {
            $format = array();
            $format["IdProduit"] = $session["idProduit"][$i][0];
            $produit = $repositoryProduit->find($session["idProduit"][$i][0]);
            $format["libelleProduit"] = $produit->getIntitule();
            $format["prixProduit"] = $produit->getPrix();
            $format["imageProduit"] =  $produit->getImage()->getName() . "." . $produit->getImage()->getExtension();
            $format["qteProduit"] = $session["qteProduit"][$i];
            $format["prixProduit"] = $session["prixProduit"][$i];
            $format["descriptionProduit"] = $produit->getDescription();

            $optionsTranslation = Array();
            $composition_type = $produit->getType()->getComposition();


            if(empty($composition_type)){
                $optionsTranslation[] = -1;
                $optionsTranslation [] = -1;
                $optionsTranslation[] = -1;
                $optionsTranslation[] = -1;
                $optionsTranslation[] = -1;
                $optionsTranslation[] = -1;
            }

            if( intval($session["idProduit"][$i][1][0]) != -1)
            {
                $friteTranslation = $repositoryFrite->find(intval($session["idProduit"][$i][1][0]))->getNom();
                $optionsTranslation[] = $friteTranslation;
            }
            else
                $optionsTranslation[] = -1;

            if( intval($session["idProduit"][$i][1][1]) != -1 )
            {
                $sauce1Translation = $repositorySauce->find(intval($session["idProduit"][$i][1][1]))->getNom();
                $optionsTranslation[] = $sauce1Translation;
            }
            else
                $optionsTranslation[] = -1;

            if( intval($session["idProduit"][$i][1][2]) != -1)
            {
                $sauce2Translation = $repositorySauce->find(intval($session["idProduit"][$i][1][2]))->getNom();
                $optionsTranslation[] = $sauce2Translation;
            }
            else
                $optionsTranslation[] = -1;

            if( intval($session["idProduit"][$i][1][3]) != -1)
            {
                $boissonTranslation = $repositoryProduit->find(intval($session["idProduit"][$i][1][3]))->getIntitule();
                $optionsTranslation[] = $boissonTranslation;
            }
            else
                $optionsTranslation[] = -1;

            $supplementTranslation = Array();
            if ($session["idProduit"][$i][1][4] != -1) {
                foreach ($session["idProduit"][$i][1][4] as $s) {
                    $supplementTranslation[] = $repositorySupplement->find(intval($s))->getNom();
                }
            } else
                $supplementTranslation = -1;
            $optionsTranslation[] = $supplementTranslation;

            if ($session["idProduit"][$i][1][5] != -1) {
                foreach ($session["idProduit"][$i][1][5] as $c) {
                    $cruditeTranslation[] = $repositoryCrudite->find(intval($c))->getNom();
                }
            } else {
                $cruditeTranslation = -1;
            }

            $format["optionsProduit"] = $optionsTranslation;

            $typeObjectArray = [];
            if( empty($produit->getType()->getComposition()))
                $typeObjectArray = [];
            else{
                foreach ( unserialize($produit->getType()->getComposition()) as $e ){
                    $typeObjectArray[] = $e;
                }
            }

            $format["typeProduit"] =  $typeObjectArray;

            $retour[] = $format;
            $i++;
        }
        return new response('{"aaData":' . json_encode($retour) . '}');
    }

    /**
     * Matches 
     *
     * @Route("/Ajoutpanier/{idProduit}/{typeProduit}/{frite}/{sauce1}/{sauce2}/{boisson}/{supplement}/{crudite}",
     * options = {"expose" = true },
     *  name="burger_ajoutpanier")
     */
    public function AjouterProduitPanier(Request $request) {

        $produitId = $request->get("idProduit");
        $produitType = $request->get("typeProduit");

        $options = Array($request->get("frite"), $request->get("sauce1"), $request->get("sauce2"), $request->get("boisson"), $request->get("supplement"), $request->get("crudite"));
        if (!empty($produitId)) {
            $em = $this->getDoctrine()->getManager();
            $repositoryProduit = $em->getRepository("BurgerBundle:Produit");
            $produit = $repositoryProduit->find($produitId);
            // on  fixe le prix on fonction de l'achat d'un menu ou du burger seulement
            if ( !empty($produit->getType()->getComposition()) && intval($options[0]) == -1 &&  intval($options[3]) == -1 )
                $prixActuel =  $produit->getSeul();
            else
                $prixActuel =  $produit->getPrix();

            if($prixActuel  == null  )
                $prixActuel =  $produit->getPrix();

            $this->ajouterArticle($produit->getId(), 1, $prixActuel , $options, $produitType, $request);
        }
        $total = $this->MontantGlobal($request);
        return new Response("ok");
    }

    function creationPanier($request) {
        $session = $request->getSession();
        if ($session->get("panier") == null) {
            $panier = array();
            $panier["idProduit"] = array();
            $panier["qteProduit"] = array();
            $panier["prixProduit"] = array();
            $panier["verrou"] = false;
            $session->set('panier', $panier);
        }
        return true;
    }

    /**
     * Matches 
     *
     * @Route("/getSession", name="burger_getsession")
     */
    function getSessionAction(Request $request) {

        $session = $request->getSession();
        return new Response(json_encode($session->get("panier")));
    }

    /**
     * Matches 
     *
     * @Route("/incrementerProduitExistant/{index}",
     * options = {"expose" = true },
     *  name="burger_incrementerproduitexistant")
     */
    public function incrementerProduitExistantAction(Request $request) {
        $session = $request->getSession();
        if ($this->creationPanier($request) && !$this->isVerrouille($request)) {
            $sessionPanier = $session->get("panier");
            $sessionPanier["qteProduit"][$request->get("index")] += 1;
            $session->set("panier", $sessionPanier);
        }
        return new Response($this->MontantGlobal($request));
    }

    /**
     * Matches 
     *
     * @Route("/reduireProduitExistant/{index}",
     * options = {"expose" = true },
     *  name="burger_reduireproduitexistant")
     */
    public function reduireProduitExistantAction(Request $request) {
        $session = $request->getSession();
        $index = $request->get("index");
        //Si le panier existe
        if ($this->creationPanier($request) && !$this->isVerrouille($request)) {
            $p = $session->get("panier");
            //Si le produit existe déjà on ajoute seulement la quantité

            if ($p['qteProduit'][$index] == 1) {
                $this->supprimerProduitExistantAction($request, $index);
                return new Response($this->MontantGlobal($request));
            } else if ($p['qteProduit'][$index] > 1) {
                $p['qteProduit'][$index] -= 1;
                $session->set("panier", $p);
                return new Response($this->MontantGlobal($request));
            } else
                return new Response("nok");
        }else {
            //Sinon le produit n'existe pas, on ne fait rien
            return new Response("nok");
        }
    }

    function viderPanier(Request $request) {
        $session = $request->getSession();
        $session->set("panier", null);
        return true;
    }

    /**
     * Matches 
     *
     * @Route("/supprimerProduitExistant/{index}",
     * options = {"expose" = true },
     *  name="burger_supprimerproduitexistant")
     */
    public function supprimerProduitExistantAction(Request $request, $index) {
        $index = $request->get("index");
        //Si le panier existe
        if ($this->creationPanier($request) && !$this->isVerrouille($request)) {
            //Nous allons passer par un panier temporaire

            $tmp = array();
            $tmp['idProduit'] = array();
            $tmp['qteProduit'] = array();
            $tmp['prixProduit'] = array();
            $panier = $request->getSession()->get("panier");
            $tmp['verrou'] = $panier["verrou"];
            for ($i = 0; $i < count($panier['idProduit']); $i++) {
                if ($i != $index) {
                    $tmp['idProduit'][] = $panier['idProduit'][$i];
                    $tmp['qteProduit'][] = $panier['qteProduit'][$i];
                    $tmp['prixProduit'][] = $panier['prixProduit'][$i];
                }
            }
            //On remplace le panier en session par notre panier temporaire à jour
            $request->getSession()->set("panier", $tmp);
            return new Response($this->MontantGlobal($request));
        } else
            return new Response("nok");
    }


    function ajouterArticle($idProduit, $qteProduit, $prixProduit, $options, $typeProduit, $request) {
        $session = $request->getSession();
        if ($options[4] != -1) {
            $arraySupplement = explode(",", $options[4]);
            $options[4] = $arraySupplement;
            $prix = $prixProduit + count($arraySupplement) * DefaultController::$tarifSup;
        } else
            $prix = $prixProduit;

/*        if ($options[5] != -1 && $typeProduit == "Sandwich") {
            $arrayCrudite = explode(",", $options[5]);
            $options[5] = $arrayCrudite;
        }*/

        //Si le panier existe
        if ($this->creationPanier($request) && !$this->isVerrouille($request)) {
            $p = $session->get("panier");
            //Si le produit existe déjà on ajoute seulement la quantité
            $positionProduit = $this->recherche_produit($idProduit, $options, $p["idProduit"]);

            if ($positionProduit >= 0) {
                $p['qteProduit'][$positionProduit] += $qteProduit;
            } else {
                //Sinon on ajoute le produit
                $p["idProduit"][] = Array($idProduit, $options);
                $p["qteProduit"][] = $qteProduit;
                $p["prixProduit"][] = $prix;
            }

            $session->set("panier", $p);
            return true;
        } else
            return false;
    }

    function recherche_produit($idProduit, $options, $panierProduits) {
        $i = 0;
        $j = 0;
        $memeProduit = false;
        $memeOptions = true;
        $positionPossibleProduit = -1;

        foreach ($panierProduits as $panierProduit) {
            if ($panierProduit[0] == $idProduit) { // même produit, reste a savoir si il on les mêmes options
                $memeProduit = true;
                $j = 0;
                foreach ($panierProduit[1] as $panierProduitOptions) {
                    if ($panierProduitOptions != $options[$j])
                        $memeOptions = false;
                    $j++;
                }
                if ($memeOptions == true)
                    return $i;
                else
                    $memeOptions = true;
            }
            $i++;
        }
        if ($memeProduit)
            return -1;
        else
            return -2;
    }

    function MontantGlobal($request) {
        $panier = $request->getSession()->get("panier");
        $total = 0;
        for ($i = 0; $i < count($panier['idProduit']); $i++) {
            $total += $panier['qteProduit'][$i] * $panier['prixProduit'][$i];
        }
        return $total;
    }

    function isVerrouille($request) {
        $session = $request->getSession();
        if ($session->get('panier')["verrou"])
            return true;
        else
            return false;
    }

//    function compterArticles() {
//        if (isset($_SESSION['panier']))
//            return count($_SESSION['panier']['libelleProduit']);
//        else
//            return 0;
//    }
//    function supprimePanier() {
//        unset($_SESSION['panier']);
//    }

    public function panierD(Request $request) {
        // on retourne vide si le panier n'existe pas
        if (empty($request->getSession()->get("panier"))) {
            return new response('{"aaData":{}}');
        }
        $em = $this->getDoctrine()->getManager();
        $repositoryProduit = $em->getRepository("BurgerBundle:Produit");
        $session = $request->getSession()->get("panier");

        $repositoryFrite = $em->getRepository("BurgerBundle:TypeFrite");
        $repositorySauce = $em->getRepository("BurgerBundle:Sauce");
        $repositorySupplement = $em->getRepository("BurgerBundle:Supplement");
        $repositoryCrudite = $em->getRepository("BurgerBundle:Crudite");

        $retour = array();
        $i = 0;
        foreach ($session["idProduit"] as $s) {
            $format = array();
            $format["IdProduit"] = $session["idProduit"][$i][0];
            $produit = $repositoryProduit->find($session["idProduit"][$i][0]);
            $format["libelleProduit"] = $produit->getIntitule();
            $format["prixProduit"] = $produit->getPrix();
            $format["imageProduit"] =  $produit->getImage()->getName() . "." . $produit->getImage()->getExtension();
            $format["qteProduit"] = $session["qteProduit"][$i];
            $format["prixProduit"] = $session["prixProduit"][$i];
            $format["descriptionProduit"] = $produit->getDescription();

            $optionsTranslation = Array();
            $composition_type = $produit->getType()->getComposition();


            if(empty($composition_type)){
                $optionsTranslation[] = -1;
                $optionsTranslation [] = -1;
                $optionsTranslation[] = -1;
                $optionsTranslation[] = -1;
                $optionsTranslation[] = -1;
                $optionsTranslation[] = -1;
            }

            if( intval($session["idProduit"][$i][1][0]) != -1)
            {
                $friteTranslation = $repositoryFrite->find(intval($session["idProduit"][$i][1][0]))->getNom();
                $optionsTranslation[] = $friteTranslation;
            }
            else
                $optionsTranslation[] = -1;

            if( intval($session["idProduit"][$i][1][1]) != -1 )
            {
                $sauce1Translation = $repositorySauce->find(intval($session["idProduit"][$i][1][1]))->getNom();
                $optionsTranslation[] = $sauce1Translation;
            }
            else
                $optionsTranslation[] = -1;

            if( intval($session["idProduit"][$i][1][2]) != -1)
            {
                $sauce2Translation = $repositorySauce->find(intval($session["idProduit"][$i][1][2]))->getNom();
                $optionsTranslation[] = $sauce2Translation;
            }
            else
                $optionsTranslation[] = -1;

            if( intval($session["idProduit"][$i][1][3]) != -1)
            {
                $boissonTranslation = $repositoryProduit->find(intval($session["idProduit"][$i][1][3]))->getIntitule();
                $optionsTranslation[] = $boissonTranslation;
            }
            else
                $optionsTranslation[] = -1;

            $supplementTranslation = Array();
            if ($session["idProduit"][$i][1][4] != -1) {
                foreach ($session["idProduit"][$i][1][4] as $s) {
                    $supplementTranslation[] = $repositorySupplement->find(intval($s))->getNom();
                }
            } else
                $supplementTranslation = -1;
            $optionsTranslation[] = $supplementTranslation;

            if ($session["idProduit"][$i][1][5] != -1) {
                foreach ($session["idProduit"][$i][1][5] as $c) {
                    $cruditeTranslation[] = $repositoryCrudite->find(intval($c))->getNom();
                }
            } else {
                $cruditeTranslation = -1;
            }

            $format["optionsProduit"] = $optionsTranslation;

            $typeObjectArray = [];
            if( empty($produit->getType()->getComposition()))
                $typeObjectArray = [];
            else{
                foreach ( unserialize($produit->getType()->getComposition()) as $e ){
                    $typeObjectArray[] = $e;
                }
            }

            $format["typeProduit"] =  $typeObjectArray;

            $retour[] = $format;
            $i++;
        }
        return $retour;
    }

}
