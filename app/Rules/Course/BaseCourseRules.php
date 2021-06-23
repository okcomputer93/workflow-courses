<?php


namespace App\Rules\Course;


class BaseCourseRules implements CourseRules
{
    protected array $rules;

    /**
     * BaseCourseRules constructor.
     */
    public function __construct()
    {
        $this->rules = [
            'title' => 'required',
            'description' => 'required',
            'miniature' =>  [
                'required',
                'image'
            ],
            'category_id' => [
                'required',
                'exists:App\Models\Category,id'
            ],
            'level_id' => [
                'required',
                'exists:App\Models\Level,id'
            ],
            'rate' => [
                'nullable',
                'numeric',
                'between:1,5'
            ],
            'video_url' => [
                'required',
                'url'
            ],
        ];
    }


    /**
     * Return the base rules for a course.
     * @return array
     */
    public function rules(): array
    {
        return $this->rules;
    }
}
