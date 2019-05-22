<?php namespace Consys\Advisor\Integration\Model\Prerequisite;

use Consys\Advisor\Integration\Model\Model;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Criteria extends Model
{
    private $type = null;

    static protected $rules = [
    ];

    public function addRequirement(array $data)
    {
        $req = new Requirement($data, $this->writer);
        $this->type = $req;
        return $req;
    }

    public function addCourseList(array $data)
    {
        $cl = new CourseList($data, $this->writer);
        $this->type = $cl;
        return $cl;
    }

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('criteria');

        if($this->type !== null)
        {
            $this->type->write($writer);
        }

        $writer->endObject();
    }
}
