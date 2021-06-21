<?php


namespace App\Rules;


interface RuleMaker
{
    /**
     * Return specific rules for an action.
     * @return array
     */
    public function rules(): array;
}
