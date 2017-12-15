<?php namespace MantasDone\ShortClosures;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CollectionWithShortClosures extends Collection
{
    // Original function accepts string. Overwriting it will brake backwards comparability.
    //
    // public function contains()

    public function each($callable_or_string)
    {
        if (is_string($callable_or_string)) {
            $callable = c($callable_or_string);
        } else {
            $callable = $callable_or_string;
        }

        return parent::each($callable);
    }

    public function eachSpread($callable_or_string)
    {
        if (is_string($callable_or_string)) {
            $callable = c($callable_or_string);
        } else {
            $callable = $callable_or_string;
        }

        return parent::eachSpread($callable);
    }

    public function flatMap($callable_or_string)
    {
        if (is_string($callable_or_string)) {
            $callable = c($callable_or_string);
        } else {
            $callable = $callable_or_string;
        }

        return parent::flatMap($callable);
    }

    public function map($callable_or_string)
    {
        if (is_string($callable_or_string)) {
            $callable = c($callable_or_string);
        } else {
            $callable = $callable_or_string;
        }

        return parent::map($callable);
    }

    public function mapSpread($callable_or_string)
    {
        if (is_string($callable_or_string)) {
            $callable = c($callable_or_string);
        } else {
            $callable = $callable_or_string;
        }

        return parent::mapSpread($callable);
    }

    public function mapToGroups($callable_or_string)
    {
        if (is_string($callable_or_string)) {
            $callable = c($callable_or_string);
        } else {
            $callable = $callable_or_string;
        }

        return parent::mapToGroups($callable);
    }

    public function mapWithKeys($callable_or_string)
    {
        if (is_string($callable_or_string)) {
            $callable = c($callable_or_string);
        } else {
            $callable = $callable_or_string;
        }

        return parent::mapWithKeys($callable);
    }

    public function pipe($callable_or_string)
    {
        if (is_string($callable_or_string)) {
            $callable = c($callable_or_string);
        } else {
            $callable = $callable_or_string;
        }

        return parent::pipe($callable);
    }

    public function reduce($callable_or_string, $initial = null)
    {
        if (is_string($callable_or_string)) {
            $callable = c($callable_or_string);
        } else {
            $callable = $callable_or_string;
        }

        return parent::reduce($callable, $initial);
    }

    public function tap($callable_or_string)
    {
        if (is_string($callable_or_string)) {
            $callable = c($callable_or_string);
        } else {
            $callable = $callable_or_string;
        }

        return parent::tap($callable);
    }

    public function transform($callable_or_string)
    {
        if (is_string($callable_or_string)) {
            $callable = c($callable_or_string);
        } else {
            $callable = $callable_or_string;
        }

        return parent::transform($callable);
    }

    public function filter($callable_or_string = null)
    {
        if (is_string($callable_or_string)) {
            $callable = c($callable_or_string);
        } else {
            $callable = $callable_or_string;
        }

        return parent::filter($callable);
    }
}