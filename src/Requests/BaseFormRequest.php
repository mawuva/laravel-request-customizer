<?php

namespace Mawuekom\RequestCustomizer\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Mawuekom\FormRequest\Http\FormRequest;

/**
 * Abstract Class BaseFormRequest
 * 
 * @package Mawuekom\RequestCustomizer\Requests
 */
abstract class BaseFormRequest extends FormRequest
{
    /**
     * ValidateResolved
     *
     * @return void
     */
    public function validateResolved()
    {
        parent::validateResolved();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize(): bool;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules(): array;

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator): void
    {
        if($this->wantsJson()) {
            $response = $this ->failedApiValidation($validator);
        }
        
        else{
            $response = redirect()
                ->back()
                ->with('message', trans('sentences.error_occured'))
                ->withInput()
                ->withErrors($validator);
        }
        
        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

    /**
     * Format failed validation for API
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function failedApiValidation(Validator  $validator): JsonResponse
    {
        $transformed = [];

        foreach ($validator->errors() ->messages() as $field => $message) {
            $transformed[] = [
                'field' => $field,
                'message' => $message[0]
            ];
        }

        return response() ->json([
            'status'    => 'failed', 
            'message'   => 'Oops ! An error occurred',
            'errors'    => $transformed
        ]);
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\UnauthorizedException
     */
    protected function failedAuthorization(): void
    {
        if($this->wantsJson()) {
            throw new HttpResponseException(response()->json(['status' => 'failed', 'errors' => 'Unauthorized'], 401));
        }
        
        else{
            throw new AuthorizationException;
        }
    }
}
