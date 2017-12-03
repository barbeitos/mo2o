<?php

namespace App\Framework\Controller;

use App\Data\Recipe;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Domain\RecipeClient;
use App\Data\Interfaces\RecipeInterface;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class RecipeController
 * @package App\Controller
 */
class RecipeController extends Controller
{
    /**
     * @var RecipeClient
     */
    private $client;


    /**
     * RecipeController constructor.
     * @param $client
     */
    public function __construct(RecipeClient $client)
    {
        $this->client = $client;
        $this->client->launchClient();
    }


    /**
     * Method for search recipes
     *
     * @Route("/api/recipe/search", name="search")
     * @Method({"POST"})
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function searchAction(Request $request)
    {
        $search = "";
        $tags = "";
        $page = 1;

        if($request->request->has('search')){
            $search = $request->request->get('search');
        }

        if($request->request->has('tags')){
            $tags = $request->request->get('tags');
        }

        if($request->request->has('page')){
            if($request->request->get('page') > 0){
                $page = $request->request->get('page');
            }
        }

        $re = $this->client->request($search, $tags, $page);

        $recipes = \GuzzleHttp\json_decode($re, true);

        if(empty($recipes[RecipeInterface::RESULTS])){
            return new Response("There are no recipes with the elements you have introduced.");
        }

        $response = array();

        foreach ($recipes[RecipeInterface::RESULTS] as $recipe){
            $recipe = new Recipe($recipe[RecipeInterface::TITLE], $recipe[RecipeInterface::HREF],
                $recipe[RecipeInterface::INGREDIENTS], $recipe[RecipeInterface::THUMBNAIL]);

            array_push($response, $recipe->getArray());
        }

        $jsonResponse = new JsonResponse($response);

        return $jsonResponse;
    }




}