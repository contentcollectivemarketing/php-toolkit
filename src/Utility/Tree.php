<?php

namespace Toolkit\Utility;

/**
 * Class Tree.
 *
 * @package Toolkit\Utility
 */
class Tree
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
     * Get a tree from a flat array using recursion.
     *
     * @param array $array
     * @param int   $index
     * @return array
     */
    public static function getTree(array & $array, $index = 0) : array
    {
        $tree = [];
        foreach ($array as $key => $val) {
            if ($index === $val[self::$parentKey]) {
                $child = self::getTree($array, $val[self::$primaryKey]);
                if (!empty($child)) {
                    $val[self::$childKey] = $child;
                }
                $tree[] = $val;
                unset($array[$val[self::$primaryKey]]);
            }
        }

        return $tree;
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
            unset($val);
        }

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

    /**
     * Get id array from a tree array.
     *
     * @param array $array
     * @return array
     */
    public static function getTreeId(array & $array) : array
    {
        $tree = [];
        $flag = true;
        foreach ($array as $key => $val) {
            if (isset($val[self::$childKey])) {
                $flag = false;
                $tree[$val[self::$primaryKey]] = self::getTreeId($val[self::$childKey]);
            } else {
                if ($val[self::$parentKey] && $flag) {
                    $tree[] = $val[self::$primaryKey];
                } else {
                    $tree[$val[self::$primaryKey]] = [];
                }
            }
        }

        return $tree;
    }
}
