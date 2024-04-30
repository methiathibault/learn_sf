<?php

namespace App\Controller;

use App\Entity\Gout;
use App\Form\GoutFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GoutController extends AbstractController
{
    #[Route('/gout', name: 'app_gout')]
    public function index(): Response
    {
        return $this->render('gout/index.html.twig', [
            'controller_name' => 'GoutController',
        ]);
    }

    #[Route('/gout/create', name: 'app_gout_create')]
    public function create(EntityManagerInterface $em, Request $request): Response
    {
        $gout = new Gout();

        $form = $this->createForm(GoutFormType::class, $gout);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $gout = $form->getData();
            $em->persist($gout);
            $em->flush();
            return $this->redirectToRoute('app_test_create');
        }

        return $this->render('gout/create.html.twig', [
            'controller_name' => 'GoutController',
            'form' => $form,
        ]);
    }
}
