<?php

namespace App\Domain\Controller;

use App\Domain\Model\UserModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthController
 * @package App\Domain\Controller
 */
class AuthController extends Controller
{
    /**
     * @var UserModel
     */
    protected $userModel;
    
    /**
     * AuthController constructor.
     * @param UserModel $userModel
     */
    public function __construct(
        UserModel $userModel
    )
    {
        $this->userModel = $userModel;
    }
    
    /**
     * @Route("/login", name="login", methods={"GET"})
     * @throws \Exception
     */
    public function loginView() {
        return $this->render('login.html.twig');
    }
    
    /**
     * @Route("/authenticate", name="authenticate", methods={"Post"})
     * @throws \Exception
     */
    public function authenticateAction() {
        return $this->render('login.html.twig');
    }
}
