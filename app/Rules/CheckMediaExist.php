<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckMediaExist implements Rule
{
    private $mediaPath = '';
    private $paramPath = '';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct( $params = null)
    {
        //
        $this->mediaPath = storage_path( config('app.common_upload_dir') ) . '/';
        $this->paramPath = storage_path( $params ) . '/';
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
        $value = urldecode( $value);
        return ( file_exists( $this->mediaPath . $value ) || ( !empty( $this->paramPath ) && file_exists( $this->paramPath . $value ) ) );
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
