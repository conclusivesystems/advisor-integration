<?php namespace Consys\Advisor\Integration\Writer;

class JSON extends Writer
{
    private $writer = null;
    private $first = true;
    private $hadProperty = false;
    private $stack = [];

    private function output($text)
    {
        echo $text;
    }

    private function push(string $type, string $name, bool $hadProperty)
    {
        $obj = new \stdClass();
        $obj->type = $type;
        $obj->name = $name;
        $obj->hadProperty = $hadProperty;
        array_push($this->stack, $obj);
    }

    private function pop()
    {
        return array_pop($this->stack);
    }

    private function peek()
    {
        return end($this->stack);
    }

    protected function open()
    {
        $this->push('object', 'response', false);
        $this->first = true;
    }

    protected function close()
    {
        $this->pop();
        $this->output("}\n");
    }

    public function startProperty(string $name)
    {
        $this->peek()->hadProperty = true;
        if($this->first)
        {
            if($this->peek()->type === 'object')
            {
                $this->output("{");
            }
        }
        else
        {
            $this->output(",");
        }
        $this->output(json_encode($name) . ': ');
        $this->push('property', $name, false);
        $this->first = true;
    }

    public function endProperty()
    {
        $this->first = false;
        $this->pop();
    }

    public function startObject(string $name)
    {
        $this->peek()->hadProperty = true;
        if($this->first)
        {
            if($this->peek()->type === 'object')
            {
                $this->output("{");
            }
        }
        else
        {
            $this->output(",");
        }
        if($this->peek()->type === 'object')
        {
            $this->output(json_encode($name) . ':');
        }
        $this->push('object', $name, false);
        $this->first = true;
    }

    public function endObject()
    {
        $this->first = false;
        $obj = $this->pop();
        if($obj->hadProperty)
            $this->output("}");
    }

    public function startArray(string $name)
    {
        $this->peek()->hadProperty = true;
        if($this->first)
        {
            if($this->peek()->type === 'object')
            {
                $this->output("{");
            }
        }
        else
        {
            $this->output(",");
        }
        $this->output(json_encode($name) . ':[');
        $this->push('array', $name, false);
        $this->first = true;
    }

    public function endArray()
    {
        $this->first = false;
        $this->pop();
        $this->output("]");
    }

    public function value(string $text)
    {
        if(!$this->first) $this->output(",");
        $obj = $this->peek();
        if($obj->type === 'object')
        {
            if($obj->hadProperty)
            {
                $this->output(json_encode($obj->name) . ':');
            }
        }
        $this->output(json_encode($text));
    }
}
