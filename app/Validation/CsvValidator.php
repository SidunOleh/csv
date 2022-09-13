<?php

namespace App\Validation;

use Exception;

class CsvValidator
{
    /**
     * @var CsvValidatorScheme $scheme 
     */
    private $scheme;

    /**
     * @param string $scheme scheme file name
     */
    public function __construct($scheme)
    {
        $this->setScheme($scheme);
    }

    /**
     * @param string $scheme scheme file name
     * @return void
     * 
     * @throws CsvValidatorException
     */
    public function setScheme($scheme)
    {
        if (! is_readable($scheme)) {
            throw new CsvValidatorException('Could Not Read Scheme File.');
        }

        $this->scheme = new CsvValidatorScheme(file_get_contents($scheme));
    }

    /**
     * @param string $file csv file name
     * @return bool
     * 
     * @throws CsvValidatorException
     */
    public function isValidFile($file)
    {
        if (! is_readable($file)) {
            throw new CsvValidatorException('Could Not Read CSV File.');
        }

        foreach (file($file) as $index => $line) {
            if ($this->scheme->skipFirstLine and ! $index) {
                continue;
            }

            if (! $this->isValidLine($line)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $line csv line
     * @return bool
     */
    public function isValidLine($line)
    {
        if (! preg_match($this->scheme->regex, trim($line))) {
            return false;
        }

        return true;
    }
}

class CsvValidatorScheme
{

    /**
     * @var bool $skipFirstLine 
     */
    public $skipFirstLine = 0;

    /**
     * @var string $regex 
     */
    public $regex = '//';

    /**
     * @var string $scheme 
     */
    public function __construct($scheme)
    {
        $this->set(json_decode($scheme, true));
    }

    /**
     * Parsing scheme from JSON
     * 
     * @var string $scheme 
     */
    private function set($scheme)
    {
        if (is_null($scheme)) {
            return;
        }

        foreach ($scheme as $key => $value) {;
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}

class CsvValidatorException extends Exception
{

}
