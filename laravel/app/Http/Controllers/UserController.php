<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    // check if $array only contains keys specified in $validKeys
    private function arrayContainsOnly(array $array, array $validKeys) {
        foreach (array_keys($array) as $key) {
            if (!in_array($key, $validKeys)) {
                return false;
            }
        }
        return true;
    }

    public function showById(mixed $id = null) {
        if ($id == null) {
            try {
                return response(User::all(), 200);
            } catch (Exception $e) {
                return response('Bad request', 400);
            }
        } else {
            try {
                $user = User::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                return response('Invalid user id', 404);
            }
            return response($user, 200);
        }
    }

    public function showByTitle(mixed $key) {
        try {
            return response(User::where('name', 'LIKE', "%$key%")->get(), 200);
        } catch (Exception $e) {
            return response('Bad request', 400);
        }
    }

    public function add(Request $request) {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->password = $request->password;
            $user->save();

            return response('User added', 201);
        } catch (Exception $e) {
            return response('Bad request', 400);
        }
    }

    public function update(Request $request, mixed $id) {
        $validKeys = ['name', 'password'];
        try {
            $user = User::findOrFail($id);
            if (!$request->hasAny($validKeys) || !$this->arrayContainsOnly($request->all(), $validKeys)) {
                return response('Bad request', 400);
            }
            foreach(array_keys($request->all()) as $key) {
                $user->$key = $request->$key;
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
