<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Sports extends Model
{
    static protected $rules = [
    ];

    public function __construct(Writer $writer)
    {
        parent::__construct([], $writer);

        $this->writer->startArray("sports");
    }

    public final function addSport(array $data)
    {
        return new Sport($data, $this->writer);
    }

    protected function write()
    {
        $this->writer->endArray();
    }
}
