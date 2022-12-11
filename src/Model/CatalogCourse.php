<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Model\Attribute\Attribute;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class CatalogCourse extends Model
{
    static protected $rules = [
        'id' => "present|max:255",
        'prefix' => "present|max:255",
        'number' => "present|max:255",
        'suffix' => "present|max:255",
        'title' => "present|max:255",
        'min_credits' => "required|numeric",
        'max_credits' => "required|numeric",
        'credit_type' => "required|max:255",
        'min_hours' => "numeric",
        'max_hours' => "numeric",
        'archived' => "in:y,n,Y,N",
        'level' => "max:255",
        'url' => "max:4096|url",
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
