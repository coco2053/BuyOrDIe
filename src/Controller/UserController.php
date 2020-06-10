<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("", name="user_read")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/signup", name="user_create")
     */
    public function signUp(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setConfirmationToken(bin2hex(random_bytes(32)));

            $em->persist($user);

            $em->flush();

            $title = 'Validation de votre compte sur MemoCode';
            $view = 'mail/signup.html.twig';
            //$mailer->sendMail($user, $title, $view);

            $this->addFlash(
                'notice',
                'Un email vous a été envoyé à l\'adresse ' .$user->getEmail() .
                ' contenant un lien pour valider votre inscription. Pensez à vérifier votre 
                courrier indésirable si vous ne le trouvez pas.'
            );

            return $this->redirectToRoute('user_create');
        }

        return $this->render('user/sign_up.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
