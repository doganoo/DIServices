<?php
declare(strict_types=1);

/**
 * DiServices
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

namespace doganoo\DIP\Encryption\Hash;

use doganoo\DI\Encryption\Hash\HashServiceInterface;
use doganoo\DIP\Exception\Encryption\InvalidArgumentException;

/**
 * Class Hash
 *
 * @package doganoo\DIP\Encryption\Hash
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
class HashService implements HashServiceInterface {

    /**
     * Hashes the content of a directory and returns the resulting string
     *
     * @param string $directory The directory to hash
     *
     * @return string
     * @throws InvalidArgumentException
     */
    public function hashDirectories(string $directory): string {

        if (false === is_dir($directory)) {
            throw new InvalidArgumentException ("$directory is not a directory");
        }

        $files = [];
        $dir   = dir($directory);

        while (false !== ($file = $dir->read())) {
            if ($file != '.' && $file != '..') {
                if (true === is_dir($directory . '/' . $file)) {
                    $files [] = $this->hashDirectories($directory . '/' . $file);
                } else {
                    $files [] = md5_file($directory . '/' . $file);
                }
            }
        }
        $dir->close();
        return hash(
            HashServiceInterface::ALGORITHM_SHA_256
            , implode(
                ''
                , $files
            )
        );
    }



}
