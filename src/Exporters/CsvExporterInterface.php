<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exporters;

interface CsvExporterInterface extends ExporterInterface
{
    const EXPORT_FORMAT = 'csv';
}
