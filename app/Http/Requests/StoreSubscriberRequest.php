<?php

namespace App\Http\Requests;

use App\Rules\SearchTest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreSubscriberRequest extends FormRequest
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
            'name' => 'required|regex:/^[\pL\pM\p{Zs}.-]+$/u',
            'email' => ['required', 'unique:subscribers', 'email:rfc,dns', new SearchTest],
            'notice_of_privacy' => 'required|integer|min:1|max:1'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => 400
        ], 400));
    }

    public function messages()
    {
        return [
            'name.regex' => 'El formato del nombre es incorrecto.',
            'name.required' => 'Por favor ingresa un nombre',
            'email.required' => 'Por favor ingresa un correo electrónico.',
            'email.unique' => 'Lo sentimos este correo electrónico ya fue registrado.',
            'email.email' => 'Formato de correo electrónico incorrecto.',
            'email.rfc' => 'Formato de correo electrónico incorrecto.',
            'notice_of_privacy.required' => 'Se debe aceptar el Aviso de Privacidad.',
            'notice_of_privacy.min' => 'Se debe aceptar el Aviso de Privacidad.',
            'notice_of_privacy.max' => 'Se debe aceptar el Aviso de Privacidad.',
        ];
    }
}
