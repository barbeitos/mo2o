<?php

namespace App\Data;

use App\Data\Interfaces\RecipeInterface;


class Recipe
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $href;

    /**
     * @var string
     */
    private $ingredients;

    /**
     * @var string
     */
    private $thunbmail;

    /**
     * Recipe constructor.
     * @param string $title
     * @param string $href
     * @param string $ingredients
     * @param string $thunbmail
     */
    public function __construct(string $title, string $href, string $ingredients, string $thunbmail)
    {
        $this->title = $title;
        $this->href = $href;
        $this->ingredients = $ingredients;
        $this->thunbmail = $thunbmail;
    }


    public function create(array $data){
        try{

            $this->setTitle($data[RecipeInterface::TITLE]);
            $this->setHref($data[RecipeInterface::HREF]);
            $this->setIngredients($data[RecipeInterface::INGREDIENTS]);
            $this->setThunbmail($data[RecipeInterface::THUMBNAIL]);

        }catch (\Exception $e){
            return sprintf(
                "Need %s, %s, %s, %s for created a new Reciper",
                RecipeInterface::TITLE,
                RecipeInterface::HREF,
                RecipeInterface::INGREDIENTS,
                RecipeInterface::THUMBNAIL
            );
        }
    }

    public function getArray()
    {
        return array(
            RecipeInterface::TITLE => $this->getTitle(),
            RecipeInterface::HREF => $this->getHref(),
            RecipeInterface::INGREDIENTS => $this->getIngredients(),
            RecipeInterface::THUMBNAIL => $this->getThunbmail()
        );
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @param string $href
     */
    public function setHref(string $href): void
    {
        $this->href = $href;
    }

    /**
     * @return string
     */
    public function getIngredients(): string
    {
        return $this->ingredients;
    }

    /**
     * @param string $ingredients
     */
    public function setIngredients(string $ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return string
     */
    public function getThunbmail(): string
    {
        return $this->thunbmail;
    }

    /**
     * @param string $thunbmail
     */
    public function setThunbmail(string $thunbmail): void
    {
        $this->thunbmail = $thunbmail;
    }

}