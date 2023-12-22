<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cname' => 'required|min:3',
            'cemail' => 'required|email|unique:App\Models\User,email',
            'cpassword'=>'required|min:6|regex:/^(?=.*[A-Z])(?=\S+$)/',
        ];
    }
    public function messages()
    {
        return [
            'cname.required'=>'Bạn chưa nhập Tên',
            'cname.min'=>'Tên tối thiểu là 3 ký tự',
            'cemail.required'=>'Bạn chưa nhập địa chỉ Email',
            'cemail.unique'=>'Địa chỉ Email đã tồn tại',
            'cemail.email'=>'Địa chỉ Email của bạn không hợp lệ',
            'cpassword.required'=>'Bạn chưa nhập password',
            'cpassword.min'=>'Password tối thiểu là 6 ký tự',
            'cpassword.regex'=>'Ít nhất một ký tự viết hoa và không có dấu cách'
        ];
    }
}
