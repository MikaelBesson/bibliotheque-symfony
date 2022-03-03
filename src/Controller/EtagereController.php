<?php

namespace App\Controller;

use App\Repository\EtagereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtagereController extends AbstractController
{
    #[Route('/etagere', name: 'etagere'),]
    public function index(EtagereRepository $repository): Response
    {
        $etagere = $repository->findAll();
        return $this->render('etagere/etagere.html.twig.', [
            'etageres' => $etagere,
        ]);
    }
}
