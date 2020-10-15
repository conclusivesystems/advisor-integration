<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Sport extends Model
{
    static protected $rules = [
        'code' => "required|max:255",
        'title' => "present|max:255",
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('sport');

        $writer->startProperty('code');
        $writer->value($this->get('code'));
        $writer->endProperty();

        $writer->startObject('title');
        $writer->value($this->get('title'));
        $writer->endObject();

        $writer->endObject();
    }
}
