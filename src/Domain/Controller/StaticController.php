<?php

namespace App\Domain\Controller;

use App\Domain\Model\UserModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class StaticController
 * @package App\Domain\Controller
 */
class StaticController extends Controller
{
    /**
     * @Route("/lmPrint", name="lmPrint", methods={"GET"})
     * @throws \Exception
     */
    public function lmPrimtView() {
        return $this->render('static/lmprint.html.twig');
    }
}
