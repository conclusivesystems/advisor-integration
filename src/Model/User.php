<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Model\Attribute\Attribute;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class User extends Model
{

    private $academicGoals = [];
    private $transcript = [];
    private $awardedDegrees = [];
    private $messages = [];
    private $advisees = [];
    private $athletics = [];
    private $milestones = [];
    private $attributes = [];

    static protected $rules = [
        'id' => "required|max:255",
        'user_type' => "required|max:255",
        'username' => "required|max:255",
        'name_first' => "max:255",
        'name_middle' => "max:255",
        'name_last' => "max:255",
        'email' => "max:255",
        'courses' => "integer",
        'credits' => "numeric",
        'gpa' => "numeric",
        'ferpa' => "max:255",
        'goal_scope' => "max:4294967295",
        'option1' => "max:255",
        'option2' => "max:255",
        'option3' => "max:255",
        'option4' => "max:255",
        'option5' => "max:255",
        'option6' => "max:255",
        'option7' => "max:255",
        'option8' => "max:255",
        'option9' => "max:255",
        'option10' => "max:255",
        'option11' => "max:255",
        'option12' => "max:255",
        'option13' => "max:255",
        'option14' => "max:255",
        'option15' => "max:255",
        'birthdate' => 'date',
        'address_street1' => 'max:255',
        'address_street2' => 'max:255',
        'address_locality' => 'max:255',
        'address_region' => 'max:255',
        'address_country' => 'max:255',
        'address_postal_code' => 'max:255',
    ];

    public final function addAttribute(array $data)
    {
        return $this->attributes[] = new Attribute($data, $this->writer);
    }

    public function addAwardedDegree(array $data)
    {
        return $this->awardedDegrees[] = new AwardedDegree($data, $this->writer);
    }

    public function addCourse(array $data)
    {
        return $this->transcript[] = new TranscriptCourse($data, $this->writer);
    }

    public function addGoal(array $data)
    {
        return $this->academicGoals[] = new AcademicGoal($data, $this->writer);
    }

    public function addSport(array $data)
    {
        return $this->athletics[] = new UserSport($data, $this->writer);
    }

    public function addMilestone(array $data)
    {
        return $this->milestones[] = new Milestone($data, $this->writer);
    }

    public function addMessage(array $data)
    {
        return $this->messages[] = new Message($data, $this->writer);
    }

    public function addAdvisee(array $data)
    {
        return $this->advisees[] = new Advisee($data, $this->writer);
    }

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('user');
        $writer->startProperty('id');
        $writer->value($this->get('id'));
        $writer->endProperty();

        foreach(static::fields() as $field)
        {
            if($this->get($field) !== null && $field !== 'id')
            {
                $writer->startObject($field);
                $writer->value($this->get($field));
                $writer->endObject();
            }
        }

        if(count($this->academicGoals) > 0)
        {
            $writer->startArray('academic_goals');
            foreach($this->academicGoals as $goal)
            {
                $goal->write($writer);
            }
            $writer->endArray();
        }

        if(count($this->transcript) > 0)
        {
            $writer->startArray('transcript');
            foreach($this->transcript as $course)
            {
                $course->write($writer);
            }
            $writer->endArray();
        }

        if(count($this->athletics) > 0)
        {
            $writer->startArray('athletics');
            foreach($this->athletics as $sport)
            {
                $sport->write($writer);
            }
            $writer->endArray();
        }

        if(count($this->milestones) > 0)
        {
            $writer->startArray('milestones');
            foreach($this->milestones as $milestone)
            {
                $milestone->write($writer);
            }
            $writer->endArray();
        }

        if(count($this->messages) > 0)
        {
            $writer->startArray('messages');
            foreach($this->messages as $message)
            {
                $message->write($writer);
            }
            $writer->endArray();
        }

        if(count($this->advisees) > 0)
        {
            $writer->startArray('advisees');
            foreach($this->advisees as $advisee)
            {
                $advisee->write($writer);
            }
            $writer->endArray();
        }

        if(count($this->attributes) > 0)
        {
            $writer->startArray('attributes');
            foreach ($this->attributes as $attribute)
            {
                $attribute->write();
            }
            $writer->endArray('attributes');
        }

        if(count($this->awardedDegrees) > 0)
        {
            $writer->startArray('awarded_degrees');
            foreach ($this->awardedDegrees as $awardedDegree)
            {
                $awardedDegree->write();
            }
            $writer->endArray('awarded_degrees');
        }

        $writer->endObject();
    }
}
