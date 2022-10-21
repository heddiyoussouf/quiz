<?php

namespace Modules\Auth\Rules;
use Modules\Auth\Enums\UserTypeEnum;
use Illuminate\Contracts\Validation\Rule;

class TypeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !is_null(UserTypeEnum::tryFrom($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'this type doesnt exist';
    }
}
