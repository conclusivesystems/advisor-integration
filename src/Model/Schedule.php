<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Model\Prerequisite\Prerequisite;
use Consys\Advisor\Integration\Writer\Writer;

class Schedule extends Model
{
    static protected $rules = [
    ];

    public function __construct(Writer $writer)
    {
        parent::__construct([], $writer);

        $this->writer->startObject("schedule");
        $this->writer->startArray("courses");
    }

    public final function addCourse(array $data)
    {
        return new ScheduleCourse($data, $this->writer);
    }

    protected function write()
    {
        $this->writer->endArray();
        $this->writer->endObject();
    }
}
