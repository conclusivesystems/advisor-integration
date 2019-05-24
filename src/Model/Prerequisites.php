<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Model\Prerequisite\Prerequisite;
use Consys\Advisor\Integration\Writer\Writer;

class Prerequisites extends Model
{
    static protected $rules = [
    ];

    public function __construct(Writer $writer)
    {
        parent::__construct([], $writer);

        $this->writer->startArray("prerequisites");
    }

    public final function addPrerequisite()
    {
        return new Prerequisite([], $this->writer);
    }

    protected function write()
    {
        $this->writer->endArray();
    }
}
