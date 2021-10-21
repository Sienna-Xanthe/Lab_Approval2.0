<?php


namespace App\Http\Requests\SuperAdmin;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class addAdminRequest extends FormRequest
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
    protected function failedValidation(Validator $validator){

        throw(new HttpResponseException(json_fail('参数错误',$validator->errors()->all(),422)));
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required' ,
            'position'=>'required' ,
            'number'=>'required' ,
            'password'=>'required',
            'phone'=>array(
                'required',
                'regex:/^1[0-9]{10}$/'
            ),
            'email'=>array(
                'required',
                'regex:/^\w+@[a-z0-9]+\.[a-z]{2,4}$/'
            )
        ];
    }
}
