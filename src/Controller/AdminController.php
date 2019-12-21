<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/addArticle", name="addArticle")
     * @Route("/admin/editArticle/{id}", name="editArticle")
     */
    public function addArticle(Article $article=null, Request $request)
    {
        if ($article == null) {
            $article = new Article();
            $article->setCreatedAt(new \DateTime());
            $article->setPublishedAt(new \DateTime());
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $article = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash("success", "L'article a bien été ajouté !");

            return $this->redirectToRoute('admin');
        }


        return $this->render('admin/addArticle.html.twig', [
            'form'=>$form->createView(),
            'article'=> $article
        ]);
    }

    /**
     * @Route("/admin/listArticle", name="listArticle")
     */
    public function listArticle(ArticleRepository $articleRepo)
    {
        $articles = $articleRepo->findAll();

        return $this->render('admin/listArticle.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/admin/article/del/{id}", name="delArticle")
     */
    public function delArticle(Article $article = null,  EntityManagerInterface $manager)
    {
        if ($article !== null) {
            $this->addFlash("success", "L'article {$article->getId()} : {$article->getTitle()} a bien été supprimé !");
            $manager->remove($article);
            $manager->flush();
        }
        return $this->redirectToRoute('listArticle');
    }
}
