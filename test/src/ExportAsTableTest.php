<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\ShepherdJobsConsumer\Test;

use ActiveCollab\Exporter\ExportColumnInterface;
use ActiveCollab\Exporter\Test\Mocks\TableExporterMock;
use ActiveCollab\Exporter\Test\TestCase;
use RuntimeException;

final class ExportAsTableTest extends TestCase
{
    /**
     * @dataProvider provideFormatsForExportTest
     * @param string $format
     * @param string $expected_file_extension
     */
    public function testTableExcelExport(string $format, string $expected_file_extension)
    {
        $excel_export = new TableExporterMock();

        $columns = [
            [
                'name' => 'id',
                'type' => ExportColumnInterface::COLUMN_TYPE_INT,
                'width' => ExportColumnInterface::COLUMN_WIDTH_SMALL,
                'align' => ExportColumnInterface::COLUMN_ALIGN_LEFT,
            ],
            [
                'name' => 'name',
                'type' => ExportColumnInterface::COLUMN_TYPE_STRING,
                'width' => ExportColumnInterface::COLUMN_WIDTH_MEDIUM,
                'align' => ExportColumnInterface::COLUMN_ALIGN_LEFT,
            ],
            [
                'name' => 'body',
                'type' => ExportColumnInterface::COLUMN_TYPE_STRING,
                'width' => ExportColumnInterface::COLUMN_WIDTH_MEDIUM,
                'align' => ExportColumnInterface::COLUMN_ALIGN_CENTER,
            ],
            [
                'name' => 'due_on',
                'type' => ExportColumnInterface::COLUMN_TYPE_DATE,
                'width' => ExportColumnInterface::COLUMN_WIDTH_NORMAL,
                'align' => ExportColumnInterface::COLUMN_ALIGN_RIGHT,
            ],
            [
                'name' => 'value',
                'type' => ExportColumnInterface::COLUMN_TYPE_FLOAT,
                'width' => ExportColumnInterface::COLUMN_WIDTH_NORMAL,
                'align' => ExportColumnInterface::COLUMN_ALIGN_LEFT,
            ],
            [
                'name' => 'amount',
                'type' => ExportColumnInterface::COLUMN_TYPE_FLOAT,
                'width' => ExportColumnInterface::COLUMN_WIDTH_SMALL,
                'align' => ExportColumnInterface::COLUMN_ALIGN_CENTER,
            ],
            [
                'name' => 'created_by_id',
                'type' => ExportColumnInterface::COLUMN_TYPE_INT,
                'width' => ExportColumnInterface::COLUMN_WIDTH_SMALL,
                'align' => ExportColumnInterface::COLUMN_ALIGN_LEFT,
            ],
            [
                'name' => 'created_by_email',
                'type' => ExportColumnInterface::COLUMN_TYPE_STRING,
                'width' => ExportColumnInterface::COLUMN_WIDTH_SMALL,
                'align' => ExportColumnInterface::COLUMN_ALIGN_RIGHT,
            ],
            [
                'name' => 'created_on',
                'type' => ExportColumnInterface::COLUMN_TYPE_DATE,
                'width' => ExportColumnInterface::COLUMN_WIDTH_SMALL,
                'align' => ExportColumnInterface::COLUMN_ALIGN_AUTO,
            ],
        ];

        $m = 1;
        $y = 2017;
        $rows = [];

        for ($i = 1; $i < 1000; $i++) {
            $rows[] = [
                'id' => $i,
                'name' => $i . ' row in object',
                'body' => 'ÜÖÄ Some text in ' . $i . ' row in object Wassuuuuuuuuup\n\nHelllooo\n\n\nGoodbye',
                'due_on' => "{$y}-{$m}-07",
                'value' => $i / 3,
                'amount' => 10 + $i,
                'created_by_id' => 1,
                'created_by_email' => 'test@activecollab.com',
                'created_on' => "{$y}-{$m}-06",
            ];

            $m++;

            if ($m >= 12) {
                $m = 1;
                $y++;
            }
        }

        $excel_export->setColumns($columns);
        $excel_export->setRows($rows);

        switch ($format) {
            case 'xlsx':
                $export_file_path = $excel_export->exportExcel();
                break;
            case 'csv':
                $export_file_path = $excel_export->exportCsv();
                break;
            default:
                throw new RuntimeException("Invalid format '{$format}'.");
        }

        $this->assertFileExists($export_file_path);

        $this->assertStringEndsWith($expected_file_extension, $export_file_path);
    }

    public function provideFormatsForExportTest(): array
    {
        return [
            ['xlsx', '.xlsx'],
            ['csv', '.csv'],
        ];
    }
}
