<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface UserServiceInterface
{


    /**
     * index
     *
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse;


    /**
     * store
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse;



    /**
     * update
     *
     * @param  Request $request
     * @param  User $User
     * @return JsonResponse
     */
    public function update(Request $request, User $User): JsonResponse;



    /**
     * destroy
     *
     * @param  User $User
     * @return JsonResponse
     */
    public function destroy(User $User): JsonResponse;

}
