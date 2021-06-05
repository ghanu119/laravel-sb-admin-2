<?php

namespace App\Rules;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class CategorySubCategoryNotSame implements Rule
{
    private $id = '';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct( $id = null)
    {
        //
        $this->id = $id;
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
        if( !is_null( $this->id ) ) {
            $exists = Category::where('parent_category', $this->id)
                                ->find( $value );
            if( !is_null( $exists ) ){
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
        return 'The :attribute is already a child of current category.';
    }
}
