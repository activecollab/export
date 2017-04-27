<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter;

use ActiveCollab\Exporter\Exporters\ExporterInterface;

interface ExporterFactoryInterface
{
    /**
     * Get exporter for.
     *
     * @param  string            $type
     * @param  string            $format
     * @return ExporterInterface
     */
    public function getExporterFor(string $type, string $format): ExporterInterface;
}
