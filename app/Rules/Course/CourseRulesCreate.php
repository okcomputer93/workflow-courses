<?php


namespace App\Rules\Course;


class CourseRulesCreate implements CourseRules
{
    protected array $rules;
    protected CourseRules $courseRules;

    /**
     * CourseRulesCreate constructor.
     */
    public function __construct(CourseRules $courseRules)
    {
        $this->courseRules = $courseRules;

        $this->rules = [
            'miniature' => [
                'required',
                'image'
            ]
        ];
    }


    /**
     * Return the modified rules for a course creation.
     * @return array
     */
    public function rules(): array
    {
       return array_replace($this->courseRules->rules(), $this->rules);
    }
}
