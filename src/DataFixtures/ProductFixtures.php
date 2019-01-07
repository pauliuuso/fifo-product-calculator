<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class UserFixtures
 */
class ProductFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $product = (new Product())
            ->setTitle('Garden Gnome')
            ->setPrice(17)
            ->setCount(10);

        $product2 = (new Product())
            ->setTitle('Garden Gnome 2')
            ->setPrice(20)
            ->setCount(10);

        $manager->persist($product);
        $manager->persist($product2);

        $manager->flush();
    }
}
