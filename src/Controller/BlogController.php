<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $articleRepo)
    {
        $articles = $articleRepo->findAll();

        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/{id}", name="articleDetail")
     */
    public function article(Article $article,ArticleRepository $articleRepo)
    { 
        return $this->render('blog/articleDetail.html.twig', ['article'=>$article
        ]);
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function categories(CategoryRepository $catRepo)
    {
        return $this->render('blog/categories.html.twig', [
            'categories' => $catRepo->findAll()
        ]);
    }

    /**
     * @Route("/pages/{page}", name="pages")
     */
    public function staticPage($page = null)
    {
        if ($page == null)
            return $this->redirectToRoute('home');

        return $this->render('blog/'.$page.'.html.twig', []);
    }

    /**
     * @Route("/contacts", name="contacts")
     */
    public function contacts()
    {
        //Ici gestion page contact et formulaire de contact
    }
}
