<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;

class Equivalencies extends Model
{
    static protected $rules = [
    ];

    public function __construct(Writer $writer)
    {
        parent::__construct([], $writer);

        $this->writer->startArray("equivalencies");
    }

    public final function addEquivalency(array $data)
    {
        return new Equivalency($data, $this->writer);
    }

    protected function write()
    {
        $this->writer->endArray();
    }
}
