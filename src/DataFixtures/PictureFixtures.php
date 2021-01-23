<?php

namespace App\DataFixtures;


use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PictureFixtures extends Fixture
{
    public function load(ObjectManager $manager )
    {
        $faker = new Factory;
        $faker = $faker->create('fr_FR');

        for ($a = 1; $a <= 5; $a++) {

            $picture = new Image();

            $picture->setSource('snow-'.$a.'.jpeg')
                ->setAlternatif($faker->name());

            $this->addReference('picture-' . $a, $picture);
        }
    }
}