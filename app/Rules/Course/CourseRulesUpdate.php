<?php


namespace App\Rules\Course;


class CourseRulesUpdate implements CourseRules
{
    protected array $rules;
    protected CourseRules $courseRules;

    /**
     * CourseRulesUpdate constructor.
     */
    public function __construct(CourseRules $courseRules)
    {
        $this->courseRules = $courseRules;

        $this->rules = [
            'miniature' => [
                'sometimes',
                'required',
                'image'
            ]
        ];
    }

    /**
     * Return the modified rules for a course update.
     * @return array
     */
    public function rules(): array
    {
        return array_replace($this->courseRules->rules(), $this->rules);
    }
}
