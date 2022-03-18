<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Survey;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    #[Route(path: '/', name: 'index')]
    public function index(EntityManagerInterface $entityManager)
{
        $surveys = $entityManager->getRepository(Survey::class)->findAll();

        return $this->render('Index/index.html.twig', [
            'surveys' => $surveys
        ]);
    }
}
