<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Http\Requests\Video\AddVideoRequest;
use App\Http\Requests\Video\UpdateVideoRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VideoController extends Controller {
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

  public function add(AddVideoRequest $request) {
    try {
      $data = $request->validated();

      $video = new Video;
      $video->title = $data['title'];
      $video->path = $data['path'];
      $video->short_desc = $data['short_desc'] ?? '';
      $video->full_desc = $data['full_desc'] ?? '';
      $video->save();

      return response('Video added', 201);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
  }

  public function update(UpdateVideoRequest $request, mixed $id) {
    try {
      $data = $request->validated();
      $video = Video::findOrFail($id);

      foreach(array_keys($data) as $key) {
        $video->$key = $data[$key];
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