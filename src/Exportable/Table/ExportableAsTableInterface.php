<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exportable\Table;

use ActiveCollab\Exporter\Exportable\ExportableInterface;
use ActiveCollab\Exporter\Exportable\Table\Column\ExportColumnInterface;

interface ExportableAsTableInterface extends ExportableInterface
{
    const EXPORT_TYPE = 'table';

    /**
     * @param  array                            ...$args
     * @return iterable|ExportColumnInterface[]
     */
    public function getColumns(...$args): iterable;

    public function getRows(): iterable;
}
