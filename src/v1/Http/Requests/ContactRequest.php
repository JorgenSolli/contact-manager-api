<?php

namespace EcoOnline\ContactManagerApi\v1\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use EcoOnline\ContactManagerApi\v1\Models\Contact;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $contact = Contact::find($this->route('contact'));
        if ($contact) {
            return $contact->user_id == auth()->id();
        }

        return (bool) auth();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'first_name' => 'required|min:1',
            'last_name' => 'required|min:1',
            'email' => ['required', 'email:rfc,dns'],
            'phone_number' => ['required'],
            'linkedin_url' => 'url',
            'country' => 'required_with:city',
        ];

        /**
         * @todo abstact this these very similar rules into a UniquePerUser custom Rule
         */
        switch ($this->method()) {
            case 'POST':
                $rules['email'][] = [
                    Rule::unique('contacts', 'email')->where(function ($query) {
                        return $query->where('user_id', auth()->id());
                    }),
                ];

                $rules['phone_number'][] = [
                    Rule::unique('contacts', 'phone_number')->where(function ($query) {
                        return $query->where('user_id', auth()->id());
                    }),
                ];
                break;

            case 'PUT':
                $rules['email'][] = [
                    Rule::unique('contacts', 'email')->where(function ($query) {
                        return $query->where([
                            'user_id' => auth()->id(),
                            ['id', '!=', $this->route('contact')],
                        ]);
                    }),
                ];

                $rules['phone_number'][] = [
                    Rule::unique('contacts', 'phone_number')->where(function ($query) {
                        return $query->where([
                            'user_id' => auth()->id(),
                            ['id', '!=', $this->route('contact')],
                        ]);
                    }),
                ];
                break;

                // No validation for deleting a resource, but we still want to authorize the request.
            case 'DELETE':
                return [];

            default:
                break;
        }

        return $rules;
    }
}
