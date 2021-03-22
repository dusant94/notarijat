<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NaturalPeopleRequest extends FormRequest
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
            // 'ordinal_number' => ['required','max:100'],
            'jmbg' => ['required','max:13'],
                    'first_name' => ['required','max:100'],
                       'fathers_name' => ['required','max:100'],
                      'last_name' => ['required','max:100'],
                    //    'place'
                    //  'street_address'
                       'date_of_birth' => ['required','max:100'],
                      'place_of_birth' => ['required','max:100'],
                //       'profession'
                //        'phone_no'
                //        'mobile_no'
                //      'fax'
                //        'email'
                //        'gender'
                //        'role'
                //       'marital_status'
                //      'identity_established'
                //     'identity_card_number'
                //    'identity_card_issued'
                //       'identity_card_expiration'
                //       'identity_card_permanently'
                //       'identity_card_issue_place'
                //       'note'
            //
        ];
    }
}

