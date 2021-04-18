<?php


namespace App\CarClasses;


use App\AbstractClasses\BaseCar;

class Truck extends BaseCar
{
    private $bodyWidth = 0;
    private $bodyHeight = 0;
    private $bodyLenght = 0;
    private $bodyVolume = 0;

    public function __construct(string $brand, string $photoFileName, float $carrying, string $bodyWhl)
    {
        $this->carType = 'truck';
        parent::__construct($brand, $photoFileName, $carrying);
        $params = $this->explodeBodyParams($bodyWhl);
        if (count($params) === 3) {
            $this->setParams($params);
        }
    }


    /**
     * Разбираем характеристики(Ширина,Высота,Длина)
     *
     * @param string $bodyWhl
     * @return array
     */
    private function explodeBodyParams(string $bodyWhl): array
    {
        return explode('x', $bodyWhl);
    }

    /**
     * Получаем объем кузова в куб.метрах
     *
     * @return float
     */
    public function getBodyVolume(): float
    {
        return $this->bodyVolume;
    }

    /**
     * Присваеваем характеристики(Ширина,Высота,Длина)
     *
     * @param array $props
     * @return void
     */
    private function setParams(array $props): void
    {
        $this->bodyWidth = (float)$props[0];
        $this->bodyHeight = (float)$props[1];
        $this->bodyLenght = (float)$props[2];
        $this->bodyVolume = $this->bodyLenght * $this->bodyHeight * $this->bodyWidth;
    }

    protected function doSomething() : void
    {
        parent::doSomething();
        dump($this->getBodyVolume());
    }

}