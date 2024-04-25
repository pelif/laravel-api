<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * List of user
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->service->index();
    }

    /**
     * store user
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return $this->service->store($request);
    }

    /**
     * update user data
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function update(Request $request, User $user): JsonResponse
    {
        return $this->service->update($request, $user);
    }

    /**
     * destroy user
     *
     * @param  User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        return $this->service->destroy($user);
    }
}
