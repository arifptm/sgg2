<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'name' => 'required|min:5:max:20',
            'email' => 'required|email|unique:users,email,'.$this->id.',id',
            'password' => 'nullable|min:5|max:20',
            'password_confirm' => 'same:password',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Kolom nama harus diisi..!',
            'name.min' => 'Isilah antara 5-20 karakter..!',
            'name.max' => 'Isilah antara 5-20 karakter..!',
            'email.required' => 'Kolom email harus diisi..!',
            'email.email' => 'Alamat email tidak valid..!',
            'email.unique' => 'Alamat email sudah digunakan..!',
            'password.min' => 'Isilah antara 5-20 karakter..!',
            'password.max' => 'Isilah antara 5-20 karakter..!',
            'password_confirm.same' => 'Tidak sesuai dengan kolom password',

        ];
    }    
}
