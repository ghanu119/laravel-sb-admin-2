<?php

namespace App\Rules;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class ParentCategoryLevelCheck implements Rule
{
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        //
        if( !is_null( $value ) ) {
            $exists = Category::with('parentCategory.parentCategory')->find( $value );
            
            if( !empty( $exists->parentCategory->parentCategory->id ) ){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute can\'t be parent of another category. Must select another category.';
    }
}
