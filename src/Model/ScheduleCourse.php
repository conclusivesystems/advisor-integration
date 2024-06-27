<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class ScheduleCourse extends Model
{
    private $meetings = [];

    static protected $rules = [
        'term_year' => "required|integer|between:1000,9999",
        'term_code' => "max:255",
        'prefix' => "present|max:255",
        'number' => "present|max:255",
        'suffix' => "present|max:255",
        'seats' => "integer|between:0,9999999999",
        'min_credits' => "numeric",
        'max_credits' => "numeric",
        'hours' => "numeric",
        'instructor' => "max:1024",
        'section' => "max:1024",
        'start_date' => "date",
        'end_date' => "date",
        'url' => "max:4096|url",
        'delivery_method' => "integer"
    ];

    public function addMeeting(array $data)
    {
        $meeting = new Meeting($data, $this->writer);
        $this->meetings[] = $meeting;
        return $meeting;
    }

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('course');

        foreach(static::fields() as $field)
        {
            if($this->get($field) !== null && $field !== 'id')
            {
                $writer->startObject($field);
                $writer->value($this->get($field));
                $writer->endObject();
            }
        }

        if(count($this->meetings) > 0)
        {
            $writer->startArray('meetings');
            foreach($this->meetings as $meeting)
            {
                $meeting->write($writer);
            }
            $writer->endArray();
        }

        $writer->endObject();
    }
}
