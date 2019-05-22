<?php namespace Consys\Advisor\Integration\Writer;

class XML extends Writer
{
    private $writer = null;

    protected function open()
    {
        $this->writer = new \XMLWriter();
        $this->writer->openUri("php://output");
        $this->writer->setIndent(true);
        $this->writer->startDocument('1.0','UTF-8');
        $this->writer->startElement('response');
        $this->writer->startAttribute("id");
        $this->writer->text($this->request_id);
        $this->writer->endAttribute();
        $this->writer->startAttribute("version");
        $this->writer->text("2.0");
        $this->writer->endAttribute();
    }

    protected function close()
    {
        $this->writer->endElement();
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
