<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\ArticleResource;
use App\Article;
use Illuminate\Http\Request;

class ArticleController extends ApiController
{


    protected $article;


    public function __construct(Article $article)
    {
        parent::__construct();
        $this->article = $article;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->article->paginate();
        return $this->apiResponse->paginator($articles, ArticleResource::class);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $this->article->fill($inputs)->save();
        return $this->apiResponse->created();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->article->find($id);
        return $this->apiResponse->item($article, ArticleResource::class);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updates = $request->only($this->article->getFillable());
        $this->article->where('id', $id)->update($updates);
        return $this->apiResponse->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->article->where('id', $id)->update(['status'=>0]);
        return $this->apiResponse->noContent();
    }
}
