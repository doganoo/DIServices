<?php
declare(strict_types=1);
/**
 *
 * Copyright (C) <2020> <Dogan Ucar>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace doganoo\DIP\Object\Reflection;

use doganoo\DI\Object\Reflection\ReflectionServiceInterface;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayList\ArrayList;

class ReflectionService implements ReflectionServiceInterface {

    /**
     * Returns a list of all parent classes as string
     *
     * @param string|object $class The class as an object or string
     *
     * @return ArrayList|null
     */
    public function getParentClasses($class): ?ArrayList {
        $list = new ArrayList();
        $p    = class_parents($class);

        if (false === $p) return null;

        $list->addAllArray($p);
        return $list;
    }

}
