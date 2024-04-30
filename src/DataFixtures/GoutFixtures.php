<?php

namespace App\DataFixtures;

use App\Entity\Gout;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GoutFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tastes = ['sucré','salé','acide','amer','piquant','umami','poivré'];

        for ($i=0; $i < 7; $i++) { 
            $gout = new Gout();
            $gout->setName($tastes[$i]);
            $manager->persist($gout);
        }
        $manager->flush();
    }
}
