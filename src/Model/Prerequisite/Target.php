<?php namespace Consys\Advisor\Integration\Model\Prerequisite;

use Consys\Advisor\Integration\Model\Model;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Target extends Model
{
    static protected $rules = [
        'key' => "present|max:255",
        'prefix' => "present|max:255",
        'number' => "present|max:255",
        'suffix' => "present|max:255",
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('target');

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
