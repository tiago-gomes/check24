<?php

namespace App\Domain\Controller;

use App\Domain\Model\CommentModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CommentController
 * @package App\Domain\Controller
 */
class CommentController extends Controller
{
    /**
     * @var CommentModel
     */
    protected $commentModel;

    /**
     * CommentController constructor.
     * @param CommentModel $commentModel
     */
    public function __construct(CommentModel $commentModel)
    {
        $this->commentModel = $commentModel;
    }
    
    /**
     * @Route("/comment/create", name="addComment", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function addAction(Request $request) {
        $comment = $this->commentModel->addComment($request->request->all());
        $this->addFlash('success', 'Comment as been created!!!');
        return $this->redirect('/blog/'.$comment->getPostId(), 302);
    }
}
