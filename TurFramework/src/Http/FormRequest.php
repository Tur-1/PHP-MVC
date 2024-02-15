<?php

namespace TurFramework\Http;

use RuntimeException;
use TurFramework\Validation\Validator;

abstract class FormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected function authorize(): bool
    {
        throw new RuntimeException(get_class($this) . ' does not implement authorize method.');
    }
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    protected function messages()
    {
        return [];
    }
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData($rules)
    {
        return $this->only(array_keys($rules));
    }

    /**
     * Get request rules
     *
     * @return array
     *
     * @throws \RuntimeException
     */
    protected function rules()
    {
        throw new RuntimeException(get_class($this) . ' does not implement rules method.');
    }

    public function validated()
    {
        if ($this->authorize()) {
            $rules = $this->rules();

            $vaildator = $this->createValidator($this->validationData($rules), $rules);

            $validatedRequest = $vaildator->validate();

            if ($vaildator->fails()) {
                throw redirect()->back()->withErrors($vaildator->getErrors());
            }

            return $validatedRequest;
        } else {
            abort(403);
        }
    }



    private function createValidator($data, $rules)
    {
        return new Validator($data, $rules, $this->messages());
    }
}
