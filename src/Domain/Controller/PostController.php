<?php

namespace App\Domain\Controller;

use App\Domain\Model\PostModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 * @package App\Domain\Controller
 */
class PostController extends Controller
{
    /**
     * @var PostModel
     */
    protected $postModel;

    /**
     * PostController constructor.
     * @param PostModel $postModel
     */
    public function __construct(PostModel $postModel)
    {
        $this->postModel = $postModel;
    }

    /**
     * @param Request $request
     * @param int $id
     * @Route("/{id}", name="articlePost", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function postView(Request $request, $id) {
        $post = $this->postModel->getPostById($id);
        return $this->render('blog/page.html.twig', array(
          'post' => $post
        ));
    }
}