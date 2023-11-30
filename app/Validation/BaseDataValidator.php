<?php

namespace App\Validation;

use Illuminate\Support\Facades\Validator;

abstract class BaseDataValidator implements IDataValidator
{
    public function validate(array $data, int $id = null) : \Illuminate\Contracts\Validation\Validator{


        if($id != null){
            $data = array_filter($data);

            $rules = array_filter($this->getRules($id), function($key) use($data){
              return array_key_exists($key, $data);
            }, ARRAY_FILTER_USE_KEY);

            return Validator::make($data, $rules, $this->getMessages());
        }

        return Validator::make($data, $this->getRules(), $this->getMessages());
    }
}
