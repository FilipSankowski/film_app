<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\User;
use App\Models\WatchLaterVideo;
use App\Http\Requests\WatchLater\AddWatchLaterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WatchLaterController extends Controller {
  public function showAll() {
    try {
      return response(WatchLaterVideo::all(), 200);
    } catch (Exception $e) {
        return response('Bad request', 400);
    }
  }

  public function showById(mixed $id) {
    try {
      $video = WatchLaterVideo::findOrFail($id);
    } catch (ModelNotFoundException $e) {
        return response('Invalid video id', 404);
    }
    return response($video, 200);
  }

  public function showByUser(mixed $id) {
    try {
      return response(WatchLaterVideo::where('id_user', '=', $id)->get(), 200);
    } catch (Exception $e) {
        return response('Bad request', 400);
    }
  }

  public function showByVideo(mixed $id) {
    try {
      return response(WatchLaterVideo::where('id_video', '=', $id)->get(), 200);
    } catch (Exception $e) {
        return response('Bad request', 400);
    }
  }

  public function add(AddWatchLaterRequest $request) {
    try {
      $data = $request->validated();
      User::findOrFail($data['id_user']);
      Video::findOrFail($data['id_video']);

      $video = new WatchLaterVideo;
      $video->id_user = $data['id_user'];
      $video->id_video = $data['id_video'];
      $video->save();

      return response('Video added to "watch later" videos', 201);
    } catch (ModelNotFoundException $e) {
      return response('Invalid user or video id', 404);
    } catch (Exception $e) {
      return response('Bad request', 400);
    }
  }
  
  public function delete(mixed $id) {
    try {
      $video = WatchLaterVideo::findOrFail($id);
      $video->delete();

      return response('Video deleted from "watch later" videos', 200);
    } catch (ModelNotFoundException $e) {
      return response('Invalid video id', 404);
    }
  }
}