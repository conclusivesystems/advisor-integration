<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Terms extends Model
{
    static protected $rules = [
    ];

    public function __construct(Writer $writer)
    {
        parent::__construct([], $writer);

        $this->writer->startArray("terms");
    }

    public final function addTerm(array $data)
    {
        return new Term($data, $this->writer);
    }

    protected function write()
    {
        $this->writer->endArray();
    }
}
