<?php

namespace App\Services\Common;

use Maatwebsite\Excel\Excel;

class ExcelServices
{
    /**
     * Export excel.
     * @param array $data
     * @param string $fileName
     * @param string $type
     */
    public function export($data = array(), $fileName = 'Data', $type = 'xls')
    {
        Excel::create($fileName, function($excel) use ($data) {

            $excel->sheet('New sheet', function($sheet) use ($data) {

                $sheet->fromArray($data,null, 'A1', false, false);

            });

        })->download($type);
    }
}