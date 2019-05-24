<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class Catalog extends Model
{
    static protected $rules = [
    ];

    public function __construct(Writer $writer)
    {
        parent::__construct([], $writer);

        $this->writer->startArray("catalog");
    }

    public final function addCourse(array $data)
    {
        return new CatalogCourse($data, $this->writer);
    }

    protected function write()
    {
        $this->writer->endArray();
    }
}
