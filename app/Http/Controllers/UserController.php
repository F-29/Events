<?php

namespace App\Http\Controllers;

use App\Events\RegisterUserEvent;
use App\Http\Requests\user\CreateRequest;
use App\Http\Requests\user\UpdateRequest;
use App\Http\Resources\UserResourceCollection;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /** outputs all users
     *
     * @return UserResourceCollection
     */
    public function index()
    {
        $users = User::paginate(4);
        $users->load('articles');
        return new UserResourceCollection($users);
    }

    /** outputs THE user that matches the id = $id
     *
     * @param int $id user's id
     * @return mixed
     */
    public function get_by_id(int $id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user->load('articles'));
    }

    /** creates an user.
     *
     * @param CreateRequest $request
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt((string)$request->password),
        ]);
        event(new RegisterUserEvent($user));

        return $user;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, int $id)
    {
        /**
         * @var \Illuminate\Database\Eloquent\Model $user
         */
        $user = User::findOrFail((int)$id);
        $data = $request->only(['name', 'password']);
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);

        return response($user, 202);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(int $id)
    {
        /**
         * @var \Illuminate\Database\Eloquent\Model $user
         */
        $user = User::findOrFail((int)$id);
        /** @noinspection PhpUnhandledExceptionInspection */
        $user->delete();

        return response(null, 204);
    }

}
