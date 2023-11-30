<?php

namespace App\Validation;

use App\Models\User;
use Illuminate\Validation\Rule;

/**
 * @author Renan Salustiano <renansalustiano2020@gmail.com>
 */
class UserValidator extends BaseDataValidator
{

    function getRules(int $id = null): array
    {

        $rules = array(
            'name' => 'required|max:255|string',
            'password' => 'required|min:8|max:18',
            'email' => ['required', 'max:255', 'email']);

        if($id != null){
            $rules['email'][] =  Rule::unique(User::class, 'email')->ignore($id);
        }else{
            $rules['email'][] =  Rule::unique(User::class, 'email');
        }

        return $rules;
    }

    function getMessages(): array
    {
        return array(
            'name.required' => 'O campo nome é obrigatório',
            'name.max' => 'O campo nome deve conter no máximo :max caracteres',
            'email.required' => 'O campo email é obrigatório'
        );
    }
}
