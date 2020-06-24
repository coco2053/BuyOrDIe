<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProductImage;
use App\Repository\ProductImageRepository;


/**
 * @Route("/document")
 */
class DocumentController extends AbstractController
{
    private $em;
    private $repo;

    public function __construct(EntityManagerInterface $em, ProductImageRepository $repo)
    {
        $this->em = $em;
        $this->repo = $repo;

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
     *
     * @Route("/ajax/image/display/{token}", name="ajax_image_display")
     */
    public function ajaxImageDisplay($token)
    {
        $productImages = $this->repo->findBy(['productToken' => $token]);
        return $this->render('include/_images_list.html.twig', [
            'images'  => $productImages
        ]);
    }

    /**
     *
     * @Route("/ajax/image/delete/{id}", name="ajax_image_delete")
     */
    public function ajaxImageDelete(ProductImage $image)
    {
        $this->em->remove($image);
        $this->em->flush();

        return new JsonResponse(array('status' => '202'));;
    }
}
