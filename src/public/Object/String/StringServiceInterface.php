<?php
declare(strict_types=1);

/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace doganoo\DI\Object\String;

/**
 * Interface StringService
 *
 * @package doganoo\DI\String
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
interface StringServiceInterface {

    /**
     * Returns whether a string value is provided or not
     *
     * @param string|null $value The value to check
     *
     * @return bool
     */
    public function isEmpty(?string $value): bool;

    /**
     * Returns whether two given strings are equal (case sensitive)
     *
     * @param string $first  The first string to compare
     * @param string $second The second string to compare
     * @return bool
     */
    public function equals(string $first, string $second): bool;

    /**
     * Returns whether two given strings are equal (case insensitive)
     *
     * @param string $first  The first string to compare
     * @param string $second The second string to compare
     * @return bool
     */
    public function equalsIgnoreCase(string $first, string $second): bool;

    /**
     * Checks whether $second exists in $first
     *
     * @param string $first  The string to check
     * @param string $second The string to search
     * @return bool
     */
    public function contains(string $first, string $second): bool;

    /**
     * Returns an intersection of $first and $second
     *
     * @param string $first  The first string
     * @param string $second The second string
     * @return string
     */
    public function intersect(string $first, string $second): string;

}
