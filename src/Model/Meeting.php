<?php namespace Consys\Advisor\Integration\Model;

class Meeting extends Model
{
    static protected $rules = [
        'room' => "max:255",
        'day' => "required|in:u,n,m,t,w,r,f,s",
        'start_time' => "required|regex:/^[0-9][0-9]:[0-9][0-9]:[0-9][0-9]\$/",
        'end_time' => "required|regex:/^[0-9][0-9]:[0-9][0-9]:[0-9][0-9]\$/",
    ];

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('meeting');

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
