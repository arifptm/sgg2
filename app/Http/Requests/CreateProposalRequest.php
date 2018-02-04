<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProposalRequest extends FormRequest
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
            'name' => 'required',
            'unit' => 'required',
            'price' => 'required|numeric',
            'url' => 'url|nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama barang harus diisi !',
            'unit.required'  => 'Satuan harus diisi !',
            'price.required' => 'Perkiraan harga barang harus diisi !',
            'price.numeric' => 'Harga hanya bisa dengan angka !',
            'url.url' => 'URL tautan tidak valid !'
        ];
    }    
}
