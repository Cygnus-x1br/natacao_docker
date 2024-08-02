<?php

function adjustTime($fullTime)
{
  $time = explode(':', $fullTime);
  (array_shift($time));
  return implode(':', $time);
}

function convertDate($convertDate)
{
  return implode('/',  array_reverse(explode('-', $convertDate)));
  // return $date;
}

function tempoEmSegundos($tempo)
{
  $tempoEmSegundos = (explode(':', $tempo)[0] * 60) + explode(':', $tempo)[1];
  return $tempoEmSegundos;
}

function tempoEmMinutos($tempo)
{
    $signal = '';
    if($tempo < -60) {
        $signal = '-';
        $tempo = abs($tempo);
    }
    if($tempo > 60) {
        $tempoEmMinutos = floor($tempo / 60);
        $tempoEmSegundos = $tempo - ($tempoEmMinutos * 60);
        if($tempoEmSegundos < 9) {
            $tempoEmSegundos = '0'. $tempoEmSegundos;
        }
        if($tempoEmMinutos < 9 ) {
            $tempoEmMinutos = '0' . $tempoEmMinutos;
        }
        $tempoConvertido = $tempoEmMinutos . ':' . $tempoEmSegundos;
    } else {
        $tempoConvertido = $tempo;
    }
    //echo $tempoEmMinutos . '<br>';
    //echo $tempoEmSegundos . '<br>';
    //echo $tempoConvertido . '<br>';
    return $signal . $tempoConvertido;
    
}

function indiceTecnico($tempo, $id_distanciaestilo, $indicesMundial, $genero)
{
    $tempoAtleta = tempoEmSegundos($tempo);
    $tempoIndice = 0;
    foreach ($indicesMundial as $indice) {
        if ($indice['ID_DISTANCIAESTILO'] == $id_distanciaestilo && $indice['generoRecorde'] == $genero) {
            $tempo = adjustTime($indice['tempoRecorde']);
            $tempoIndice = tempoEmSegundos($tempo);
        }
    }
    $indiceTecnico = 1000 * pow(($tempoIndice / $tempoAtleta), 3);

    return floor($indiceTecnico);
}

function dd($var) {
    var_dump($var);
}

function print_var($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    
}
