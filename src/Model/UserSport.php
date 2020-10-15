<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class UserSport extends Model
{
    static protected $rules = [
        'code' => "required|max:255",
        'year' => "present|max:255",
        'term' => "max:255",
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('sport');

        $writer->startProperty('code');
        $writer->value($this->get('code'));
        $writer->endProperty();

        foreach(static::fields() as $field)
        {
            if($this->get($field) !== null && $field !== 'code')
            {
                $writer->startObject($field);
                $writer->value($this->get($field));
                $writer->endObject();
            }
        }

        $writer->endObject();
    }
}
