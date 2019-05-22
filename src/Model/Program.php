<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Program extends Model
{
    static protected $rules = [
        'type' => "required|max:255",
        'program' => "present|max:255",
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('program');

        $writer->startProperty('type');
        $writer->value($this->get('type'));
        $writer->endProperty();

        $writer->value($this->get('program'));

        $writer->endObject();
    }
}
