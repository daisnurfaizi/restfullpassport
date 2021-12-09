<?php

namespace App\Repository;

use App\Models\Articles;

class ArticlesRepository
{
    protected $articlesRepository;
    public function __construct(Articles $articlesReository)
    {
        $this->articlesRepository = $articlesReository;
    }

    public function save($data)
    {
        $article = new $this->articlesRepository;
        $article::create($data);
        return $article;
    }
}
