<?php

namespace App\DataFixtures;

use App\Entity\Manga;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MangaFixtures extends Fixture
{
    function __construct(private CategoryRepository $categoryRepository) {}

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $manga = new Manga();
            $manga->setPrice(mt_rand(3, 10));
            $manga->setTitle($faker->name());
            $manga->setCategory($this->categoryRepository->find(2)); // Si on a plusieurs catégories : ...->find(mt_rand(2, 4));
            $manager->persist($manga);
        }

        $manager->flush();
    }
}
