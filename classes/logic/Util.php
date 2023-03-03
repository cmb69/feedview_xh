<?php

/**
 * Copyright 2023 Christoph M. Becker
 *
 * This file is part of Feedview_XH.
 *
 * Feedview_XH is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Feedview_XH is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Feedview_XH.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Feedview\Logic;

class Util
{
    /**
     * @param array<scalar> $args
     * @param array{int,string} $defaults
     * @return array{int<0,max>,string}|null
     */
    public static function parseArgs(array $args, array $defaults): ?array
    {
        if (count($args) === 0) {
            return [max($defaults[0], 0), $defaults[1]];
        } elseif (count($args) === 1 && is_int($args[0])) {
            return [max($args[0], 0), $defaults[1]];
        } elseif (count($args) === 1 && is_string($args[0])) {
            return [max($defaults[0], 0), $args[0]];
        } elseif (count($args) === 2 && is_int($args[0]) && is_string($args[1])) {
            return [max($args[0], 0), $args[1]];
        }
        return null;
    }

    /**
     * @param int<0,max> $offset
     * @param int<0,max> $count
     * @param int<0,max> $total
     * @return array{int<0,max>|null,int<0,max>|null}
     */
    public static function offsets(int $offset, int $count, int $total): array
    {
        return [Util::prevOffset($offset, $count), Util::nextOffset($offset, $count, $total)];
    }

    /**
     * @param int<0,max> $offset
     * @param int<0,max> $count
     * @return int<0,max>|null
     */
    private static function prevOffset(int $offset, int $count): ?int
    {
        if ($offset === 0) {
            return null;
        }
        if ($count === 0) {
            return 0;
        }
        return max($offset - $count, 0);
    }

    /**
     * @param int<0,max> $offset
     * @param int<0,max> $count
     * @param int<0,max> $total
     * @return int<0,max>|null
     */
    private static function nextOffset(int $offset, int $count, int $total): ?int
    {
        if ($count === 0) {
            return null;
        }
        if ($offset + $count >= $total) {
            return null;
        }
        return $offset + $count;
    }
}
