<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Milestone extends Model
{
    static protected $rules = [
        'id' => "required|max:255",
        'name' => "required|max:255",
        'description' => "max:255",
        'status' => "max:255",
        'option1' => "max:255",
        'option2' => "max:255",
        'option3' => "max:255",
        'option4' => "max:255",
        'option5' => "max:255",
        'option6' => "max:255",
        'option7' => "max:255",
        'option8' => "max:255",
        'option9' => "max:255",
        'option10' => "max:255",
        'option11' => "max:255",
        'option12' => "max:255",
        'option13' => "max:255",
        'option14' => "max:255",
        'option15' => "max:255"
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('milestone');

        $writer->startProperty('id');
        $writer->value($this->get('id'));
        $writer->endProperty();

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
