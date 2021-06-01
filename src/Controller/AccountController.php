<?php


namespace App\Controller;

use App\Entity\Server;
use App\Form\Type\ServerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
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
    public function create(Request $request): Response
    {
        $server = new Server();

        $form = $this->createForm(ServerType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($server);
            $em->flush();
        }

        return $this->render('account/account_new-server.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route ("/account/{server.id}", name="page_server")
     */
    public function server(): Response
    {
        $server = $this->ServerRepository->findOneById($id);

        if (null === $server) {
            throw $this->createNotFoundException('Serveur introuvable');
        }

        return $this->render('account/account_server-detail.html.twig', ['server'=> $server]);
    }

    /**
     * @Route ("/account/{server.id}/reboot", name="page_server_reboot")
     */
    /*public function serverReboot(): Response
    {
        return $this-render();
    }

    /**
     * @Route ("/account/{server.id}/delete", name="page_server_delete")
     */
    public function serverDelete(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Server::class);

        $server = $repository->find($id);

        if (null === $server) {
            throw $this->createNotFoundException('Serveur introuvable');
        }

        $em = $this->setDoctrine()->getManager();

        $em->remove($server);
        $em->flush();

        return $this->render('account/server/delete.html.twig');
    }

    /**
     * @Route ("/account/api/{server.id}/ready", name="page_server_ready")
     */
    /*public function serverReboot(): Response
    {
        return $this->render();
    }*/
}