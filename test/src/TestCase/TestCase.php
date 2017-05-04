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

    public function setUp()
    {
        parent::setUp();

        if (!is_dir(self::WORK_FOLDER)) {
            mkdir(self::WORK_FOLDER);
        }
    }

    public function tearDown()
    {
        parent::tearDown();

        $dir = new RecursiveDirectoryIterator(self::WORK_FOLDER, FilesystemIterator::SKIP_DOTS);
        $read = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);

        /** @var SplFileInfo $file */
        foreach ( $read as $file ) {
            $file->isDir() ? rmdir($file->getPathname()) : unlink($file->getPathname());
        }
    }
}
