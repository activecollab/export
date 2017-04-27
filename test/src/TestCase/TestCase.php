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
abstract class TestCase extends  PHPUnit_Framework_TestCase
{
    const WORK_FOLDER = __DIR__ . '/../../work';

    public function setUp()
    {
        parent::setUp();

    }

    public function tearDown()
    {
        parent::tearDown();

        $dir = new RecursiveDirectoryIterator(self::WORK_FOLDER, FilesystemIterator::SKIP_DOTS);
        $read = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ( $read as $file ) {
            $file->isDir() ? rmdir($file) : unlink($file);
        }
    }
}
