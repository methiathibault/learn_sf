<?php

namespace App\Controller;

use App\Entity\Color;
use App\Entity\Fruit;
use App\Form\FruitFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(EntityManagerInterface $em): Response
    {
        $fruits = $em->getRepository(Fruit::class)->findAll();

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController2',
            'fruits' => $fruits,
        ]);
    }

    #[Route('/test/add', name: 'app_test_add')]
    public function add(EntityManagerInterface $em): Response
    {
        $fruit = new Fruit();
        $fruit->setCountry('France');
        $fruit->setWeight('100g');
        $fruit->setName('Pomme');

        $em->persist($fruit);
        $em->flush();

        return $this->redirectToRoute('app_test');
    }

    #[Route('/test/create', name: 'app_test_create')]
    public function create(EntityManagerInterface $em, Request $request): Response
    {
        $fruit = new Fruit();

        $form = $this->createForm(FruitFormType::class, $fruit);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fruit = $form->getData();
            $em->persist($fruit);
            $em->flush();
            return $this->redirectToRoute('app_test');
        }

        return $this->render('test/create.html.twig', [
            'controller_name' => 'TestController2',
            'form' => $form,
        ]);
    }
    
    #[Route('/test/delete/{id}', name: 'app_test_delete')]
    public function delete(EntityManagerInterface $em, int $id): Response
    {
        $fruit = $em->getRepository(Fruit::class)->find($id);

        if (!$fruit) {
            throw $this->createNotFoundException(
                'No fruit found for id '.$id
            );
        }

        $em->remove($fruit);
        $em->flush();


        return $this->redirectToRoute('app_test', [
            'id' => $fruit->getId()
        ]);
    }

    #[Route('/test/deleteall', name: 'app_test_delete_all')]
    public function deleteall(EntityManagerInterface $em): Response
    {
        $fruits = $em->getRepository(Fruit::class)->findAll();

        if (!$fruits) {
            throw $this->createNotFoundException(
                'No fruits found'
            );
        }

        foreach ($fruits as $fruit){
            $em->remove($fruit);
            $em->flush();
        }


        return $this->redirectToRoute('app_test');
    }

    #[Route('test/update/{id}', name: 'app_test_update')]
    public function update(EntityManagerInterface $em, int $id, Request $request): Response
    {
        $fruit = $em->getRepository(Fruit::class)->find($id);
        
        $form = $this->createForm(FruitFormType::class, $fruit);

        if (!$fruit) {
            throw $this->createNotFoundException(
                'No fruit found' .$id
            );
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fruit = $form->getData();
            $em->persist($fruit);
            $em->flush();
            return $this->redirectToRoute('app_test');
        }

        return $this->render('test/create.html.twig', [
            'controller_name' => 'TestController2',
            'form' => $form,
        ]);
    }
    

}
