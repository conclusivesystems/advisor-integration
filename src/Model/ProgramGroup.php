<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class ProgramGroup extends Model
{
    private $programs = [];

    static protected $rules = [
    ];

    public function addProgram(array $data)
    {
        $this->programs[] = new Program($data, $this->writer);
    }

    protected function write()
    {
        $writer = $this->writer;

        if(count($this->programs) > 0)
        {
            $writer->startArray('program_group');

            foreach($this->programs as $program)
            {
                $program->write($writer);
            }

            $writer->endArray();
        }
    }
}
