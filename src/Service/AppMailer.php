<?php


namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class AppMailer
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var string
     */
    private $toEmail;


    /**
     * Constructor.
     *
     * @param Environment     $twig
     * @param MailerInterface $mailer
     */
    public function __construct(Environment $twig, MailerInterface $mailer, string $toEMail)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
        $this->toEmail = $toEmail;
    }

    public function sendContactEmail(string $from, string $message)
    {
        $html = $this->twig->render('Email/contact.html.twig', [
            'from'    => $from,
            'message' => $message,
        ]);

        $email = new Email();
        $email
            ->from($from)
            ->to($this->toEmail)
            ->subject('Message du formulaire contact')
            ->html($html);

        $this->mailer->send($email);
    }
}