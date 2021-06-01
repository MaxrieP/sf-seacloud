<?php


namespace App\Controller;

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
     * @Route ("/services", name="page_sevices")
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
        return $this->render('page/contact.html.twig');
    }

    /**
     * @Route ("/sign-in", name="page_sign-in")
     */
    public function signin(): Response
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

    /**
     * @Route ("/account", name="page_account")
     */
    public function account(): Response
    {
        return $this->render('account/account_dashboard.html.twig');
    }

    /**
     * @Route ("/account/profil", name="page_profile")
     */
    public function profile(): Response
    {
        return $this->render('account/account_profile.html.twig');
    }

    /**
     * @Route ("/account/new-server", name="page_new-server")
     */
    public function newServer(): Response
    {
        return $this->render('account/account_new-server.html.twig');
    }

    /**
     * @Route ("/account/{server.id}", name="page_server")
     */
    public function server(): Response
    {
        return $this->render('account/account_server-detail.html.twig');
    }

    /**
     * @Route ("/account/{server.id}/reboot", name="page_server_reboot")
     */
    public function serverReboot(): Response
    {
        return $this->;
    }

    /**
     * @Route ("/account/{server.id}/delete", name="page_server_delete")
     */
    public function serverDelete(): Response
    {
        return $this->;
    }

    /**
     * @Route ("/account/api/{server.id}/ready", name="page_server_ready")
     */
    public function serverReboot(): Response
    {
        return $this->;
    }

}