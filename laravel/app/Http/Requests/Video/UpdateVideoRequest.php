<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UpdateVideoRequest extends FormRequest
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
    return [
      'title' => ['required_without_all:path,short_desc,full_desc', 'string', 'max:70'],
      'path' => ['required_without_all:title,short_desc,full_desc', 'string'],
      'short_desc' => ['required_without_all:title,path,full_desc', 'string', 'max:50'],
      'full_desc' => ['required_without_all:title,path,short_desc', 'string', 'max:1000']
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
