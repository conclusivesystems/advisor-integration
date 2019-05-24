<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;

class Users extends Model
{
    static protected $rules = [
    ];

    public function __construct(Writer $writer)
    {
        parent::__construct([], $writer);

        $this->writer->startArray("users");
    }

    public final function addUser(array $data)
    {
        return new User($data, $this->writer);
    }

    protected function write()
    {
        $this->writer->endArray();
    }
}
