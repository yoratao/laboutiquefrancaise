<?php

namespace App\Controller;
use App\Classe\search;
use App\Form\searchType;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(Request $request)
    {


        $search=new search();
        $form=$this->createForm(searchType::class,$search);


        $form->handleRequest($request);
        if ($form->isSubmitted() &&$form->isValid()) {
            $search=$form->getData();
            $products=$this->entityManager->getRepository(Product::class)->findWithSearch($search);
        }
        else{
            $products = $this->entityManager->getRepository(Product::class)->findAll();
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form'=>$form->createView()
        ]);

    }


    /**
     * @Route("/produit/{slug}", name="product")
     */
    public function show($slug)
    {

        $product=$this->entityManager->getRepository(Product::class)->findOneBySlug($slug);

    if (!$product) {
        return $this->redirectToRoute('products');
                }


    return $this->render('product/show.html.twig', [
        'product' => $product
    ]);


}
}