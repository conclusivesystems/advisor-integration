<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class AcademicGoal extends Model
{
    private $groups = [];

    static protected $rules = [
        'id' => "present|max:255",
        'type' => 'present|in:official,',
        'flag' => 'max:255',
    ];

    public function addGroup()
    {
        return $this->groups[] = new ProgramGroup([], $this->writer);
    }

    protected function write()
    {
        $writer = $this->writer;

        if(count($this->groups) > 0)
        {
            $writer->startObject('academic_goal');

            $writer->startProperty('id');
            $writer->value($this->get('id'));
            $writer->endProperty();

            $writer->startProperty('type');
            $writer->value($this->get('type'));
            $writer->endProperty();

            if($this->get('flag') !== null)
            {
                $writer->startProperty('flag');
                $writer->value($this->get('flag'));
                $writer->endProperty();
            }

            $writer->startArray('program_groups');
            foreach($this->groups as $group)
            {
                $group->write($writer);
            }
            $writer->endArray();

            $writer->endObject();
        }
    }
}
