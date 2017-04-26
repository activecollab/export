<?php

/*
 * This file is part of the Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exporters;

/**
 * @package ActiveCollab\Exporter
 */
interface ExporterInterface
{
    /**
     * Export data.
     *
     * @param $objects
     * @param  string $path
     * @return string
     */
    public function export($objects, string $path): string;
}
