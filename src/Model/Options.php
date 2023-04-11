<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\IntegrationException;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Options extends Model
{
    private $changeUserGroups =[];

    static protected $rules = [
        'clear_advisees' => "in:y,n",
        'current_term_year' => "integer|between:1000,9999",
        'current_term_period' => "max:255",
    ];


    public function changeUserGroups(array $from, string $to)
    {
        foreach($from as $group_code)
        {
            if(!is_string($group_code) || $group_code === '')
            {
                throw new IntegrationException("changeUserGroups: group code must be a string.");
            }
        }

        if($to === '')
        {
            throw new IntegrationException('changeUserGroups: group code cannot be blank.');
        }

        if(!isset($this->changeUserGroups[$to]))
        {
            $this->changeUserGroups[$to] = [];
        }

        $this->changeUserGroups[$to] += $from;
    }

    protected function write()
    {
        $writer = $this->writer;

        $writer->startObject('options');

        if($this->get('clear_advisees') !== null)
        {
            $writer->startObject('clear_advisees');
            $writer->value($this->get('clear_advisees'));
            $writer->endObject();
        }

        if($this->get('current_term_year') !== null)
        {
            $writer->startObject('current_term_year');
            $writer->value($this->get('current_term_year'));
            $writer->endObject();
        }

        if($this->get('current_term_period') !== null)
        {
            $writer->startObject('current_term_period');
            $writer->value($this->get('current_term_period'));
            $writer->endObject();
        }

        if(count($this->changeUserGroups) > 0)
        {
            foreach($this->changeUserGroups as $from => $groups)
            {
                $writer->startObject('change_user_groups');
                $writer->startProperty('new_code');
                $writer->value($from);
                $writer->endProperty();

                foreach($groups as $group)
                {
                    $writer->startObject('group_code');
                    $writer->value($group);
                    $writer->endObject();
                }
                $writer->endObject();
            }
        }

        $writer->endObject();
    }
}
