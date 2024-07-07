<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GameService;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class GameController extends AbstractController
{
    private SessionInterface $session;

    public function __construct(private GameService $gameService, RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    #[Route('/', name: 'game')]
    public function index(): Response
    {
        $bees = $this->session->get('bees', []);
        if (empty($bees)) {
            $bees = $this->gameService->getBees();
            $this->session->set('bees', $bees);
        }
        return $this->render('game.html.twig', ['bees' => $bees]);
    }

    #[Route('/hit', name: 'hit')]
    public function hit(): Response
    {
        $bees = $this->session->get('bees', []);
    
        // Apply a hit to a random bee and get the updated state.
        $updatedBees = $this->gameService->hitRandomBee($bees);
        
        // Update the session with the modified list of bees.
        $this->session->set('bees', $updatedBees);
        
        return $this->redirectToRoute('game');
    }
}
