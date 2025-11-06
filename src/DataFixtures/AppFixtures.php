<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Produit;
use App\Entity\Transporteur;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) 
    {
        
    }

    public function load(ObjectManager $manager): void
    {
        $userAdmin = new User();
        $userAdmin->setEmail('sudboistest@admin.com');
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setPassword($this->passwordHasher->hashPassword($userAdmin, 'sudboistestAdmin'));
        $manager->persist($userAdmin);

        $userPublic = new User();
        $userPublic->setEmail('sudboistest@public.com');
        $userPublic->setRoles([]);
        $userPublic->setPassword($this->passwordHasher->hashPassword($userPublic, 'sudboistestPublic'));
        $manager->persist($userPublic);

        $faker = Faker::create('fr_FR');

        // Clients 
        for ($i = 0; $i < 20; $i++) {
            $client = (new Client())
                ->setFirstname($faker->firstname())
                ->setLastname($faker->lastname());
            $manager->persist($client);
        }

        // Transporteurs
        $dataTransporteurs = ['DiHL', 'UPPS', 'Gronopost', 'FidEx', 'PLS', 'Coulissimo'];
        foreach ($dataTransporteurs as $transporteurName) {
            $manager->persist((new Transporteur())->setName($transporteurName));
        }

        // Produits
        $dataProduits = [
            'Sol Stratifié QUICK STEP - Chêne Classique Beige. Prix / botte de 1.835 m²', 
            'Lame de Plancher / Parquet Bois Massif Pin Raboté', 
            'Planche à Emboîtement 28x180 Douglas Raboté', 
            '♣ Panneau Bois ciment multi-applications Viroc', 
            'Plan de travail en bois massif Epaisseur 42 mm',
            'Sol Stratifié QUICK STEP - Chêne nature Gerce. Prix / botte de 2.048 m²',
        ];
        foreach ($dataProduits as $produitName) {
            $manager->persist((new Produit())->setName($produitName));
        }

        $manager->flush();
    }
}
