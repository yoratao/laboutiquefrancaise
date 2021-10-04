<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{
    private $entityManager; /* variable pour maj base de données*/
    /**
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/compte/modification mot de passe", name="account_password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder )
    {
        $notification = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $old_pwd=$form->get('old_password')->getData(); /*recuperation du vieux mot de passe*/

            if ($encoder->isPasswordValid($user, $old_pwd)) {
                $new_pwd=$form->get('new_password')->getData();  /*recuperation du nouveau mot de passe*/
                $password=$encoder->encodePassword($user,$new_pwd); /*on  le mp crypté puis on set pour injection*/

                $user->setPassword($password);
                $this->entityManager->flush(); /* maj bdd*/
                $notification="Votre mot de passe a bien été mis a jour.";

            }
            else{
                $notification ="Votre mot de passe actuel n'est pas le bon.";
            }
        }


        return $this->render('account/password.html.twig',[
            'form'=>$form->createView(),
            'notification'=>$notification
            ]);
    }
}
