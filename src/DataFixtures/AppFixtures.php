<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use App\Entity\Plat;
use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = (new Factory())::create('fr_FR');

        $restaurants = [];
        $menus = [];
        $users = [];

        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $users[] = $user;
            $user->setEmail("test{$i}@test.com")
                ->setPassword($this->encoder->encodePassword($user, '1234'));
            $manager->persist($user);
        }



        for ($i = 0; $i < 10; $i++) {
            $restaurant = new Restaurant();
            $restaurants[] = $restaurant;
            $restaurant->setName($faker->sentence($nbWords = 2, $variableNbWords = true));
            $restaurant->setType($faker->sentence($nbWords = 2, $variableNbWords = true));
            $restaurant->setRate($faker->numberBetween(1,5));
            $restaurant->setOwner($users[$i]);
            $manager->persist($restaurant);

            $menu = new Menu();
            $menu->setName($faker->words(4, true));
            $menu->setPrice($faker->numberBetween(5,20));
            $menu->addRestaurant($restaurants[$faker->numberBetween(0, count($restaurants) - 1)]);
            $menus[] = $menu;
            $manager->persist($menu);

            $plat = new Plat();
            $plat->setName($faker->words(4, true));
            $plat->setPrice($faker->numberBetween(5,20));
            $plat->addRestaurant($restaurants[$faker->numberBetween(0, count($restaurants) - 1)]);
            $plat->addMenu($menus[$faker->numberBetween(0, count($menus) - 1)]);
            $manager->persist($plat);
        }

        $manager->flush();
    }
}
