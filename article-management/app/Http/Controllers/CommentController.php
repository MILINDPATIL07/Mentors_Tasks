<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;

        $comment->comment = $request->comment;

        $comment->user()->associate($request->user());

        $article = Article::find($request->article_id);

        // echo $article;
        // echo $comment;
        // dd($article);
        // die($article);

        $article->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();

        $reply->comment = $request->get('comment');

        $reply->user()->associate($request->user());

        $reply->parent_id = $request->get('comment_id');

        $article = Article::find($request->get('article_id'));

        $article->comments()->save($reply);

        return back();

    }
}
?>
