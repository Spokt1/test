<?php


namespace App\CarClasses;


use App\AbstractClasses\BaseCar;

class Car extends BaseCar
{
    private $passengerSeatsCount;

    public function __construct(string $brand,string $photoFileName,float $carrying,float $passengerSeatsCount)
    {
        $this->carType = 'car';
        parent::__construct($brand,$photoFileName,$carrying);
        $this->setPassengerSeatsCount($passengerSeatsCount);
    }

    /**
     * Валидация данных
     *
     * @return bool
     */
    protected function validate() : bool
    {
        $ret = parent::validate() && is_numeric($this->passengerSeatsCount);

        return $ret;
    }

    private function setPassengerSeatsCount(float $passengerSeatsCount) : void
    {
        $this->passengerSeatsCount = $passengerSeatsCount;
    }

}