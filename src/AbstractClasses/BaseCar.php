<?php


namespace App\AbstractClasses;


use App\CarClasses\Car;
use App\CarClasses\SpecMachine;
use App\CarClasses\Truck;

abstract class BaseCar
{
    protected $carType;
    protected $filePath;
    protected $photoFileName;
    protected $brand;
    protected $carrying;

    public function __construct(string $brand, string $photoFileName, float $carrying)
    {
        $this->brand = $brand;
        $this->carrying = $carrying;
        $this->filePath = $photoFileName;
    }

    /**
     * Проверяем поля на пустоту и файл на расширение
     *
     * @return bool
     */
    protected function validate() : bool
    {
        $ret = true;
        if (empty($this->filePath) || $this->carrying === "" || empty($this->brand)) {
            $ret = false;
        } else {
            $fileIfno = pathinfo($this->filePath);

            if (!key_exists('extension', $fileIfno)) $ret = false;
            else    $this->photoFileName = [$fileIfno['filename'] => $fileIfno['extension']];

        }

        return $ret;
    }

    /**
     * Точка старта для всех обьектов
     *
     * @return void
     */
    public function run(): void
    {
        if ($this->validate()) {
            $this->doSomething();
        }
    }

    /**
     * Выводим обьекты
     *
     * @return void
     */
    protected function doSomething(): void
    {
        dump($this);
        dump($this->getPhotoFileExt());
    }

    /**
     * @param string $type Тип (car_type)
     * @param string $brand Марка (brand)
     * @param float $passengerSeatsCount Кол-во пассажирских мест(passenger_seats_count)
     * @param string $photoFileName Фото (photo_file_name)
     * @param string $bodyWhl Кузов ДxШxВ, м(body_whl)
     * @param float $carrying Грузоподъемность, Тонн(carrying)
     * @param string $extra Дополнительно (extra)
     * @return Car | Truck | SpecMachine | null
     */
    static function construct(string $type, string $brand, float $passengerSeatsCount, string $photoFileName,
                              string $bodyWhl, float $carrying, string $extra)
    {
        switch ($type) {
            case 'car':
                return new Car($brand, $photoFileName, $carrying, $passengerSeatsCount);
            case 'truck';
                return new Truck($brand, $photoFileName, $carrying, $bodyWhl);
            case 'spec_machine':
                return new SpecMachine($brand, $photoFileName, $carrying, $extra);
            default:
                return null;
        }
    }

    /**
     * Получаем имя файла и его расширенее
     *
     * @param $photoFileName
     * @return array
     */
    public function getPhotoFileExt(): array
    {
        return $this->photoFileName;
    }
}