<?php

namespace App\DataFixtures;

use App\DataFixtures\ColorFixtures;
use App\DataFixtures\GoutFixtures;
use App\Entity\Color;
use App\Entity\Fruit;
use App\Entity\Gout;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FruitFixtures extends Fixture implements DependentFixtureInterface
{

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getDependencies()
    {
        return [
            GoutFixtures::class,
            ColorFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $name = ['pomme','fraise','framboise','banane','poire'];
        $country = ['France', 'Espagne', 'Suisse'];
        $weight = ['14g', '100g', '450g', '15g'];

        $color_array = $this->em->getRepository(Color::class)->findAll();
        $taste_array = $this->em->getRepository(Gout::class)->findAll();

        for ($i=0; $i < 10; $i++) {
            $rand_taste_array = array_rand($taste_array, 1);
            $rand_color_array = array_rand($color_array, 1);
            $fruit = new Fruit();
            $fruit->setName($name[random_int(0,4)]);
            $fruit->setCountry($country[random_int(0,2)]);
            $fruit->setWeight($weight[random_int(0,3)]);
            $fruit->setGout($taste_array[$rand_taste_array]);
            $fruit->addColor($color_array[$rand_color_array]);
            $manager->persist($fruit);
        }

        $manager->flush();
    }
}
