<?php


namespace App\Controller;

use App\Entity\Server;
use App\Form\Type\ServerType;
use App\Repository\ServerRepository;
use App\Service\NameGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    /**
     * @var NameGenerator $nameGenerator
     */
    private $nameGenerator;

    /**
     * @var ServerRepository $serverRepository
     */
    private $serverRepository;

    /**
     * AccountController constructor.
     * @param NameGenerator $nameGenerator
     * @param ServerRepository $serverRepository
     */
    public function __construct(NameGenerator $nameGenerator, ServerRepository $serverRepository)
    {
        $this->nameGenerator = $nameGenerator;
        $this->serverRepository = $serverRepository;
    }


    /**
     * @Route ("/account", name="account_dashboard")
     */
    public function account(): Response
    {
        $server = $this->serverRepository->findBy([], ['id'=> 'ASC']);

        return $this->render('account/account_dashboard.html.twig', ['server_list'=> $server]);
    }

    /**
     * @Route ("/account/profil", name="account_profile")
     */
    public function profile(): Response
    {
        return $this->render('account/account_profile.html.twig');
    }

    /**
     * @Route ("/account/new-server", name="account_new-server")
     */
    public function create(Request $request): Response
    {
        $server = new Server();

        $form = $this->createForm(ServerType::class, $server);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $this->nameGenerator->generate($server);

            $em->persist($server);
            $em->flush();

            $url = $this->generateUrl('page_server', ['id'=> $server->getId()] );
            return new RedirectResponse($url);
        }

        return $this->render('account_new-server.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route ("/account/{id}", name="account_server")
     */
    public function server(int $id): Response
    {
        $server = $this->serverRepository->findOneById($id);

        if (null === $server) {
            throw $this->createNotFoundException('Serveur introuvable');
        }

        return $this->render('account/account_server-detail.html.twig', ['server'=> $server]);
    }

    /**
     * @Route ("/account/{id}/delete", name="page_server_delete")
     */
    public function serverDelete(Request $request, int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Server::class);

        $server = $repository->find($id);

        if (null === $server) {
            throw $this->createNotFoundException('Serveur introuvable');
        }

        $form = $this->createForm(ServerType::class, $server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($server);
            $em->flush();
        }

        return $this->redirectToRoute('account_dashboard');
    }

    /**
     * @Route ("/account/{id}/reboot", name="server_reboot")
     */
    public function Reboot(int $id): Response
    {
        /**
         * @var Server $server
         */

        $server = $this->serverRepository->findOneById($id);
        $server->setState(Server::STATE_STOPPED);
        $em = $this->getDoctrine()->getManager();

        $em->persist($server);
        $em->flush();

        $this->addFlash('success', 'Votre serveur redémarre');
        return $this->redirectToRoute('account_server', $id);
    }

    /**
     * @Route ("/account/{id}/reset", name="server_reset")
     */
    public function reset(int $id): Response
    {
        /**
         * @var Server $server
         */

        $server = $this->serverRepository->findOneById($id);
        $server->setState(Server::STATE_PENDING);
        $em = $this->getDoctrine()->getManager();

        $em->persist($server);
        $em->flush();

        $this->addFlash('success', 'Votre serveur est réinstallé');
        return $this->redirectToRoute('account_server', $id);
    }


    /**
     * @Route ("/account/api/{id}/ready", name="page_server-ready")
     */
    public function Ready(): Response
    {
        /**
         * @var Server $server
         */

        $server = $this->serverRepository->findOneById($id);
        $server->setState(Server::STATE_READY);
        $em = $this->getDoctrine()->getManager();

        $em->persist($server);
        $em->flush();

        $this->addFlash('success', 'Votre serveur est prêt');
        return $this->redirectToRoute('account_server');

        //TODO : envoyer mail au client
    }
}