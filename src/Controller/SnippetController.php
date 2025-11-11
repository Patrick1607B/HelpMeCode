<?php

namespace App\Controller;

use App\Entity\Snippet;
use App\Form\SnippetType;
use App\Repository\SnippetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/snippet')]
final class SnippetController extends AbstractController
{
    #[Route(name: 'app_snippet_index', methods: ['GET'])]
    public function index(SnippetRepository $snippetRepository): Response
    {
        return $this->render('snippet/index.html.twig', [
            'snippets' => $snippetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_snippet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $snippet = new Snippet();
        $form = $this->createForm(SnippetType::class, $snippet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($snippet);
            $entityManager->flush();

            return $this->redirectToRoute('app_snippet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('snippet/new.html.twig', [
            'snippet' => $snippet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_snippet_show', methods: ['GET'])]
    public function show(Snippet $snippet): Response
    {
        return $this->render('snippet/show.html.twig', [
            'snippet' => $snippet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_snippet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Snippet $snippet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SnippetType::class, $snippet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_snippet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('snippet/edit.html.twig', [
            'snippet' => $snippet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_snippet_delete', methods: ['POST'])]
    public function delete(Request $request, Snippet $snippet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$snippet->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($snippet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_snippet_index', [], Response::HTTP_SEE_OTHER);
    }
}
