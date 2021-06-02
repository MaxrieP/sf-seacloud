<?php


namespace App\Controller;

use App\Entity\Server;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\Type\ServerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PageController extends AbstractController
{
    /**
     * @Route ("/", name="page_index")
     */
    public function home(): Response
    {
        return $this->render('page/index.html.twig');
        //return new Response ('Home page');
    }

    /**
     * @Route ("/about", name="page_about")
     */
    public function about(): Response
    {
        return $this->render('page/about.html.twig');
    }

    /**
     * @Route ("/services", name="page_services")
     */
    public function services(): Response
    {
        return $this->render('page/services.html.twig');
    }

    /**
     * @Route ("/contact", name="page_contact")
     */
    public function contact(Request $request): Response
    {
        $form = $this
            ->createFormBuilder()
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('subject', TextType::class)
            ->add('message', TextareaType::class)
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->redirectToRoute('page_contact');
        }
        return $this->render('page/contact.html.twig', ['form'=> $form->createView()]);
    }

    /**
     * @Route ("/sign-in", name="page_sign-in")
     */
    public function signIn(): Response
    {
        return $this->render('page/sign-in.html.twig');
    }

    /**
     * @Route ("/sign-up", name="page_sign-up")
     */
    public function Up(Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('account_dashboard');
        }

        return $this->render('page/sign-up.html.twig', ['form' => $form->createView()]);
    }

}