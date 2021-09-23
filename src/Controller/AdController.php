<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdController extends AbstractController
{
    private $adrepository;
    
    public function __construct(AdRepository $adrepository )
    {
        $this->adrepository = $adrepository;
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

         $form = $this->createForm(AdType::class,$ad);
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){


         }
        
        return $this->render('ad/new.html.twig',[
            'form'     => $form->createView(),
        ]);

    }
    

}
