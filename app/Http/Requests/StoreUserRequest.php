<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    static public function templateRule()
    {
        return [
            'username' => 'required|string|unique:users',
            'name' => 'string',
            'lastname' => 'string',
            'emails' => [
                'required',
                function ($attr, $value, $fail) {
                    $reducer = function ($c, $i) {
                        $c = $c && filter_var($i, FILTER_VALIDATE_EMAIL);
                        return $c;
                    };
                    if (is_array($value)) {
                        if (!array_reduce($value, $reducer, true)) {
                            $fail('One or more emails are invalid');
                        }
                    } else {
                        if (!array_reduce(
                            preg_split(
                                "/ *[;,] */",
                                preg_replace(
                                    "/[\"'`]*/",
                                    "",
                                    trim($value)
                                )
                            ),
                            $reducer,
                            true
                        )) {
                            $fail('One or more emails are invalid');
                        }
                    }
                }
            ],
        ];
    }
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
        return self::templateRule();
    }
}
