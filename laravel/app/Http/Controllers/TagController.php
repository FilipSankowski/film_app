<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\FilmTag;
use App\Models\Video;
use App\Http\Requests\Tag\AddTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TagController extends Controller {
  public function showAll() {
    try {
      return response(Tag::all(), 200);
    } catch (Exception $e) {
        return response('Bad request', 400);
    }
  }

  public function showById(mixed $id) {
    try {
      $video = Tag::findOrFail($id);
    } catch (ModelNotFoundException $e) {
        return response('Invalid tag id', 404);
    }
    return response($video, 200);
  }

  public function add(AddTagRequest $request) {
    try {
      $data = $request->validated();

      $tag = new Tag;
      $tag->name = $data['name'];
      $tag->save();

      return response('Tag added', 201);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
  }

  public function update(UpdateTagRequest $request, mixed $id) {
    try {
      $tag = Tag::findOrFail($id);
      $data = $request->validated();

      $tag->name = $data['name'];
      $tag->save();

      return response('Tag updated', 200);
    } catch (ModelNotFoundException $e) {
      return response('Invalid tag id', 404);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
}
  
  public function delete(mixed $id) {
    try {
      $tag = Tag::findOrFail($id);
      $tag->delete();

      return response('Tag deleted', 200);
    } catch (ModelNotFoundException $e) {
      return response('Invalid tag id', 404);
    }
  }

  public function showByVideo(mixed $id) {
    try {
      Video::findOrFail($id);

      $tags = FilmTag::join('tags', 'film_tags.id_tag', '=', 'tags.id')
      ->select('tags.*')
      ->where('film_tags.id_video', '=', $id)
      ->get();

      return response($tags, 200);
    } catch (ModelNotFoundException $e) {
      return response('Invalid video id', 404);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
  }

  public function addTagToVideo(mixed $id_video, mixed $id_tag) {
    try {
      Video::findOrFail($id_video);
      Tag::findOrFail($id_tag);

      $film_tag = new FilmTag;
      $film_tag->id_video = $id_video;
      $film_tag->id_tag = $id_tag;
      $film_tag->save();

      return response('Tag added', 201);
    } catch (ModelNotFoundException $e) {
      return response('Invalid video or tag id', 404);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
  }

  public function deleteAllTagsFromVideo(mixed $id) {
    try {
      Video::findOrFail($id);
      $deleted = FilmTag::where('id_video', '=', $id)->delete();

      return response('All tags deleted from video', 200);
    } catch (ModelNotFoundException $e) {
      return response('Invalid video id', 404);
    }
  }

  public function deleteTagFromVideo(mixed $id_video, mixed $id_tag) {
    try {
      Tag::findOrFail($id_tag);
      Video::findOrFail($id_tag);
      $deleted = FilmTag::where('id_video', '=', $id_video)
      ->where('id_tag', '=', $id_tag)
      ->delete();

      return response('Tag deleted from video', 200);
    } catch (ModelNotFoundException $e) {
      return response('Invalid video or tag id', 404);
    }
  }
}