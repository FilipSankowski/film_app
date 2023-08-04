<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\Comment\AddCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommentController extends Controller {
  public function showAll() {
    try {
      return response(Comment::all(), 200);
    } catch (Exception $e) {
        return response('Bad request', 400);
    }
  }

  public function showById(mixed $id) {
    try {
      $comment = Comment::findOrFail($id);
    } catch (ModelNotFoundException $e) {
        return response('Invalid comment id', 404);
    }
    return response($comment, 200);
  }

  public function showByUser(mixed $id) {
    try {
      User::findOrFail($id);

      return response(Comment::where('id_user', '=', $id)->get(), 200);
    } catch (ModelNotFoundException $e) {
      return response('Invalid user id', 404);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
  }

  public function showByVideo(mixed $id) {
    try {
      Video::findOrFail($id);

      return response(Comment::where('id_video', '=', $id)->get(), 200);
    } catch (ModelNotFoundException $e) {
      return response('Invalid video id', 404);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
  }

  public function showByVideoAndUser(mixed $id_video, mixed $id_user) {
    try {
      User::findOrFail($id_user);
      Video::findOrFail($id_video);

      $comments = Comment::where('id_video', '=', $id_video)
      ->where('id_user', '=', $id_user)
      ->get();

      return response($comments, 200);
    } catch (ModelNotFoundException $e) {
      return response('Invalid video or user id', 404);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
  }

  public function clear(mixed $id) {
    try {
      $comment = Comment::findOrFail($id);
      $comment->text = 'Komentarz usunięty przez administrację';
      $comment->save();

      return response('Comment cleared', 200);
    } catch (ModelNotFoundException $e) {
      return response('Invalid comment id', 404);
    }
  }

  public function add(AddCommentRequest $request) {
    try {
      $data = $request->validated();
      User::findOrFail($data['id_user']);
      Video::findOrFail($data['id_video']);

      $comment = new Comment;
      $comment->id_user = $data['id_user'];
      $comment->id_video = $data['id_video'];
      $comment->text = $data['text'];
      $comment->id_parent = $data['id_parent'] ?? null;
      $comment->save();

      return response('Comment added', 201);
    } catch (ModelNotFoundException $e) {
      return response('Invalid user or video id', 404);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
  }

  public function update(UpdateCommentRequest $request, mixed $id) {
    try {
      $comment = Comment::findOrFail($id);
      $data = $request->validated();

      $comment->text = $data['text'];
      $comment->save();

      return response('Comment updated', 200);
    } catch (ModelNotFoundException $e) {
      return response('Invalid comment id', 404);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
  }
  
  public function delete(mixed $id) {
    try {
      $comment = Comment::findOrFail($id);
      $comment->delete();

      return response('Comment deleted', 200);
    } catch (ModelNotFoundException $e) {
      return response('Invalid comment id', 404);
    }
  }
}