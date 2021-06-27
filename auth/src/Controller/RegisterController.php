<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST"})
     */
    public function register(Request $request, UserPasswordHasherInterface $encoder): Response
    {
        $form = $this->createForm(RegisterUserType::class);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $data = $form->getData();
            $data->setPassword($encoder->hashPassword($data, $data->getPassword()));
            try {
                $entityManager->persist($data);
                $entityManager->flush();
            } catch (\Exception $e) {

                return new JsonResponse([], Response::HTTP_BAD_REQUEST);
            }


            return new JsonResponse(['success' => true], Response::HTTP_CREATED);
        }

        return new JsonResponse([], Response::HTTP_BAD_REQUEST);
    }
}
