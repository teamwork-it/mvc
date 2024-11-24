<?php
require ("./Model/Repository/PostRepository.php");
class PostController
{
    private $PostRepository;

    public function __construct()
    {
        $this->PostRepository = new PostRepository();
    }

    public function list()
    {
        $posts = $this->PostRepository->getAll();
        require "./View/Posts.php";
    }
}