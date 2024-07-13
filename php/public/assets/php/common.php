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
