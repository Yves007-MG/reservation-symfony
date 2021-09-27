<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Entity\Image;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdController extends AbstractController
{
    private $adrepository;
    private $entityManager;
    
    public function __construct(AdRepository $adrepository ,EntityManagerInterface $entityManager)
    {
        $this->adrepository = $adrepository;
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(SessionInterface  $session)
    {
        
        $ads = $this->adrepository->findAll();
        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }
    
     /**
     * @Route("/ads/show/{slug}", name="ads_show")
     */
    public  function show(Ad $ad){

        return $this->render('ad/show.html.twig',[
            'ad'=>$ad,
        ]);
    }

    /**
     * Undocumented function
     *
     * @Route("/ads/new" , name="ads_create")
     * @return Response
     */
    public function create(Request $request){
        $ad = new Ad();
        $image = new Image();
        $image->setUrl('http://placehold.it/400x200')
              ->setCaption('Titre1');
            $ad->addImage($image);

         $form = $this->createForm(AdType::class,$ad);
         $form->handleRequest($request);
     

         if($form->isSubmitted() && $form->isValid()){
        //    dd($ad);
            $this->entityManager->persist($ad);
            $this->entityManager->flush();

            $this->addFlash('success',"l'annonce <strong>{$ad->getTitle()}</strong> a bien ete enregistree !");
           
            return $this->redirectToRoute('ads_show' ,[
            'slug'=>$ad->getSlug()
        ]);


         }
        
        return $this->render('ad/new.html.twig',[
            'form'     => $form->createView(),
        ]);

    }
    

}
