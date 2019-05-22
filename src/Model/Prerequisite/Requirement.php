<?php namespace Consys\Advisor\Integration\Model\Prerequisite;

use Consys\Advisor\Integration\Model\Model;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Requirement extends Model
{
    private $parameters = [];
    private $children = null;

    static protected $rules = [
        'min_credits' => 'integer',
        'min_courses' => 'integer',
    ];

    public function addParameter(array $data)
    {
        $p = new Parameter($data, $this->writer);
        $this->parameters[] = $p;
        return $p;
    }

    public function addChildren(array $data)
    {
        $c = new Children($data, $this->writer);
        $this->children = $c;
        return $c;
    }

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('requirement');

        if(count($this->parameters) > 0)
        {
            $writer->startArray('parameters');
            foreach($this->parameters as $p)
            {
                $p->write($writer);
            }
            $writer->endArray();
        }

        if($this->children !== null)
        {
            $this->children->write($writer);
        }

        $writer->endObject();
    }
}
