<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $movie = new Movie();
        $movie->setTitle('Star Wars');
        $movie->setShortDescription(shortDescription:'short description');
        $movie->setLongDescription(longDescription: 'long description');
        $movie->setCoverImage('star_wars.png');
        $movie->setReleaseDate(new \DateTime());
        $movie->setCasting([]);
        $movie->setStaff([]);
        $manager->persist($movie);

        $manager->flush();
    }
}
