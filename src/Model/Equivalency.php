<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Equivalency extends Model
{
    static protected $rules = [
        'original_course_id' => 'max:255',
        'original_course_prefix' => 'max:255',
        'original_course_number' => 'max:255',
        'original_course_suffix' => 'max:255',
        'target_course_id' => 'max:255',
        'target_course_prefix' => 'max:255',
        'target_course_number' => 'max:255',
        'target_course_suffix' => 'max:255',
        'start_term_year' => 'integer|between:1000,9999',
        'start_term_code' => 'max:255',
        'end_term_year' => 'integer|between:1000,9999',
        'end_term_code' => 'max:255',
        'notes' => 'max:255',
        'program_code' => 'max:255',
        'program_type_code' => 'max:255',
        'course_option1_value' => 'max:255',
        'course_option2_value' => 'max:255',
        'course_option3_value' => 'max:255',
        'course_option4_value' => 'max:255',
        'course_option5_value' => 'max:255',
        'course_option6_value' => 'max:255',
        'course_option7_value' => 'max:255',
        'course_option8_value' => 'max:255',
        'course_option9_value' => 'max:255',
        'course_option10_value' => 'max:255',
        'course_option11_value' => 'max:255',
        'course_option12_value' => 'max:255',
        'course_option13_value' => 'max:255',
        'course_option14_value' => 'max:255',
        'course_option15_value' => 'max:255',
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('equivalency');

        foreach(static::fields() as $field)
        {
            if($this->get($field) !== null && $field !== 'id')
            {
                $writer->startObject($field);
                $writer->value($this->get($field));
                $writer->endObject();
            }
        }

        $writer->endObject();
    }
}
