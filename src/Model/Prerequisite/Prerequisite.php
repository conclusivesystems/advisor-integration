<?php namespace Consys\Advisor\Integration\Model\Prerequisite;

use Consys\Advisor\Integration\Model\Model;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Prerequisite extends Model
{
    private $target = null;
    private $criteria = null;

    static protected $rules = [
    ];

    public function addTarget(array $data)
    {
        $target = new Target($data, $this->writer);
        $this->target = $target;
        return $target;
    }

    public function addCriteria()
    {
        $criteria = new Criteria([], $this->writer);
        $this->criteria = $criteria;
        return $criteria;
    }

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('prerequisite');

        if($this->target !== null)
        {
            $this->target->write($writer);
        }

        if($this->criteria !== null)
        {
            $this->criteria->write($writer);
        }

        $writer->endObject();
    }
}
