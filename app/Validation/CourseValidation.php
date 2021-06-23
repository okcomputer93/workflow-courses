<?php


namespace App\Validation;


use App\Rules\Course\CourseRules;
use Illuminate\Support\Facades\Validator;

class CourseValidation implements Validation
{
    private CourseRules $courseRules;

    /**
     * CourseValidation constructor.
     * @param CourseRules $courseRules
     */
    public function __construct(CourseRules $courseRules)
    {
        $this->courseRules = $courseRules;
    }


    /**
     * @param array $input
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(array $input)
    {
        Validator::make(
            $input,
            $this->courseRules->rules()
        )->validate();
    }

    /**
     * Return only the valid for an input given the course rules.
     * @param array $input
     * @return array
     */
    public function courseAttributes(array $input): array
    {
        return array_intersect_key(
            $input,
            $this->courseRules->rules()
        );
    }
}
