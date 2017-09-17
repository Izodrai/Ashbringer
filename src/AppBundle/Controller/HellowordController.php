<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class HellowordController extends Controller
{
    /**
     * @Route("/helloword/{myName}")
     */
    public function showHelloAction($myName, Request $request)
    {
        $tag = $request->query->get('tag');

        $content = $this->get('templating')->render('helloword/helloword.html.twig', array('name' => $myName, 'tag' => $tag));

        return new Response($content);
    }
}