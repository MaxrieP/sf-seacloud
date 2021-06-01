<?php


namespace App\Controller;

use App\Entity\Server;
use App\Form\Type\ServerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function contact(): Response
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->redirectToRoute('page_contact');
        }
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
    public function signup(): Response
    {
        return $this->render('page/sign-up.html.twig');
    }

}