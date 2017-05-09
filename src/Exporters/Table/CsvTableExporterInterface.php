<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exporters\Table;

use ActiveCollab\Exporter\Exporters\CsvExporterInterface;
use ActiveCollab\Exporter\Exporters\TableExporterInterface;

interface CsvTableExporterInterface extends CsvExporterInterface, TableExporterInterface
{
}
