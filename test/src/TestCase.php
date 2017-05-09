<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */


declare(strict_types=1);

namespace ActiveCollab\Exporter\Test;

use FilesystemIterator;
use PHPUnit_Framework_TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\SplFileInfo;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    protected $work_path;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->work_path = dirname(__DIR__) . '/work';
    }

    protected function setUp()
    {
        parent::setUp();

        $this->clearWorkDir($this->work_path);
    }

    public function tearDown()
    {
        $this->clearWorkDir($this->work_path);

        parent::tearDown();
    }

    private function clearWorkDir(string $work_dir_path)
    {
        $dir = new RecursiveDirectoryIterator($work_dir_path, FilesystemIterator::SKIP_DOTS);
        $read = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);

        /** @var SplFileInfo $file */
        foreach ($read as $file) {
            $basename = $file->getBasename();

            if (!in_array($basename, ['.gitignore'])) {
                $file->isDir() ? rmdir($file->getPathname()) : unlink($file->getPathname());
            }
        }
    }
}
