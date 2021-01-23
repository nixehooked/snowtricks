<?php

namespace App\DataFixtures;


use App\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $groupNameFixtures = ['Grabs', 'Rotations', 'Flips', 'Rotations désaxées', 'Slides', 'One foot', 'Old school'];

        $i = 1;

        foreach ($groupNameFixtures as $groupName) {
            $group = new Group();
            $group->setName($groupName);

            $manager->persist($group);

            $this->addReference('category-'.$i , $group);
            $i++;
        }
    }
}