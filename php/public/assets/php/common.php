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


