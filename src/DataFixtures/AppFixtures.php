<?php


namespace App\DataFixtures;


use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{


    /**
     * Load data fixtures with the passed EntityManager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0 ; $i<20 ; $i++){
            $trick = new Trick();
            $trick->setName("Trick n°". $i);
            $trick->setSlug('trick-'.$i);
            $trick->setDescription("Lorem ipsum");
            $trick->setGroups($i);
            $manager->persist($trick);
        }
        $manager->flush();
    }
}