<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

trait ValidateUser
{

    /**
     * validateStore of a Schedule
     *
     * @param  mixed $request
     * @return ValidationValidator
     */
    public function validateStore(Request $request): ValidationValidator
    {
        $inputs = $request->all();

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255'
        ];

        $msg = ['required' => ':attribute is mandatory'];

        return Validator::make($inputs, $rules, $msg);

    }


    /**
    * validateEntityParam Schedule on certain methods
    *
    * @param  User $schedule
    * @return bool
    */
    public function validateEntityParam(User $user): bool
    {
        if($user !== null && isset($user->id)) {
            return true;
        }
        return false;
    }


}
