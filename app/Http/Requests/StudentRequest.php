<?php

namespace App\Http\Requests;

use Crypt;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

class StudentRequest extends BaseRequest
{


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
        return [
            "first_name" => "required|string|min:2|max:191|regex:/^[a-zA-Z ]+$/u",
            "last_name" => "required|string|min:2|max:191|regex:/^[a-zA-Z ]+$/u",
            "address" => "required|min:2",
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
