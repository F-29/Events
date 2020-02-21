<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\article\CreateRequest;
use App\Http\Requests\article\UpdateRequest;
use App\Http\Resources\ArticleResourceCollection;
use App\User;
use Exception;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /** outputs all Articles
     * @return ArticleResourceCollection
     */
    public function index()
    {
        /**
         * @var \Illuminate\Database\Eloquent\Model $articles
         */
        $articles = Article::paginate(4);
        $articles->load('user');
        return new ArticleResourceCollection($articles);
    }

    /** outputs THE Article that matches the id = $id
     * @param int $id Article's id
     * @return mixed
     */
    public function get_by_id(int $id)
    {
        $article = Article::findOrFail($id);
        return new ArticleResource($article->load('user'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        $data = $request->only(['title', 'body']);
        $user = User::find(2);
        return $user->articles()->create($data);
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, int $id)
    {
        /**
         * @var \Illuminate\Database\Eloquent\Model $article
         */
        $article = Article::findOrFail((int)$id);
        $data = $request->only(['title', 'body']);
        $article->update($data);

        return response($article, 202);
    }

    public function delete(int $id)
    {
        /**
         * @var \Illuminate\Database\Eloquent\Model $article
         */
        $article = Article::findOrFail((int)$id);
        /** @noinspection PhpUnhandledExceptionInspection */
        $article->delete();

        return response(null, 204);
    }
}
