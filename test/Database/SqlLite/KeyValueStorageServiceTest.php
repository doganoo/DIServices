<?php
declare(strict_types=1);

namespace doganoo\DI\Test\Database\SqlLite;

use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\Database\SqlLite\KeyValueStorageService;
use doganoo\DIP\Exception\Database\SQLite\NoDatabaseFoundException;

class KeyValueStorageServiceTest extends TestCase {

    private string                 $dbFile;
    private KeyValueStorageService $service;

    protected function setUp(): void {
        $this->dbFile = sys_get_temp_dir() . '/test_db.sqlite';
        if (file_exists($this->dbFile)) {
            unlink($this->dbFile);
        }
        $this->service = new KeyValueStorageService($this->dbFile);
    }

    protected function tearDown(): void {
        if (file_exists($this->dbFile)) {
            unlink($this->dbFile);
        }
    }

    public function testPutAndGet(): void {
        $key   = 'test-key';
        $value = 'test-value';

        $this->assertSame($value, $this->service->put($key, $value));
        $this->assertSame($value, $this->service->get($key));
    }

    public function testUpdateOption(): void {
        $key          = 'test-key';
        $initialValue = 'initial';
        $updatedValue = 'updated';

        $this->service->put($key, $initialValue);
        $this->assertSame($initialValue, $this->service->get($key));

        $this->service->put($key, $updatedValue);
        $this->assertSame($updatedValue, $this->service->get($key));
    }

    public function testHas(): void {
        $key = 'existing-key';
        $this->assertFalse($this->service->has($key));

        $this->service->put($key, 'some-value');
        $this->assertTrue($this->service->has($key));
    }

    public function testGetThrowsNoDatabaseFoundException(): void {
        $invalidPath = sys_get_temp_dir() . '/non_existing_db.sqlite';
        $service     = new KeyValueStorageService($invalidPath);
        unlink($invalidPath); // remove file to trigger the exception

        $this->expectException(NoDatabaseFoundException::class);
        $service->get('any-key');
    }

}