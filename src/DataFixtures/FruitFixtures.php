<?php

namespace App\DataFixtures;

use App\DataFixtures\ColorFixtures;
use App\DataFixtures\GoutFixtures;
use App\Entity\Fruit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FruitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        // for ($i=0; $i < 10; $i++) { 
        //     $fruit = new Fruit();
        //     $fruit->setName();
        //     $fruit->setCountry();
        //     $fruit->setWeight();
        // }

        // $manager->persist($fruit);

        // $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ColorFixtures::class,
            GoutFixtures::class,
        ];
    }
}
