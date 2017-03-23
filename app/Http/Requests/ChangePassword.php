<?php

namespace App\Http\Requests;

class ChangePassword extends Request
{
    /**
     * Determine if the user is authorized to make this request.
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
    public function rules()
    {
        return [
            "new_password" => "required|min:6",
            "c_new_password" => "required|same:new_password"
        ];
    }


}
