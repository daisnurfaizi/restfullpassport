<?php

namespace App\Service;

use App\Helper\ResponseFormater;
use App\Repository\ArticlesRepository;
use Illuminate\Support\Facades\Validator;

class ArticleService
{
    protected $articleRepository;
    public function __construct(ArticlesRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function store($data)
    {
        $validtor = Validator::make($data->all(), [
            'Publication_type' => 'required',
            'Title' => 'required',
            'Source' => 'required',
            'Year' => 'required'
        ]);
        if ($validtor->fails()) {
            return ResponseFormater::error($validtor->errors(), "Something Went Worng");
        }

        $create = $data->all();

        $articles = $this->articleRepository->save($create);

        return ResponseFormater::success($articles, "User Register Successfully");
    }
}
