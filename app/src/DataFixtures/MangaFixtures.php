<?php

namespace App\DataFixtures;

use App\Entity\Manga;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MangaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 0; $i < 20; $i++) {
            $manga = new Manga();
            $manga->setPrice(mt_rand(3, 10));
            $manga->setTitle('Manga', $i);
            $manager->persist($manga);
        }

        $manager->flush();
    }
}
