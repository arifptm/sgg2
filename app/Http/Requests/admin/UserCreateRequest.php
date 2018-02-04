<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:20',
            'password_confirm' => 'same:password',
            'roles.*' => 'required',
            'department_id' => 'required_if:roles,laboran',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Kolom nama harus diisi..!',
            'name.min' => 'Isilah antara 5-20 karakter..!',
            'name.max' => 'Isilah antara 5-20 karakter..!',
            'email.required' => 'Kolom email harus diidi..!',
            'email.email' => 'Alamat email tidak valid..!',
            'email.unique' => 'Alamat email sudah digunakan..!',
            'password.required' => 'Kolom password harus diisi..!',
            'password.min' => 'Isilah antara 5-20 karakter..!',
            'password.max' => 'Isilah antara 5-20 karakter..!',
            'password_confirm.same' => 'Tidak sesuai dengan kolom password',
            'roles.*.required' => 'Silakan pilih minimal satu peranan..!',
            'department_id.required_if' => 'Silakan pilih salah satu departemen..!',

        ];
    }
}
