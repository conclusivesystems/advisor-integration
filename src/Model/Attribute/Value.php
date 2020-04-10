<?php namespace Consys\Advisor\Integration\Model\Attribute;

use Consys\Advisor\Integration\Model\Model;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Value extends Model
{
    static protected $rules = [
        'start' => "date",
        'end' => "date",
        'content' => "present|max:255",
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('value');

        if($this->get('start') !== null)
        {
            $writer->startProperty('start');
            $writer->value($this->get('start'));
            $writer->endProperty();
        }
        if($this->get('end') !== null)
        {
            $writer->startProperty('end');
            $writer->value($this->get('end'));
            $writer->endProperty();
        }
        $writer->value($this->get('content'));

        $writer->endObject();
    }
}
