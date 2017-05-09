<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exporter\Table;

use ActiveCollab\Exporter\Exporter\CsvExporterInterface;
use ActiveCollab\Exporter\Exporter\TableExporterInterface;

interface CsvTableExporterInterface extends CsvExporterInterface, TableExporterInterface
{
}
