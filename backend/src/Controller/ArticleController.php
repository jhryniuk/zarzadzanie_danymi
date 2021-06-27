<?php

namespace App\Controller;

use App\AuthService;
use App\DTO\ArticleDTO;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article", methods={"GET"})
     */
    public function index(Request $request, ArticleRepository $articleRepository, AuthService $authService): Response
    {
        if ($request->headers->get('x-auth-token') !== null) {
            $authResult = $authService->checkToken($request->headers->get('x-auth-token'));
            if ($authResult === ['status' => 'Invalid token']) {

                return new JsonResponse($authResult, Response::HTTP_UNAUTHORIZED);
            }
        }
        $data = $articleRepository->findAll();
        $dto = new ArticleDTO();
        $dataArray = [];
        foreach ($data as $item) {
            $dto->set($item);
            $dataArray[] = $dto->toArray();
        }

        return new JsonResponse($dataArray, Response::HTTP_OK);
    }

    /**
     * @Route("/article/{id}", name="article_show", methods={"GET"})
     */
    public function show(Request $request, AuthService $authService, int $id, ArticleRepository $articleRepository): Response
    {
        if ($request->headers->get('x-auth-token') !== null) {
            $authResult = $authService->checkToken($request->headers->get('x-auth-token'));
            if ($authResult === ['status' => 'Invalid token']) {
                return new JsonResponse($authResult, Response::HTTP_UNAUTHORIZED);
            }
        }

        $dto = new ArticleDTO();
        $dto->set($articleRepository->find($id));
        return new JsonResponse($dto->toArray());
    }

    /**
     * @Route("/article", name="article_post", methods={"POST"})
     */
    public function post(Request $request, AuthService $authService): Response
    {
        if ($request->headers->get('x-auth-token') !== null) {
            $authResult = $authService->checkToken($request->headers->get('x-auth-token'));
            if ($authResult === ['status' => 'Invalid token']) {
                return new JsonResponse($authResult, Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return new JsonResponse(['status' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
        }

        $form = $this->createForm(ArticleType::class);

        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            $dto = new ArticleDTO();
            $dto->set($data);

            return new JsonResponse($dto->toArray(), Response::HTTP_CREATED);
        }

        return new JsonResponse([], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/article/{id}", name="article_put", methods={"PUT"})
     */
    public function put(int $id, Request $request, AuthService $authService, ArticleRepository $articleRepository): Response
    {
        if ($request->headers->get('x-auth-token') !== null) {
            $authResult = $authService->checkToken($request->headers->get('x-auth-token'));
            if ($authResult === ['status' => 'Invalid token']) {
                return new JsonResponse($authResult, Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return new JsonResponse(['status' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
        }

        $form = $this->createForm(ArticleType::class, $articleRepository->find($id));

        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            $dto = new ArticleDTO();
            $dto->set($data);

            return new JsonResponse($dto->toArray(), Response::HTTP_OK);
        }

        return new JsonResponse([], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/article/{id}", name="article_delete", methods={"DELETE"})
     */
    public function delete(int $id, Request $request, AuthService $authService, ArticleRepository $articleRepository): Response
    {
        if ($request->headers->get('x-auth-token') !== null) {
            $authResult = $authService->checkToken($request->headers->get('x-auth-token'));
            if ($authResult === ['status' => 'Invalid token']) {
                return new JsonResponse($authResult, Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return new JsonResponse(['status' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
        }

        $em = $this->getDoctrine()->getManager();
        if ($articleRepository->find($id)) {
            $em->remove($articleRepository->find($id));
            $em->flush();

            return new JsonResponse(['success' => true], Response::HTTP_OK);
        }

        return new JsonResponse(['success' => false], Response::HTTP_BAD_REQUEST);
    }
}
