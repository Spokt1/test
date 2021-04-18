<?php


namespace App\CarClasses;


use App\AbstractClasses\BaseCar;

class SpecMachine extends BaseCar
{
    private $extra;

    public function __construct(string $brand, string $photoFileName, float $carrying, string $extra)
    {
        $this->carType = 'specMachine';
        parent::__construct($brand, $photoFileName, $carrying);
        $this->setExtra($extra);
    }

    /**
     * Валидация данных
     *
     * @return bool
     */
    protected function validate(): bool
    {
        $ret = parent::validate() && empty($this->extra);

        return $ret;
    }


    private function setExtra(string $extra): void
    {
        $this->extra = $extra;
    }
}