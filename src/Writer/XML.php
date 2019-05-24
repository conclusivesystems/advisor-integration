<?php namespace Consys\Advisor\Integration\Writer;

use Consys\Advisor\Integration\IntegrationException;

class XML extends Writer
{
    private $writer = null;

    protected function open(string $fileName, array $options)
    {
        $this->writer = new \XMLWriter();
        if(!$this->writer->openUri($fileName))
        {
            throw new IntegrationException("Failed to open file: " . $fileName);
        }

        $this->writer->setIndent($options['indent']??true);
        $this->writer->startDocument('1.0','UTF-8');
    }

    protected function close()
    {
        $this->writer->endDocument();
    }

    public function startProperty(string $name)
    {
        $this->writer->startAttribute($name);
    }

    public function endProperty()
    {
        $this->writer->endAttribute();
    }

    public function startArray(string $name)
    {
        $this->writer->startElement($name);
    }

    public function endArray()
    {
        $this->writer->endElement();
    }

    public function startObject(string $name)
    {
        $this->writer->startElement($name);
    }

    public function endObject()
    {
        $this->writer->endElement();
    }

    public function value(string $text)
    {
        $this->writer->text($text);
    }
}
