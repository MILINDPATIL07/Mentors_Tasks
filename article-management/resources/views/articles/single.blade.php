<h2>articles description</h2>
@extends('layouts.app')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p>{{ $article->article_description }}</p>
                </div>

               <div class="card-body">
                <h5>Display Comments</h5>

                @include('articles.partials.replies', ['comments' => $article->comments, 'article_id' => $article->id])

                <hr />
               </div>

               <div class="card-body">
                <h5>Leave a comment</h5>
                <form method="post" action="{{ route('comment.add') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="comment" class="form-control" />
                        <input type="hidden" name="article_id" value="{{ $article->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Add Comment" />
                    </div>
                </form>
               </div>

            </div>
        </div>
    </div>
</div>
@endsection
