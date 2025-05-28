<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CleanText implements Rule
{
    protected $maxLength;

    public function __construct($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function passes($attribute, $value)
    {
        // Loại bỏ HTML
        $cleaned = strip_tags($value);

        return strlen($cleaned) <= $this->maxLength;
    }

    public function message()
    {
        return 'Trường :attribute không được vượt quá ' . $this->maxLength . ' ký tự.';
    }
}
