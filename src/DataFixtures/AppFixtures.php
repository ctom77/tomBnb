<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
//use Cocur\Slugify\Slugify;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        //$slugify = new Slugify();

        for($i=1; $i <= 30; $i++){
        $ad = new Ad();

        $title = $faker->sentence(6);
        $coverImage = $faker->imageUrl(1000, 350);
        $introduction = $faker->paragraph(2);
        $content = '<p>' . join('<p></p>', $faker->paragraphs(5)) . '</p>';
        //$slug = $slugify->slugify($title);

        $ad->setTitle($title)
            //->setSlug($slug)
            ->setIntroduction($introduction)
            ->setContent($content)
            ->setCoverImage($coverImage)
            ->setPrice(mt_rand(40, 200))
            ->setRooms(mt_rand(1, 10));

        for($j = 1; $j <= mt_rand(2, 5); $j++){
            $image = new Image();
            $image->setUrl($faker->imageUrl())
                  ->setCaption($faker->sentence(6))
                  ->setAd($ad);
            $manager->persist($image);
        }

        $manager->persist($ad);
        }

        $manager->flush();
    }
}
