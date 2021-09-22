<?php

namespace App\Controller;

use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    public function index()
    {
        $ads = $this->adrepository->findAll();
        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }
}
