<?php

namespace App\Framework\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class RecipeController
 * @package App\Controller
 */
class RecipeController extends Controller
{

    /**
     * @Route("/", name="first")
     */
    public function pruebaAction()
    {
        echo "hola mundo";die();
    }

    /**
     * @Route("/two", name="two")
     * @Method({"GET", "POST"})
     */
    public function twoAction(Request $request)
    {
        echo "hola mundo2";die();
    }



}