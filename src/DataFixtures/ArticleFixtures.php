<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($j=0;$j<10;$j++)
        {
            $cat = new Category();
            $cat->setTitle($faker->realText(10))
            ->setPicture($faker->imageUrl(1280))
            ->setDescription($faker->paragraphs(2, true));
            

            for ($i=0;$i<10;$i++) {
                $article = new Article();
                $article->setPicture($faker->imageUrl(1280))
                ->setTitle($faker->realText(50))
                ->setContent($faker->paragraphs(10,true))
                ->setCreatedAt($faker->DateTime('now'))
                ->setPublishedAt($faker->DateTime('now'));
                
                $manager->persist($article);

                $cat->addArticle($article);
            }

            $manager->persist($cat);
        }
        $manager->flush();
    }
}
