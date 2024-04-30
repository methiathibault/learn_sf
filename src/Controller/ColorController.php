<?php

namespace App\Controller;

use App\Entity\Color;
use App\Form\ColorFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ColorController extends AbstractController
{
    #[Route('/color', name: 'app_color')]
    public function index(): Response
    {
        return $this->render('color/index.html.twig', [
            'controller_name' => 'ColorController',
        ]);
    }
    
    #[Route('/color/create', name: 'app_color_create')]
    public function create(EntityManagerInterface $em, Request $request): Response
    {
        $color = new Color();

        $form = $this->createForm(ColorFormType::class, $color);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fruit = $form->getData();
            $em->persist($color);
            $em->flush();
            return $this->redirectToRoute('app_test_create');
        }

        return $this->render('color/create.html.twig', [
            'controller_name' => 'ColorController',
            'form' => $form,
        ]);
    }
}
