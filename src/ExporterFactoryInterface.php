<?php
/*
 * This file is part of the Shepherd Jobs project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter;

use ActiveCollab\Exporter\Exporters\ExporterInterface;

/**
 * @package ActiveCollab\Exporter
 */
interface ExporterFactoryInterface
{
    /**
     * Get exporter for.
     *
     * @param string $type
     * @param string $format
     * @return ExporterInterface
     */
    public function getExporterFor(string $type, string $format): ExporterInterface;
}