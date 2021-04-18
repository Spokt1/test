<?php


namespace App\Controller;


use App\Service\CsvParse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function main()
    {
        $parse = new CsvParse();
        /*выводим данные*/
        dd($parse->getCarList('files/test.csv'));
    }

}