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
        'include_in_goals_list' => 'boolean',
        'degree_entered' => 'date',
        'degree_conferred' => 'date',
        'transcript_note' => 'max:4096',
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
            
            if($this->get('include_in_goals_list') !== null)
            {
                $writer->startProperty('include_in_goals_list');
                $writer->value($this->get('include_in_goals_list'));
                $writer->endProperty();
            }

            if($this->get('degree_entered') !== null)
            {
                $writer->startProperty('degree_entered');
                $writer->value($this->get('degree_entered'));
                $writer->endProperty();
            }

            if($this->get('degree_conferred') !== null)
            {
                $writer->startProperty('degree_conferred');
                $writer->value($this->get('degree_conferred'));
                $writer->endProperty();
            }

            if($this->get('transcript_note') !== null)
            {
                $writer->startProperty('transcript_note');
                $writer->value($this->get('transcript_note'));
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
