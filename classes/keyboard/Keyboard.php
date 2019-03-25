<?php

/** Class ButtonLine
 *
 * This class represents a button compatible with Telegram APIs.
 * It consists in a $state, an array whose every element is a single button;
 *  a ButtonLine object will be displayed as a bunch of buttons on the same
 *  line, like
 *  [Button1][Button2][Button3]
 *  (the rappresentation will be
 *  ["Button1", "Button2", "Button3"]
 *  ).
 *
 *  push($arg [,other args]):
 *      Add a button for each argument passed.
 *      If an argument is an array, every element of the array will be
 *       enqueued.
 *      Every trailing whitespace or period is erased before pushing.
 *  remove($arg [,other args]):
 *      Removes every button passed as argument (if present).
 * */
class ButtonLine
{
    private $state = array();

    function __construct(...$args)
    {
        $this->push(...$args);
    }

    public function push($arg = null, ...$other_args)
    {
        if ($arg == null) return;

        if ($arg instanceof ButtonLine) {
            $arg = $arg->state;
        }

        if ( ! is_array($arg) )
        {
            array_push($this->state, $this->format_string($arg));
        }
        else {
            foreach ($arg as &$line)
                $this->push($line);
        }

        if ( $other_args != null ) $this->push(...$other_args);
    }

    public function remove($arg, ...$other_args)
    {
        if ( $arg === null ) return;

        if ($arg instanceof ButtonLine) {
            $arg = $arg->state;
        }

        if ( ! is_array($arg) )
        {
            $index = array_search($arg, $this->state);
            if ($index !== false)
                array_splice($this->state, $index, 1);
        }
        else
        {
            //$this->state = array_diff($this->state, $arg);
            foreach ($arg as &$line)
                $this->remove($line);
        }

        if ( $other_args != null ) $this->remove(...$other_args);
    }

    function __toString()
    {
        return $this->dump();
    }

    public function dump()
    {
        return '["' . join('", "', $this->state) . '"]';
    }

    private function format_string($str)
    {
        return trim( trim($str), ',' );
    }
}

/**
 * Factory function - create a buttonline with the passed arguments
 * */
function as_button(...$args)
{
    return new ButtonLine(...$args);
}

/** Class Keyboard
 *
 * This class represents a keyboard layout compatible with the Telegram APIs' one.
 * It consists in an array of ButtonLines and some methods to work with it:
 *
 * push($arg [,other args]):
 *      Push every argument as a single-line button.
 *      Push every ButtonLine as a button line (?).
 *
 *  remove($arg [,other args]):
 *      Remove the first appearence of every arg from every button.
 *
 */

class Keyboard
{
    private $state = array();
    public $separator = ", ";

    function __construct()//)...$args)
    {
        //$this->push(...$args);
    }

    public function push($arg, ...$args)
    {
        if ( $arg == null ) return;

        if ( ! is_array($arg) )
        {
            if ( !($arg instanceof ButtonLine) )
            {
                $arg = as_button($arg);
            }
            array_push($this->state, $arg);
        }
        else
        {
            foreach ($arg as &$line) {
                $this->push($line);
            }
        }
        if ( $args != null ) $this->push(...$args);
    }

    public function remove(...$args)
    {
        foreach ( $this->state as &$buttonline )
        {
            $buttonline->remove(...$args);
        }
    }

    function __toString()
    {
        return $this->dump();
    }

    public function dump()
    {
        $call_dump = function($buttonline) { return $buttonline->dump(); };
        $res = join( $this->separator, array_map( $call_dump, $this->state ) );
        return trim($res, ", ");
    }
}
