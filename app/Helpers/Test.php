<?php

interface Rec
{
    public function recursia(int $n);
}
class Recursia implements Rec
{
    private int $num;

    public function recursia($n)
    {
        if ($n == 1) {
            return 1;
        } else {
            return $n * $this->recursia($n - 1);
        }
    }
}

abstract class Decorator implements Rec
{
    protected $obj;

    /**
     * @param $obj
     */
    public function __construct(Rec $obj)
    {
        $this->obj = $obj;
    }
}

class Resulr extends Decorator
{
    public function recursia(int $n)
    {
        if ($n == 1) {
            return 1;
        } else {
            return $n + $this->recursia($n - 1);
        }
    }
}
$class = new Recursia();
echo $class->recursia(5);
$class2 = new Resulr($class);
echo $class2->recursia(5);
