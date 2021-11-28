<?php

namespace App\Validators;

use Exception;
use Illuminate\Support\Facades\Validator;

abstract class BaseValidator
{

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var Illuminate\Support\Facades\Validator
     */
    protected $validator;
    
    /**
     * create a validator to be used here
     *
     * @param array $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->validator = Validator::make($data, $this->rules());   
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Check if data is valid
     *
     * @return bool
     */
    public function validate()
    {
        if ($this->validator->fails()) {
            throw new Exception($this->validator->errors());
        }
        return true;
    }


}
