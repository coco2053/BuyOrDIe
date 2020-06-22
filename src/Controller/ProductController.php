<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Service\AutoComplete;
use App\Entity\ProductImage;
use App\Repository\ProductImageRepository;
use App\Repository\CategoryRepository;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    private $em;
    private $repo;

    public function __construct(EntityManagerInterface $em, ProductRepository $repo)
    {
        $this->em = $em;
        $this->repo = $repo;

    }

    /**
     * @Route("/show/{id}", name="product_show")
     */
    public function show(Product $product)
    {
        dd($product);
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     *
     * @Route("/ajax/image/upload", name="ajax_image_upload")
     */
    public function ajaxImageUpload(Request $request)
    {
        $productImage = new ProductImage();
        $file = $request->files->get('file');
        $productToken = $request->request->get('token');
        $productImage->setProductToken($productToken);
        $productImage->setFile($file);
        $this->em->persist($productImage);
        $this->em->flush();

        return new JsonResponse(array('status' => '201'));
    }

    /**
     * @Route("/autocomplete", name="ajax_product_autocomplete")
     */
    public function autoComplete(Request $request, AutoComplete $autoComplete)
    {
        $input = $request->query->get('input');
        $class = $request->query->get('class');
        $results = $autoComplete->autoComplete($input, $class);

        return new JsonResponse([
            "status"  => '200',
            "results"      => $results,
        ]);
    }

    /**
     * @Route("/create", name="product_create", methods={"GET","POST"})
     */
    public function create(Request $request, ProductImageRepository $productImageRepo, CategoryRepository $categoryRepo)
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $categoryRepo->findOneBy(['name' => $form->getNormData()->getCategory()->getName()]);
            if($category) {
                $product->setCategory($category);
            }
            $images = $productImageRepo->findBy(['productToken' => $request->request->get('product_token')]);
            if(!empty($images)) {
                foreach($images as $image) {
                    $product->addProductImage($image);
                }
            }

            $this->em->persist($product);
            $this->em->flush();

            $this->addFlash(
                'notice',
                'Produit Ajouté'
            );

            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }

        return $this->render('product/create.html.twig', [
            'form'     => $form->createView(),
            'product'  => $product
        ]);
    }
}
