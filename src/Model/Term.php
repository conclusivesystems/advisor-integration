<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Term extends Model
{
    static protected $rules = [
        'foreign_key' => "max:255",
        'year' => "required|integer|min:1900|max:9999",
        'period' => "required|max:255",
        'start' => "date",
        'end' => "date",
        'planstart' => "date",
        'planend' => "date",
        'regstart' => "date",
        'regend' => "date",
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('term');

        foreach(static::fields() as $field)
        {
            if($this->get($field) !== null)
            {
                $writer->startObject($field);
                $writer->value($this->get($field));
                $writer->endObject();
            }
        }

        $writer->endObject();
    }
}
