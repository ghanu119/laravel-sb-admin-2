<?php

namespace App\Rules;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Contracts\Validation\Rule;

class ProductAttributeValidate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct( )
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
        $attrIds = explode( '.', $attribute);
        if( count( $attrIds ) > 1){
            $result = true;
            $attr = Attribute::find( $attrIds[1] );
            if( !is_null( $attr ) && is_array( $value ) ){
                foreach( $value as $attrVal ){
                    $attrValData = AttributeValue::where( 'attr_id', $attr->id)
                                            ->where('id', $attrVal )
                                            ->first();
                    if( is_null( $attrValData ) ){
                        $result = false;
                        break;
                    }

                }
                return $result;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute not exists. Please reupload and try again.';
    }
}
