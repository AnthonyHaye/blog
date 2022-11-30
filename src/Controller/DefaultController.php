<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Services\VerificationComment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use function Composer\Autoload\includeFile;

class DefaultController extends AbstractController
{
    // / qui va lister l'ensemble de nos articles
    /**
     * @Route("/", name="liste_articles" , methods={"GET"})
     */
    public function listeArticles(ArticleRepository $articleRepository): Response
    {

        $articles = $articleRepository->findby([
            'state' => 'publie'
        ]);


        return $this->render('default/index.html.twig', [
            'articles' => $articles,
            'brouillon' => false
        ]);

    }


    // /12 afficher un article

    /**
     * @Route("/{id}", name="vue_article", requirements={"id"="\d+"}, methods={"GET", "POST"})
     */
    public function vueArticle(Article             $article, Request $request, EntityManagerInterface $manager,
                               VerificationComment $verifService, FlashBagInterface $session)
    {


        $comment = new Comment();

        $comment->setArticle($article);

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            if ($verifService->commentaireNonAutourise($comment) === false) {

                $manager->persist($comment);
                $manager->flush();

                return $this->redirectToRoute('vue_article', ['id' => $article->getId()]);


            } else {
                $session->add("danger", "le commentaire contient un mot interdit");
            }

        }


        return $this->render('default/vue.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }
}

