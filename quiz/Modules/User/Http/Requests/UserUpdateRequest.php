<?php

namespace Modules\USer\Http\Requests;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Rules\TypeRule;
class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id=request()->id?request()->id:auth()->id();
        error_log('id is '.$id);
        request()->id?$this->merge(['id'=>request()->id]):null;
        return [
            "id"=>"sometimes|exists:users,id",
            "name"=>"sometimes|required|string|min:3",
            "email"=>"sometimes|required|email:rfc,dns|unique:users,email,".$id,
            "type"=>["sometimes","required",new TypeRule()],
            "password"=>["sometimes","required",Password::min(8)
            
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised()]
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
