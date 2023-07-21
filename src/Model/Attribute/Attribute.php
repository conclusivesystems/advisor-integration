<?php namespace Consys\Advisor\Integration\Model\Attribute;

use Consys\Advisor\Integration\Model\Model;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Attribute extends Model
{
    static protected $rules = [
        'code' => "present|max:255",
        'title' => "max:255",
    ];
    private $values = [];

    public final function addValue(array $data)
    {
        return $this->values[] = new Value($data, $this->writer);
    }

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('attribute');

        $writer->startProperty('code');
        $writer->value($this->get('code'));
        $writer->endProperty();

        if($this->get('title') !== null)
        {
            $writer->startProperty('title');
            $writer->value($this->get('title'));
            $writer->endProperty();
        }

        if(count($this->values) > 0)
        {
            $writer->startArray('values');
            foreach ($this->values as $value)
            {
                $value->write();
            }
            $writer->endArray('values');
        }

        $writer->endObject();
    }
}
