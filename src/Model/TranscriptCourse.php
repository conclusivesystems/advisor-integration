<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Model\Attribute\Attribute;
use Consys\Advisor\Integration\Writer\Writer;

class TranscriptCourse extends Model
{
    static protected $rules = [
        'id' => "required|max:255",
        'course_id' => "max:255",
        'prefix' => "present|max:255",
        'number' => "present|max:255",
        'suffix' => "present|max:255",
        'title' => "present|max:255",
        'grade' => "max:255",
        'grade_type' => "required|max:255",
        'grade_suppressed' => "in:y,n,Y,N",
        'status' => "required|max:255",
        'level' => "max:255",
        'credits' => "numeric",
        'credit_type' => "required|max:255",
        'hours' => "numeric",
        'transfer' => "in:y,n,Y,N",
        'transfer_code' => "max:255",
        'transfer_text' => "max:255",
        'term_year' => "required|integer|between:1000,9999",
        'term_period' => "required|max:255",
        'repeat' => "max:255",
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
        'option15' => "max:255",
        'drop_date' => "datetime",
        'enrolled_at' => "datetime",
        'created_at' => "datetime",
        'updated_at' => "datetime",
    ];

    private $attributes = [];

    public final function addAttribute(array $data)
    {
        return $this->attributes[] = new Attribute($data, $this->writer);
    }

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('course');
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

        if(count($this->attributes) > 0)
        {
            $writer->startArray('attributes');
            foreach ($this->attributes as $attribute)
            {
                $attribute->write();
            }
            $writer->endArray('attributes');
        }

        $writer->endObject();
    }
}
