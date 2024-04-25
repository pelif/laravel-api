<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use App\Traits\ValidateUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserService implements UserServiceInterface
{

    use ValidateUser;

    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::orderBy('name', 'asc')->get();
        return response()->json($users, 200);
    }


    /**
     * store
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = $this->validateStore($request);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        if($user->save()) {
            return response()->json($user, 200);
        }

        return response()->json(['fail' => 'Error of Persistence'], 400);
    }



    /**
     * update
     *
     * @param  Request $request
     * @param  User $User
     * @return JsonResponse
     */
    public function update(Request $request, User $User): JsonResponse
    {
        $validator = $this->validateStore($request);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::find($User->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        if($user->save()) {
            return response()->json($user, 200);
        }

        return response()->json(['fail' => 'Error of Persistence'], 400);
    }



    /**
     * destroy
     *
     * @param  User $User
     * @return JsonResponse
     */
    public function destroy(User $User): JsonResponse
    {
        if(!$this->validateEntityParam($User)) {
            return response()->json(['fail' => 'Invalid passed parameter!'], 400);
        }

        $user = User::find($User->id);
        if($user->delete()) {
            return response()->json(['deleted' => 'User deleted with success'], 200);
        }
        return response()->json(['fail' => 'User not deleted'], 200);
    }

}
