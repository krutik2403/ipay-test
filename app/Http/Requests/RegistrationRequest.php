<?php

namespace App\Http\Requests;

use Crypt;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

class RegistrationRequest extends BaseRequest
{


    public function __construct(Request $request)
    {
        $request->request->set('dob', ($request->dob) ? date('Y-m-d', strtotime($request->dob)) : '');
    }
    /* Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $roles = implode(',',User::$roles_slug);
        return [
            "name" => "required|string|min:2|max:191|regex:/^[a-zA-Z ]+$/u",
            "email" => "required|email|unique:users,email,null,id",
            "role" => "required|in:".$roles,
            "dob" => "required|date",
            "age" => "required|digits_between:1,100",
            "profile_picture" => ($this->hasFile('profile_picture')) ? "required|image|mimes:jpeg,png|max:10240" : '',
            "address" => "required|min:2",
            "password_confirmation"=>"required|min:5",
            "password"=>"required|confirmed|min:5"
        ];
    }

    public function messages()
    {
        return [
            'profile_picture.image' => "The user photo must be an image.",
            'role.in' => "Invalid role selected."
        ];
    }
}
