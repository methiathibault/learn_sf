<?php

namespace App\DataFixtures;

use App\Entity\Color;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ColorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $colors = ['rouge','bleu','vert','violet','blanc',
                    'orange','rose','marron','jaune','noir'];

        $hexcodes = ['#FF0000', '#0000FF', '#00FF00', '#7F00FF', '#FFFFFF',
                    '#FFA500','#FF007F','#582900','#FFFF00','#000000'];
                    
        for ($i=0; $i < 10; $i++) { 
            $color = new Color();
            $color->setName($colors[$i]);
            $color->setHexcode($hexcodes[$i]);
            $manager->persist($color);
        }
        $manager->flush();
    }
}
