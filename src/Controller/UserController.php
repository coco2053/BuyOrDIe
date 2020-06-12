<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Mailer;
use App\Repository\UserRepository;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    private $em;
    private $encoder;
    private $mailer;
    private $userRepo;

    public function __construct(EntityManagerInterface $em,
                              UserPasswordEncoderInterface $encoder, Mailer $mailer, UserRepository $userRepo)
    {
        $this->em = $em;
        $this->encoder = $encoder;
        $this->mailer = $mailer;
        $this->userRepo = $userRepo;

    }
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
     * @Route("/signin", name="user_login")
     */
    public function signIn(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/sign_in.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/signup", name="user_create")
     */
    public function signUp(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $this->encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setConfirmationToken(bin2hex(random_bytes(32)));

            $this->em->persist($user);

            $this->em->flush();

            $title = 'Validation de votre compte sur MemoCode';
            $view = 'mail/signup.html.twig';
            $this->mailer->sendMail($user, $title, $view);

            $this->addFlash(
                'notice',
                'Un email vous a été envoyé à l\'adresse ' .$user->getEmail() .
                ' contenant un lien pour valider votre inscription. Pensez à vérifier votre 
                courrier indésirable si vous ne le trouvez pas.'
            );

            return $this->redirectToRoute('user_login');
        }

        return $this->render('user/sign_up.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/validation/{token}", name="user_validate")
     */
    public function validate(string $token, Request $request)
    {
        if (!\is_null($user = $this->userRepo->checkConfirmationToken($token))) {
            $user->setActive(true);
            $user->setConfirmationToken(null);

            $this->em->persist($user);

            $this->em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Votre compte est maintenant validé ! Vous pouvez désormais vous connecter.');

            return $this->redirectToRoute('user_login');
        }
        $request->getSession()->getFlashBag()->add('error',  'La validation de votre compte a échoué. Peut être est-il déjà validé ?');

        return $this->redirectToRoute('user_login');
    }


}
