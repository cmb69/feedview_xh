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

namespace Feedview\Infra;

class Request
{
    /** @codeCoverageIgnore */
    public static function current(): self
    {
        return new self;
    }

    public function url(): Url
    {
        $server = $this->server();
        $query = (string) preg_replace('/^[^=&]*(?=&|$)/', '', $server["QUERY_STRING"]);
        return new Url($this->su(), $this->parseQuery($query));
    }

    /** @return array<string,string|array<string>> */
    private function parseQuery(string $query): array
    {
        parse_str($query, $result);
        $this->assertStringKeys($result);
        return $result;
    }

    /**
     * @param array<int|string,array<mixed>|string> $array
     * @phpstan-assert array<string,string|array<string>> $array
     */
    private function assertStringKeys(array $array): void
    {
        foreach ($array as $key => $value) {
            assert(is_string($key));
        }
    }

    /** @codeCoverageIgnore */
    protected function su(): string
    {
        global $su;
        return $su;
    }

    /**
     * @codeCoverageIgnore
     * @return array<string,string>
     */
    protected function server(): array
    {
        return $_SERVER;
    }
}
