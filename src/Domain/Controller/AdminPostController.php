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
class AdminPostController extends Controller
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
     * @Route("/admin/post", name="getAllPosts", methods={"GET"})
     * @throws \Exception
     */
    public function searchView() {
        $post = $this->postModel->getAll();
        return $this->render('/admin/post/list.html.twig', array(
          'post' => $post
        ));
    }
    
    /**
     * @Route("/admin/post/add", methods={"GET"})
     * @throws \Exception
     */
    public function addView() {
        return $this->render('/admin/post/add.html.twig');
    }

    /**
     * Show post details by ID
     *
     * @Route("/admin/post/view/{id}", requirements={"id"="\d+"}, name="getPostById", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function editView($id) {
        $post = $this->postModel->getPostById($id);
        if (empty($post)) {
            throw new \Exception('Post ID does not exist!!!', 412);
        }
        return $this->render('/admin/post/edit.html.twig', array(
          'post' => $post->toArray()
        ));
    }

    /**
     * @Route("/admin/post/create", requirements={"id"="\d+"}, name="addPost", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function addAction(Request $request) {
        $post = $this->postModel->addPost($request->request->all());
        $this->addFlash('success', 'Post as been created!!!');
        return $this->redirect('/admin/post', 302);
    }

    /**
     * Update an existing post
     *
     * @Route("/admin/post/update/{id}", requirements={"id"="\d+"}, name="updatePost", methods={"POST"})
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function updateAction($id, Request $request) {
        $post = $this->postModel->updatePost($id, $request->request->all());
        $this->addFlash('success', 'Post as been updated!!!');
        return $this->redirect('/admin/post/view/'. $post->getId(), 302);
    }

    /**
     * Remove an existing post
     *
     * @Route("/admin/post/delete/{id}", requirements={"id"="\d+"}, name="removePost", methods={"GET"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function deleteAction($id) {
        $this->postModel->removePost($id);
        $this->addFlash('success', 'Post as been deleted!!!');
        return $this->redirect('/admin/post', 302);
    }
}
