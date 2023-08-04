<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\AddUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function showAll() {
        try {
            return response(User::all(), 200);
        } catch (Exception $e) {
            return response('Bad request', 400);
        }
    }

    public function showById(mixed $id) {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response('Invalid user id', 404);
        }
        return response($user, 200);
    }

    public function showByTitle(mixed $key) {
        try {
            return response(User::where('name', 'LIKE', "%$key%")->get(), 200);
        } catch (Exception $e) {
            return response('Bad request', 400);
        }
    }

    public function add(AddUserRequest $request) {
        try {
            $data = $request->validated();

            $user = new User;
            $user->name = $data['name'];
            $user->password = $data['password'];
            $user->save();

            return response('User added', 201);
        } catch (Exception $e) {
            return response('Bad request', 400);
        }
    }

    public function update(UpdateUserRequest $request, mixed $id) {
        try {
            $user = User::findOrFail($id);
            $data = $request->validated();
            foreach(array_keys($data) as $key) {
                $user->$key = $data[$key];
            }
            $user->save();

            return response('User updated', 200);
        } catch (ModelNotFoundException $e) {
            return response('Invalid user id', 404);
        } catch (Exception $e) {
            return response('Bad request', 400);
        }
    }

    public function delete(mixed $id) {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response('User deleted', 200);
        } catch (ModelNotFoundException $e) {
            return response('Invalid user id', 404);
        } catch (Exception $e) {
            return response('Bad request', 400);
        }
    }
}
