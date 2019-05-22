<?php namespace Consys\Advisor\Integration\Model\Prerequisite;

use Consys\Advisor\Integration\Model\Model;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Course extends Model
{
    static protected $rules = [
        'coreq' => "in:y,n",
        'key' => "present|max:255",
        'prefix' => "present|max:255",
        'number' => "present|max:255",
        'suffix' => "present|max:255",
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('course');

        if($this->get('coreq') !== null)
        {
            $writer->startProperty('coreq');
            $writer->value($this->get('coreq'));
            $writer->endProperty();
        }

        foreach(static::fields() as $field)
        {
            if($this->get($field) !== null && $field !== 'coreq')
            {
                $writer->startObject($field);
                $writer->value($this->get($field));
                $writer->endObject();
            }
        }

        $writer->endObject();
    }
}
