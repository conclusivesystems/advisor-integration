<?php namespace Consys\Advisor\Integration\Writer;

abstract class Writer
{
    public function __construct(string $fileName = "php://output", array $options = [])
    {
        $this->open($fileName, $options);
    }

    public function __destruct()
    {
        $this->close();
    }

    abstract protected function open(string $fileName, array $options);
    abstract protected function close();

    abstract public function startArray(string $name);
    abstract public function endArray();
    abstract public function startObject(string $name);
    abstract public function endObject();
    abstract public function startProperty(string $name);
    abstract public function endProperty();
    abstract public function value(string $text);
}
