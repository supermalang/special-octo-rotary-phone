<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\Api\IriConverterInterface;

class SecurityController extends AbstractController{

    /**
     * @Route("/login", name="app_login", methods={"POST"})
     */
    public function login(IriConverterInterface $iriConverter){
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->json([
                'error' => 'Invalid login request: check that the Content-Type header is "application/json".'
            ], 400);
        }

        return new Response(
            null, 
            204, 
            [
                'Location' => $iriConverter->getIriFromItem($this->getUser())  // We send back the Location Header
            ]);

        /*return $this->json([
            'user' => $this->getUser() ? $this->getUser() : null
        ]);*/
    }
}