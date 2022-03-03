<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/books', name: 'books')]
    public function index(BookRepository $repository): Response
    {
        $books = $repository->findAll();
        return $this->render('book/listBook.html.twig.', [
            'books' => $books,
        ]);
    }

    #[Route('/book/add', 'add_book')]
    public function addBook(Request $request, EntityManagerInterface $entityManager): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class,$book);

        $form->handleRequest(($request));
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($book);
            $entityManager->flush();
            $this->addFlash('success', 'Livre ajoutez a la bibliotheque !!');
            return $this->redirectToRoute('etagere');
        }

        return $this->render('book/addBook.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/book/take/{id}', 'takebook')]
    public function takeBook(Book $book, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $user = $userRepository->find(1);
        $book->setUser($user);

        $book->setIsAvailable(false);
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('etagere');
    }

    #[Route('/book/return/{id}', 'returnbook')]
    public function returnbook(Book $book, EntityManagerInterface $entityManager): Response
    {

        $book->setUser(null);
        $book->setIsAvailable(true);
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('etagere');
    }
}
