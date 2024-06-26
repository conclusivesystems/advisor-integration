<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class DeliveryMethod extends Model
{
    static protected $rules = [
        'foreign_key' => 'required|integer',
        'title' => 'present|max:255',
        'in_person' => "present|max:255",
        'online' => "present|max:255",
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('delivery_method');

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
