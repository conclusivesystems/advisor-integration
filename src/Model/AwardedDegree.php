<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Model\Attribute\Attribute;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class AwardedDegree extends Model
{
    static protected $rules = [
        'id' => 'required|max:255',
        // this is not the Advisor internal academic_goal_id; this is the foreign key of the academic goal
        'academic_goal_id' => 'max:255',
        'program_type' => 'required|max:255',
        'program' => 'required|max:255',
        'entered' => 'date',
        'conferred' => 'date',
        'transcript_note' => 'max:4096',
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('awarded_degree');
        $writer->startProperty('id');
        $writer->value($this->get('id'));
        $writer->endProperty();

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
