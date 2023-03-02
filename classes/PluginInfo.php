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

namespace Feedview;

use Feedview\Infra\Response;
use Feedview\Infra\SystemChecker;
use Feedview\Infra\View;

class PluginInfo
{
    /** @var string */
    private $pluginFolder;

    /** @var SystemChecker */
    private $systemChecker;

    /** @var View */
    private $view;

    public function __construct(string $pluginFolder, SystemChecker $systemChecker, View $view)
    {
        $this->pluginFolder = $pluginFolder;
        $this->systemChecker = $systemChecker;
        $this->view = $view;
    }

    public function __invoke(): Response
    {
        return Response::create($this->view->render("info", [
            "version" => FEEDVIEW_VERSION,
            "checks" => $this->getChecks(),
        ]))->withTitle("Feedview " . FEEDVIEW_VERSION);
    }

    /** @return list<array{key:string,arg:string,class:string,state:string}> */
    private function getChecks()
    {
        return array(
            $this->checkPhpVersion("7.2.0"),
            $this->checkExtension("libxml"),
            $this->checkXhVersion("1.7.0"),
            $this->checkWritability($this->pluginFolder . "config/"),
            $this->checkWritability($this->pluginFolder . "css/"),
            $this->checkWritability($this->pluginFolder . "languages/"),
        );
    }

    /** @return array{key:string,arg:string,class:string,state:string} */
    private function checkPhpVersion(string $version)
    {
        $state = $this->systemChecker->checkVersion(PHP_VERSION, $version) ? 'success' : 'fail';
        return [
            "key" => "syscheck_phpversion",
            "arg" => $version,
            "class" => "xh_$state",
            "state" => "syscheck_$state",
        ];
    }

    /** @return array{key:string,arg:string,class:string,state:string} */
    private function checkExtension(string $extension)
    {
        $state = $this->systemChecker->checkExtension($extension) ? 'success' : 'fail';
        return [
            "key" => "syscheck_extension",
            "arg" => $extension,
            "class" => "xh_$state",
            "state" => "syscheck_$state",
        ];
    }

    /** @return array{key:string,arg:string,class:string,state:string} */
    private function checkXhVersion(string $version)
    {
        $state = $this->systemChecker->checkVersion(CMSIMPLE_XH_VERSION, "CMSimple_XH $version") ? 'success' : 'fail';
        return [
            "key" => "syscheck_xhversion",
            "arg" => $version,
            "class" => "xh_$state",
            "state" => "syscheck_$state",
        ];
    }

    /** @return array{key:string,arg:string,class:string,state:string} */
    private function checkWritability(string $folder)
    {
        $state = $this->systemChecker->checkWritability($folder) ? 'success' : 'warning';
        return [
            "key" => "syscheck_writable",
            "arg" => $folder,
            "class" => "xh_$state",
            "state" => "syscheck_$state",
        ];
    }
}
