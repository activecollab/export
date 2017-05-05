<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */


declare(strict_types=1);

namespace ActiveCollab\Exporter\Test\TestCase;

use FilesystemIterator;
use PHPUnit_Framework_TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\SplFileInfo;

abstract class TestCase extends  PHPUnit_Framework_TestCase
{
    const WORK_FOLDER = __DIR__ . '/../../work';
    const DONT_DELETE = ['.gitkeep', '.gitignore'];

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();

        $dir = new RecursiveDirectoryIterator(self::WORK_FOLDER, FilesystemIterator::SKIP_DOTS);
        $read = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);

        /** @var SplFileInfo $file */
        foreach ( $read as $file ) {
            $basename = $file->getBasename();

            if (!in_array($basename, self::DONT_DELETE)) {
                $file->isDir() ? rmdir($file->getPathname()) : unlink($file->getPathname());
            }
        }
    }
}
