<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Language;
use App\Entity\Media;
use App\Entity\Playlist;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            'Action' => new Category(),
            'Aventure' => new Category()
        ];
        foreach ($categories as $name => $category) {
            $category->setName($name);
            $manager->persist($category);
        }

        // Création des langues (en boucle)
        $languages = ['Français', 'Anglais', 'Espagnol'];

        foreach ($languages as $languageName) {
            $language = new Language();
            $language->setName($languageName);
            $manager->persist($language);
        }

        // Création d'un utilisateur
        $user = new User();
        $user->setUsername('admin')
            ->setPassword('password123')
            ->setEmail('admin@example.com');
        $manager->persist($user);

        // Création de médias
        $media = new Media();
        $media->setTitle('Film Action 1')
            ->setCategory($categories['Action'])
            ->setLanguage($languages[0])
            ->setUser($user);
        $manager->persist($media);

        $media2 = new Media();
        $media2->setTitle('Film Aventure 1')
            ->setCategory($categories['Aventure'])
            ->setLanguage($languages[1])
            ->setUser($user);
        $manager->persist($media2);

        // Création de playlists
        $playlist = new Playlist();
        $playlist->setName('Playlist 1')
            ->addMedia($media)
            ->addMedia($media2);
        $manager->persist($playlist);


        $manager->flush();
    }
}
