<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Message extends Model
{
    static protected $rules = [
        'type' => "required|max:255",
        'message' => "present|max:16777215",
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('message');

        $writer->startProperty('type');
        $writer->value($this->get('type'));
        $writer->endProperty();

        $writer->value($this->get('message'));

        $writer->endObject();
    }
}
