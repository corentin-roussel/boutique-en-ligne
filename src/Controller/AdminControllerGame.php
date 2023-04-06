<?php

namespace App\Controller;




use App\Model\AdminModel;

class AdminControllerGame {

    private ?int $id;

    private ?string $title;

    private ?string $desc;

    private ?int $price;

    private ?string $image;

    private ?string $date;

    private ?string $publisher;

    private ?string $developper;

    private ?int $category;

    private ?int $sub_category;


    public function insertGame($title, $desc, $price, $image, $date, $developper, $publisher, $category, $sub_category)
    {
        $priceInt = (int)$price;
        $categoryInt= (int)$category;
        $sub_categoryInt= (int)$sub_category;

        function mempty($title, $desc, $price, $image, $date, $developper, $publisher , $category, $sub_category)
        {
            foreach(func_get_args() as $values)
            {
                $values = htmlspecialchars(trim($values));

                if(!empty($values))
                {
                    continue;
                }else
                {
                    return false;
                }
            }
            return true;
        }


        //$checkEmpty = array($title, $desc, $price, $image, $date, $developper, $publisher, $category, $sub_category);

        if(preg_match("#^[0-9]*$#" , $price) && grapheme_strlen($desc) > 100 && mempty($title, $desc, $price, $image, $date, $publisher, $developper, $category, $sub_category))
        {
            $AdminModel = new AdminModel();
            $AdminModel->reqInsertGame($title, $desc, $priceInt, $image, $date, $developper, $publisher, $categoryInt, $sub_categoryInt);
        }
        else{
            echo"marche po";
        }
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getDesc(): ?string
    {
        return $this->desc;
    }

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @return string|null
     */
    public function getDevelopper(): ?string
    {
        return $this->developper;
    }

    /**
     * @return string|null
     */
    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    /**
     * @return int|null
     */
    public function getCategory(): ?int
    {
        return $this->category;
    }

    /**
     * @return int|null
     */
    public function getSubCategory(): ?int
    {
        return $this->sub_category;
    }

    /**
     * @param int|null $price
     */
    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    /**
     * @param int|null $category
     */
    public function setCategory(?int $category): void
    {
        $this->category = $category;
    }

    /**
     * @param int|null $sub_category
     */
    public function setSubCategory(?int $sub_category): void
    {
        $this->sub_category = $sub_category;
    }

}