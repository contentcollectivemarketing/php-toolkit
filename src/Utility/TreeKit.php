<?php

namespace Toolkit\Utility;

/**
 * Class Tree
 *
 * @package Toolkit\Utility
 */
class TreeKit
{
    /**
     * Primary key name.
     *
     * @var string
     */
    private static $primaryKey = 'id';

    /**
     * Parent key name.
     *
     * @var string
     */
    private static $parentKey = 'parentId';

    /**
     * Node key name.
     *
     * @var string
     */
    private static $childKey = 'children';

    /**
     * Set tree configuration.
     *
     * @param array $array
     */
    public static function setConfig(array $array)
    {
        self::$primaryKey = $array['id'] ?? self::$primaryKey;
        self::$parentKey = $array['parentId'] ?? self::$parentKey;
        self::$childKey = $array['children'] ?? self::$childKey;
    }

    /**
     * Make a tree from a flat array using recursion.
     *
     * @param array $array
     * @param int   $index
     * @return array
     */
    public static function makeTree(array & $array, $index = 0) : array
    {
        $children = self::findChild($array, $index);

        if (empty($children)) {
            return $children;
        }

        foreach ($children as $key => & $val) {
            if (empty($array)) {
                break;
            }
            $child = self::makeTree($array, $val[self::$primaryKey]);

            if (!empty($child)) {
                $val[self::$childKey] = $child;
            }
        }
        unset($val);

        return $children;
    }

    /**
     * Build a tree from a flat array.
     *
     * @param array $array
     * @param int   $index
     * @return array
     * @link
     */
    public static function buildTree(array & $array, $index = 0) : array
    {
        $target = $source = [];
        foreach ($array as $key => $val) {
            $source[$val[self::$primaryKey]] = &$array[$key];
        }

        foreach ($array as $key => $val) {
            $parentId = $val[self::$parentKey];
            if ($index === $parentId) {
                $target[] = &$array[$key];
            } else {
                if (isset($source[$parentId])) {
                    $parent = &$source[$parentId];
                    $parent[self::$childKey][] = &$array[$key];
                }
            }
        }

        return $target;
    }

    /**
     * Find child node.
     *
     * @param array      $array
     * @param string|int $index
     * @return array
     */
    public static function findChild(array & $array, $index) : array
    {
        $child = [];
        foreach ($array as $key => $val) {
            if ($val[self::$parentKey] === $index) {
                $child[] = $val;
                unset($array[$key]);
            }
        }

        return $child;
    }
}
