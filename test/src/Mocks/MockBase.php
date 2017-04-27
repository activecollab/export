<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */


declare(strict_types=1);

namespace ActiveCollab\Exporter\Test\Mocks;

use ActiveCollab\Exporter\ExporterFactory;
use ActiveCollab\Exporter\ExporterManager;

class MockBase
{
    const WORK_FOLDER = __DIR__ . '/../../work';

    public $exporter_manager;
    public $exporter_factory;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->exporter_factory = new ExporterFactory();
        $this->exporter_manager = new ExporterManager($this->exporter_factory);
    }
}
