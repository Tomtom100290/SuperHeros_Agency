<?php

namespace App\DataFixtures;

use App\Entity\Villes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Etats Unis
        $NewYork = new Villes();
        $NewYork->setNom('New York');

        $LosAngeles = new Villes();
        $LosAngeles->setNom('Los Angeles');

        $Chicago = new Villes();
        $Chicago->setNom('Chicago');

        $Houston = new Villes();
        $Houston->setNom('Houston');

        $Phoenix = new Villes();
        $Phoenix->setNom('Phoenix');

        $Philadelphia = new Villes();
        $Philadelphia->setNom('Philadelphia');

        $SanAntonio = new Villes();
        $SanAntonio->setNom('San Antonio');

        $SanDiego = new Villes();
        $SanDiego->setNom('San Diego');

        $Dallas = new Villes();
        $Dallas->setNom('Dallas');

        $Miami = new Villes();
        $Miami->setNom('Miami');

        $SanJose = new Villes();
        $SanJose->setNom('San Jose');

        // Persistance des objets dans la base de données
        $manager->persist($NewYork);
        $manager->persist($LosAngeles);
        $manager->persist($Chicago);
        $manager->persist($Houston);
        $manager->persist($Phoenix);
        $manager->persist($Philadelphia);
        $manager->persist($SanAntonio);
        $manager->persist($SanDiego);
        $manager->persist($Dallas);
        $manager->persist($Miami);
        $manager->persist($SanJose);

        // Sauvegarde dans la base de données
        $manager->flush();
    }
}
