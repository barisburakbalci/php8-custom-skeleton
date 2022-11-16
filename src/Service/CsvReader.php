<?php

namespace Barisburakbalci\InterviewBankAccount\Service;

class CsvReader
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function toArray() : array
    {
        $rows = array_map('str_getcsv', file($this->path));
        return $rows;
    }
}