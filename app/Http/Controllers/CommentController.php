<?php


namespace App\Http\Controllers;


use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Restaurant;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Restaurant $restaurant)
    {
        Comment::create([
            'restaurant_id' => $restaurant->id,
            'user_id' => auth()->id(),
            'memo' => $request->post('memo'),
        ]);

        $restaurant->touch();

        return redirect(route('restaurant_show', $restaurant->id));
    }

    public function delete(Restaurant $restaurant, Comment $comment)
    {
        $comment->delete();

        return redirect(route('restaurant_show', $restaurant->id));
    }

    public function update(CommentRequest $request, Restaurant $restaurant, Comment $comment)
    {
        $comment->update([
            'memo' => $request->post('memo')
        ]);

        return redirect(route('restaurant_show', $restaurant->id) . '#comment-' . $comment->id);
    }

    public function edit(Restaurant $restaurant, Comment $comment)
    {
        return view('comments.edit', [
            'restaurant' => $restaurant,
            'comment' => $comment,
        ]);
    }

}
