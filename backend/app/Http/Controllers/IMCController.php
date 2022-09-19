<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IMCController extends Controller
{
    public function handle(Request $request): JsonResponse
    {

        try {
            $imc = $this->calculate($request->weight, $request->height);
            $number = number_format($imc, 2, ",", ".");
        } catch (\Throwable $th) {
            $response = [
                'Code' => '400',
                'Type' => 'Error',
                'Message' => 'IMC Impossivel de Ser Calculado!',
                "Data" => ''
            ];
            return new JsonResponse($response, 400);
        }

        $response = [
            'Code' => '200',
            'Type' => 'Success',
            'Message' => 'IMC Calculado com Sucesso!',
            "Data" => $number
        ];
        return new JsonResponse($response, 200);

    }

    public function calculate($weight, $height) {

        $pow = pow($height, 2);

        $result = $weight/$pow;

        return $result;
    }

}
