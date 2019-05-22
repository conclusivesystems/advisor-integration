<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Advisee extends Model
{
    static protected $rules = [
        'id' => "required|max:255",
        'primary' => "in:yes,no",
        'display' => "in:yes,no",
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('advisee_pin');

        if($this->get('primary') !== null)
        {
            $writer->startProperty('primary');
            $writer->value($this->get('primary'));
            $writer->endProperty();
        }

        if($this->get('display') !== null)
        {
            $writer->startProperty('display');
            $writer->value($this->get('display'));
            $writer->endProperty();
        }

        $writer->value($this->get('id'));

        $writer->endObject();
    }
}
