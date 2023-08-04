<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UpdateUserRequest extends FormRequest
{
  protected $stopOnFirstFailure = true;
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
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    return [
      'name' => ['unique:App\Models\User', 'max:20', 'required_without_all:password'],
      'password' => ['required_without_all:name', "regex:$passwordRegex"]
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
      return [
          'password.regex' => 'Password must be at least 8 characters long, contain at least 1 lowercase letter, 1 uppercase letter, 1 digit and 1 special character'
      ];
  }

  protected function failedValidation(Validator $validator)
  {
    if($this->wantsJson())
    {
      $response = response()->json([
        'success' => false,
        'message' => 'Bad request',
        'errors' => $validator->errors()
      ]);        
    }else{
      $response = response([
        'success' => false,
        'message' => 'Bad request',
        'errors' => $validator->errors()
      ], 400);
    }
        
    throw (new ValidationException($validator, $response))
      ->errorBag($this->errorBag)
      ->redirectTo($this->getRedirectUrl());
  }
}
