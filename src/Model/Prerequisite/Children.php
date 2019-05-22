<?php namespace Consys\Advisor\Integration\Model\Prerequisite;

use Consys\Advisor\Integration\Model\Model;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Children extends Model
{
    private $requirements = [];
    private $courselists = [];

    static protected $rules = [
        'relationship' => 'required|in:and,or,min',
        'min_number' => 'integer',
    ];

    public function addRequirement(array $data)
    {
        $req = new Requirement($data, $this->writer);
        $this->requirements[] = $req;
        return $req;
    }

    public function addCourseList(array $data)
    {
        $cl = new CourseList($data, $this->writer);
        $this->courselists[] = $cl;
        return $cl;
    }

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('children');

        $writer->startProperty('relationship');
        $writer->value($this->get('relationship'));
        $writer->endProperty();

        if($this->get('min_number') !== null)
        {
            $writer->startProperty('min_number');
            $writer->value($this->get('min_number'));
            $writer->endProperty();
        }

        if(count($this->requirements) > 0)
        {
            $writer->startArray('requirements');
            foreach($this->requirements as $r)
            {
                $r->write($writer);
            }
            $writer->endArray();
        }

        if(count($this->courselists) > 0)
        {
            $writer->startArray('courselists');
            foreach($this->courselists as $cl)
            {
                $cl->write($writer);
            }
            $writer->endArray();
        }

        $writer->endObject();
    }
}
