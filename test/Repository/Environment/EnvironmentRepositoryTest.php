<?php
declare(strict_types=1);

namespace doganoo\DI\Test\Repository\Environment;

use DateTimeImmutable;
use doganoo\DI\Repository\Environment\IEnvironmentRepository;
use doganoo\DI\Test\Suite\TestCase;
use doganoo\DIP\DateTime\DateTimeService;
use doganoo\DIP\Entity\Environment;
use doganoo\DIP\Entity\NullEnvironment;
use doganoo\DIP\Repository\Environment\EnvironmentRepository;
use Ramsey\Uuid\Uuid;

class EnvironmentRepositoryTest extends TestCase {

    private IEnvironmentRepository $environmentRepository;
    private string                 $path;

    protected function setUp(): void {
        parent::setUp();
        $this->path                  = __DIR__ . '/.instance.sqlite';
        $this->environmentRepository = new EnvironmentRepository(
            new DateTimeService(),
            $this->path
        );
    }

    public function testInsertGetUpdateRemove(): void {
        $env = new Environment(
            Uuid::uuid4()->toString(),
            'this-is-a-value',
            new DateTimeImmutable()
        );
        $this->environmentRepository->insert($env);
        $insertedEnv = $this->environmentRepository->get($env->getId());
        $this->assertTrue($env->getId() === $insertedEnv->getId());
        $this->assertTrue($env->getValue() === $insertedEnv->getValue());
        $this->assertTrue($env->getCreateTs()->getTimestamp() === $insertedEnv->getCreateTs()->getTimestamp());

        $this->environmentRepository->update(
            new Environment(
                $env->getId(),
                'the-updated-env',
                $env->getCreateTs()
            )
        );
        $updatedEnv = $this->environmentRepository->get($env->getId());
        $this->assertTrue($updatedEnv->getValue() === 'the-updated-env');

        $this->environmentRepository->remove($env->getId());
        $removed = $this->environmentRepository->get($env->getId());
        $this->assertTrue($removed instanceof NullEnvironment);
    }

    public function testGetAll(): void {
        $this->environmentRepository->clear();
        $max = 3;

        for ($i = 0; $i < $max; $i++) {
            $this->environmentRepository->insert(
                new Environment(
                    Uuid::uuid4()->toString(),
                    Uuid::uuid4()->toString(),
                    new DateTimeImmutable()
                )
            );
        }

        $all = $this->environmentRepository->getAll();
        $this->assertTrue($all->size() === $max);
    }

    protected function tearDown(): void {
        parent::tearDown();
        unlink($this->path);
    }

}