<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VideoController extends Controller {
  // check if $array only contains keys specified in $validKeys
  private function arrayContainsOnly(array $array, array $validKeys) {
    foreach (array_keys($array) as $key) {
        if (!in_array($key, $validKeys)) {
            return false;
        }
    }
    return true;
  }

  public function showAll() {
    try {
      return response(Video::all(), 200);
    } catch (Exception $e) {
        return response('Bad request', 400);
    }
  }

  public function showById(mixed $id) {
    try {
        $video = Video::findOrFail($id);
    } catch (ModelNotFoundException $e) {
        return response('Invalid video id', 404);
    }
    return response($video, 200);
  }

  public function showByTitle(mixed $key) {
      try {
          return response(Video::where('title', 'LIKE', "%$key%")->get(), 200);
      } catch (Exception $e) {
          return response('Bad request', 400);
      }
  }

  public function showByTag(mixed $tagId) {
    try {
      $videos = Video::join('film_tags', 'videos.id', '=', 'film_tags.id_video')
      ->join('tags', 'film_tags.id_tag', '=', 'tags.id')
      ->select('videos.*')
      ->where('tags.id', '=', $tagId)
      ->get();
      return response($videos, 200);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
  }

  public function showByTitleAndTag(mixed $key, mixed $tagId) {
    try {
      $videos = Video::join('film_tags', 'videos.id', '=', 'film_tags.id_video')
      ->join('tags', 'film_tags.id_tag', '=', 'tags.id')
      ->select('videos.*')
      ->where('tags.id', '=', $tagId)
      ->where('videos.title', 'LIKE', "%$key%")
      ->get();
      return response($videos, 200);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
  }

  public function add(Request $request) {
      try {
          if (!$request->has(['title', 'path'])) {
            return response('Bad request', 400);
          }

          $video = new Video;
          $video->title = $request->title;
          $video->path = $request->path;
          $video->short_desc = $request->short_desc ?? '';
          $video->full_desc = $request->full_desc ?? '';
          $video->save();

          return response('Video added', 201);
      } catch (Exception $e) {
          return response('Bad request', 400);
      }
  }

  public function update(Request $request, mixed $id) {
      $validKeys = ['title', 'path', 'short_desc', 'full_desc'];
      try {
          $video = Video::findOrFail($id);
          if (!$request->hasAny($validKeys) || !$this->arrayContainsOnly($request->all(), $validKeys)) {
              return response('Bad request', 400);
          }
          foreach(array_keys($request->all()) as $key) {
              $video->$key = $request->$key;
          }
          $video->save();

          return response('Video updated', 200);
      } catch (ModelNotFoundException $e) {
          return response('Invalid video id', 404);
      } catch (Exception $e) {
          return response('Bad request', 400);
      }
  }

  public function delete(mixed $id) {
      try {
          $video = Video::findOrFail($id);
          $video->delete();

          return response('Video deleted', 200);
      } catch (ModelNotFoundException $e) {
          return response('Invalid video id', 404);
      }
  }
}