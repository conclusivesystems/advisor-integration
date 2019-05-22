<?php namespace Consys\Advisor\Integration\Model\Prerequisite;

use Consys\Advisor\Integration\Model\Model;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class CourseList extends Model
{
    private $parameters = [];
    private $courses = [];

    static protected $rules = [
        'min_credits' => 'integer',
        'min_courses' => 'integer',
        'min_unique' => 'integer',
    ];

    public function addParameter(array $data)
    {
        $p = new Parameter($data, $this->writer);
        $this->parameters[] = $p;
        return $p;
    }

    public function addCourse(array $data)
    {
        $c = new Course($data, $this->writer);
        $this->courses[] = $c;
        return $c;
    }

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('courselist');

        if(count($this->parameters) > 0)
        {
            $writer->startArray('parameters');
            foreach($this->parameters as $p)
            {
                $p->write($writer);
            }
            $writer->endArray();
        }

        if(count($this->courses) > 0)
        {
            $writer->startArray('courses');
            foreach ($this->courses as $c)
            {
                $c->write($writer);
            }
            $writer->endArray();
        }

        $writer->endObject();
    }
}
