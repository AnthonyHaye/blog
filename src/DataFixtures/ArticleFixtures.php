<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $state = ['brouillon', 'publie'];

        for($i = 1; $i <= 25;$i++){
            $article = new Article();
            $article->setTitre("Article n°".$i);
            $article->setContenu("JCDECAUX SE est le n° 1 mondial de la communication extérieure. Le CA par type de support se répartit comme suit :
- mobilier urbain (52,5% ; n° 1 mondial) : vente d'espaces publicitaires dans les centres commerciaux et sur du mobilier urbain (abribus, sanitaires publics automatiques, kiosques à journaux, panneaux de signalisation, etc. ; 530 143 faces publicitaires commercialisées à fin 2021), et vente, location et entretien de mobilier urbain. Par ailleurs, le groupe est le n° 1 mondial du vélo en libre-service ;
- moyens et terminaux de transport (32% ; n° 1 mondial) : vente d'espaces publicitaires dans plus de 154 aéroports, sur et dans les bus, les métros, les trains, les tramways, les gares et les terminaux de transit. A fin 2021, le groupe commercialise 340 753 faces publicitaires ;
- panneaux d'affichage grand format traditionnel et lumineux (15,5% ; n° 1 européen) : 72 611 faces publicitaires vendues.
La répartition géographique du CA est la suivante : France (19,4%), Royaume Uni (9,2%), Europe (30%), Asie-Pacifique (25,4%), Amérique du Nord (6%) et autres (10%).
Nombre d'employés : 10 200 personnes..");

            $article->setState($state[array_rand($state)]);

            $date = new \DateTime();
            $date->modify('-'.$i.' days');

            $article->setDateCreation($date);

            $this->addReference('article-'.$i, $article);

            $manager->persist($article);
        }



        $manager->flush();
    }
}
