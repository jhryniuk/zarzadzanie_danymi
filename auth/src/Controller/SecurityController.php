<?php

namespace App\Controller;

use App\Entity\Token;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request): Response
    {
        $user = $this->getUser();

        $date = date_create();
        date_add($date, date_interval_create_from_date_string('30 minutes'));
        $tok = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');

        $token = new Token();
        $token
            ->setUser($user)
            ->setValidDate($date)
            ->setToken($tok);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($token);
        $entityManager->flush();
        return $this->json([
            // The getUserIdentifier() method was introduced in Symfony 5.3.
            // In previous versions it was called getUsername()
            'username' => $user->getUserIdentifier(),
            'roles' => $user->getRoles(),
            'token' => $tok
        ]);
    }
}
