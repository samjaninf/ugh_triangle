<?php
namespace App\Classes;


use Maatwebsite\Excel\Files\ExcelFile;

class PostListImport extends ExcelFile
{
    protected $delimiter = ',';
    protected $enclosure = '"';
    protected $lineEnding = '\r\n';

    /**
     * Get file
     * @return string
     */
    public function getFile()
    {
        return public_path('excel/import.csv');
    }
}