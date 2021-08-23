<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Swift_Message;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


/**
 * @Route("/users")
 */
class UsersController extends AbstractController
{


    private $encoders ;
    private $normalizers;
    private $serializer;
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
        $this->encoders= [ new JsonEncoder()];
        $this->normalizers= [new ObjectNormalizer()];
        $this->serializer= new Serializer($this->normalizers, $this->encoders);
    }




    /**
     * @Route("/sign_up", name="sign_up", methods={"GET","POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder,MailerInterface $mailer ): Response
    {
        $user1=$this->getUser();

        if($user1 == null) {
            $user = new Users();
            $form = $this->createForm(UsersType::class, $user);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                // encode the plain password
                $user->setToken(md5(uniqid()));
                $user->setRoleAdmin(0);
                $email = (new TemplatedEmail())
                    ->htmlTemplate('front/users/registration/confirmation_email.html.twig'
                    )
                    ->context(['user' => $user, 'token' => $user->getToken()])
                    ->from('gaming2020room@gmail.com')
                    //->to($m->getEmail())
                    ->to($user->getEmail())
                    ->subject('Verification Email');
                //->text('Sending emails is fun again!')
                $mailer->send($email);

                $user->setEtat(0);
                $user->setRole(0);
                $user->setRoleAdmin(0);
                $user->setPassword($encoder->encodePassword($user, $user->getPassword()));


                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('confirmation');


            }

            return $this->render('front/sign_up.html.twig', [
                'form' => $form->createView(), 'user' => $user1,
            ]);
        }else{
            return $this->redirectToRoute('error404', [], Response::HTTP_SEE_OTHER);
        }
    }


    /**
     * @Route("/verify/email/{token}", name="app_verify_email")
     */
    public function verifyUserEmail($token, UsersRepository $users): Response
    {
        // On recherche si un utilisateur avec ce token existe dans la base de données
        $user = $users->findOneBy(['token' => $token]);

        // Si aucun utilisateur n'est associé à ce token
        if(!$user){
            // On renvoie une erreur 404
            return $this->redirectToRoute('error404');
        }



        $user->setToken(null);
        $user->setIsVerified(1);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // On génère un message
        $this->addFlash('message', 'Utilisateur activé avec succès');

        // On retourne à l'accueil
        return $this->redirectToRoute('email_valide');
    }

    /**
     * @Route("/sign_up/confirmation", name="confirmation")
     */
    public function confirmation(): Response
    {
        return $this->render('front/users/registration/confirmation.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/sign_up/emailverif", name="email_valide")
     */
    public function email_valide(): Response
    {
        return $this->render('front/users/registration/email_valide.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }



    /**
     * @Route("/", name="users_index", methods={"GET"})
     */
    public function index(UsersRepository $usersRepository): Response
    {
        return $this->render('back/users/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/bbbb/{id}", name="users_afficher", methods={"GET"})
     */
    public function show(Users $user): Response
    {
        return $this->render('back/users/show.html.twig', [
            'user' => $user,
        ]);
    }
    /**
     * @Route("/admin/users/{id}/activer", name="users_activer", methods={"GET","POST"})
     */
    public function activerCompte( Users $user,$id,\Swift_Mailer $mailer)
    {
        $user=$this->getDoctrine()->getRepository(Users::class)->find($id);


        $user->setEtat(1);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $message = (new \Swift_Message('Verification Email'))
            ->setFrom('Gaming2020Room@gmail.com')
            ->setTo($user->getEmail())
            ->setBody($this->renderView(
                'back/users/activationCompte.html.twig', [ 'user' => $user,]
            ),
                'text/html');
        $mailer->send($message);


        return $this->redirectToRoute('users_index');
    }

    /**
     * @Route("/{id}/edit", name="users_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Users $user): Response
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('users_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="users_delete", methods={"POST"})
     */
    public function delete(Request $request, Users $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('users_index', [], Response::HTTP_SEE_OTHER);
    }


}