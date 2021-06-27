<?php

namespace App\Controller;

use App\Entity\Token;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TokenController extends AbstractController
{
    /**
     * @Route("/token/{token}", name="default", methods={"GET"})
     */
    public function show(string $token): JsonResponse
    {
        var_dump('test');
        die();
        $date = date_create();
        $tok = $this->getDoctrine()->getRepository(Token::class)->findOneBy(['token' => $token]);
        var_dump($tok);
        if (null !== $tok) {
            if ($tok->getValidDate() > $date) {
                date_add($date, date_interval_create_from_date_string('30 minutes'));
                $tok->setValidDate($date);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tok);
                $entityManager->flush();

                return new JsonResponse([
                    'token' => $tok->getToken(),
                    'valid_date' => $tok->getValidDate(),
                    'user' => ($tok->getUser())->getId(),
                    'user_roles' => ($tok->getUser())->getRoles()
                ], Response::HTTP_OK);
            }

            return new JsonResponse([], Response::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse([], Response::HTTP_UNAUTHORIZED);
    }
}