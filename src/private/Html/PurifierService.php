<?php
declare(strict_types=1);
/**
 *
 * Copyright (C) <2021> <Dogan Ucar>
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

namespace doganoo\DIP\Html;

use doganoo\DI\HTML\PurifierServiceInterface;
use HTMLPurifier;
use HTMLPurifier_Config;

class PurifierService implements PurifierServiceInterface {

    public function __construct(
        private HTMLPurifier $purifier
    ) {
        $config         = HTMLPurifier_Config::createDefault();
        $this->purifier = new HTMLPurifier($config);
    }

    public function purify(string $dirty): string {
        return $this->purifier->purify($dirty);
    }

    public function removeTags(string $dirty): string {
        return strip_tags($dirty);
    }

    public function encodeEntities(string $dirty): string {
        return htmlentities($dirty);
    }

}