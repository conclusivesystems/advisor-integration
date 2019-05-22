<?php namespace Consys\Advisor\Integration\Writer;

abstract class Writer
{
    protected $request_id = 0;

    public function __construct(string $request_id)
    {
        $this->request_id = $request_id;

        $this->open();
    }

    public function __destruct()
    {
        $this->close();
    }

    abstract protected function open();
    abstract protected function close();

    abstract public function startArray(string $name);
    abstract public function endArray();
    abstract public function startObject(string $name);
    abstract public function endObject();
    abstract public function startProperty(string $name);
    abstract public function endProperty();
    abstract public function value(string $text);
}
