<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class AddCommentRequest extends FormRequest
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
      'id_user' => ['required', 'integer', 'exists:App\Models\User,id'],
      'id_video' => ['required', 'integer', 'exists:App\Models\Video,id'],
      'text' => ['required', 'string', 'max:250'],
      'id_parent' => ['nullable', 'integer', 'exists:App\Models\Comment,id']
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
