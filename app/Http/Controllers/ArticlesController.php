<?php

namespace App\Http\Controllers;

use App\Service\ArticleService;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    protected $articleService;
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }
    public function createArticle(Request $request)
    {
        return $this->articleService->store($request);
    }
}
