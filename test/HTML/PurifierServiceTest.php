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

namespace doganoo\DI\Test\HTML;

use doganoo\DI\HTML\IPurifierService;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\HTML\PurifierService;

class PurifierServiceTest extends TestCase {

    private IPurifierService $purifierService;

    protected function setUp(): void {
        parent::setUp();
        $this->purifierService = new PurifierService();
    }

    /**
     * @param string $dirty
     * @param string $clean
     * @dataProvider provideTestRemoveTags
     */
    public function testRemoveTags(string $dirty, string $clean): void {
        $this->assertTrue($clean === $this->purifierService->removeTags($dirty));
    }

    /**
     * @param string $dirty
     * @param string $clean
     * @dataProvider provideEncodeEntities
     */
    public function testEncodeEntities(string $dirty, string $clean): void {
        $this->assertTrue($clean === $this->purifierService->encodeEntities($dirty));
    }

    public function provideTestRemoveTags(): array {
        return [
            ['<a>test</a>', 'test']
            , ["<a>alert('javascript')</a>", "alert('javascript')"]
        ];
    }

    public function provideEncodeEntities(): array {
        return [
            ["<script>alert('javascript')</script>", "&lt;script&gt;alert(&#039;javascript&#039;)&lt;/script&gt;"]
        ];
    }

}