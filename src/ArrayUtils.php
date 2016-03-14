<?php

namespace ArrayUtils;

use Generator;
use LogicException;

class ArrayUtils
{
    /**
     * @param array $input
     *
     * @return array
     *
     * @see Taken from http://stackoverflow.com/a/15973172
     */
    public static function cartesianProduct(array $input)
    {
        // filter out empty values
        $input = array_filter($input);

        $result = array(array());

        foreach ($input as $key => $values) {
            $append = array();

            foreach($result as $product) {
                foreach($values as $item) {
                    $product[$key] = $item;
                    $append[] = $product;
                }
            }

            $result = $append;
        }

        return $result;
    }

    /**
     * @param string $key
     * @param array $data
     *
     * @return mixed
     *
     * @see Taken from http://stackoverflow.com/a/10660002
     */
    public static function pluck($key, array $data)
    {
        return array_reduce($data, function($result, $array) use($key){
            isset($array[$key]) &&
            $result[] = $array[$key];

            return $result;
        }, array());
    }

    /**
     * @param array $array
     *
     * @return array
     *
     * @see Taken from http://stackoverflow.com/a/1320156
     */
    public static function flatten(array $array)
    {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });

        return $return;
    }

    /**
     * @see http://php.net/manual/en/language.generators.overview.php
     *
     * @param $start
     * @param $stop
     * @param int $step
     *
     * @return Generator
     */
    public static function xrange($start, $stop, $step = 1)
    {
        if ($start < $stop) {
            if ($step <= 0) {
                throw new LogicException('Step must be greater than zero');
            }

            for ($i = $start; $i <= $stop; $i += $step) {
                yield $i;
            }
        } else {
            if ($step >= 0) {
                throw new LogicException('Step must be lesser than zero');
            }

            for ($i = $start; $i >= $stop; $i += $step) {
                yield $i;
            }
        }
    }
}
