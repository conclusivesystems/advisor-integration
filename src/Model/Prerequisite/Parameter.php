<?php namespace Consys\Advisor\Integration\Model\Prerequisite;

use Consys\Advisor\Integration\Model\Model;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Parameter extends Model
{
    static protected $rules = [
        'type' => 'required|in:student,course',
        'field' => 'required|max:255',
        'operator' => 'required|in:=,!=,>,>=,<,<=,contains,not_contains,in_set,not_in_set',
        'value' => 'present|max:255',
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('parameter');

        if($this->get('type') !== null)
        {
            $writer->startProperty('type');
            $writer->value($this->get('type'));
            $writer->endProperty();
        }

        foreach(static::fields() as $field)
        {
            if($this->get($field) !== null && $field !== 'type')
            {
                $writer->startObject($field);
                $writer->value($this->get($field));
                $writer->endObject();
            }
        }

        $writer->endObject();
    }
}
