<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        $errors = null;

        return $this->sendJson($user, $errors, Response::HTTP_OK);
    }

    public function show(int $id)
    {
        $user = User::find($id);
        $errors = null;

        return $this->sendJson($user, $errors, $user == null ? Response::HTTP_NOT_FOUND : Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $id = 0;
        $user = null;
        $errors = null;
        $statusCode = Response::HTTP_CREATED;

        $validator = User::validate($request->all());

        if ($validator->fails())
        {
            $errors = $validator->errors();

            $statusCode = Response::HTTP_BAD_REQUEST;
        }
        else
        {
            $user = User::create($request->all());

            $id = $user->id;
        }

        return $this->sendJson($id, $errors, $statusCode);
    }

    public function update(Request $request, int $id)
    {
        $user = User::find($id);
        $errors = null;
        $statusCode = Response::HTTP_OK;

        if ($user == null) {
            $statusCode = Response::HTTP_NOT_FOUND;
        } else {
            $validator = User::validate($request->all());

            if ($validator->fails())
            {
                $errors = $validator->errors();

                $statusCode = Response::HTTP_BAD_REQUEST;
            }
            else
            {
                $user->update($request->all());
            }
        }

        return $this->sendJson(null, $errors, $statusCode);
    }

    public function delete(int $id)
    {
        $user = User::find($id);

        if ($user != null) {
            $user->delete();
        }

        return $this->sendJson($user, $errors, $user == null ? Response::HTTP_NOT_FOUND : Response::HTTP_OK);
    }
}
