<?php


namespace App\Service;

use Exception;
use App\AbstractClasses\BaseCar;

class CsvParse
{

    /**
     * @param string $file Файл
     * @param string $separator разделитель
     * @throws Exception
     */
    public function getCarList(string $file, string $separator = ';')
    {
        try {
            if (!file_exists($file)) {
                throw new Exception('Файл не найден');
            }

            $handle = @fopen($file, 'r');
            if (!$handle || empty($handle)) {
                throw new Exception('Невозможно прочитать файл');
            }

            // пропустим первую строчку и вычислим кол-во колонок
            $countCols = @count(fgetcsv($handle, 0, $separator));

            if ($countCols  < 2) throw new Exception('Файл пустой');

            // читаем файл и создаем обьекты
            while (($arr = fgetcsv($handle, 0, $separator)) !== false) {
                if (count($arr) === $countCols) {
                    $class = BaseCar::construct($arr[0], $arr[1], (float)$arr[2], $arr[3], $arr[4], (float)$arr[5], $arr[6]);
                    if (is_null($class)) {
                        continue;
                    }

                    $class->run();

                }
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}