<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class Tempo
{
    public static function melhores_tempos():array
    {
        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_SESSION['user_id']);
        $tempoAtleta_data = $tempoAtleta->getMelhorTempo();
        $melhor_tempo = [];

        $filtra_prova = 0;
        foreach ($tempoAtleta_data as $tempo) {
            if ($filtra_prova != $tempo['ID_DISTANCIAESTILO'] && $tempo['tamanhoPiscina'] == 25) {
                $filtra_prova = $tempo['ID_DISTANCIAESTILO'];
                $melhor_tempo[] = ['data' => $tempo['dataTorneio'], 'torneio' => $tempo['nomeTorneio'], 'tempo' => $tempo['tempoAtleta'], 'distancia' => $tempo['distancia'], 'estilo' => $tempo['nomeEstilo'], 'piscina' => $tempo['tamanhoPiscina']];;
            }
        }

        foreach ($tempoAtleta_data as $tempo) {
            if ($filtra_prova != $tempo['ID_DISTANCIAESTILO'] && $tempo['tamanhoPiscina'] == 50) {
                $filtra_prova = $tempo['ID_DISTANCIAESTILO'];
                $melhor_tempo[] = ['data' => $tempo['dataTorneio'], 'torneio' => $tempo['nomeTorneio'], 'tempo' => $tempo['tempoAtleta'], 'distancia' => $tempo['distancia'], 'estilo' => $tempo['nomeEstilo'], 'piscina' => $tempo['tamanhoPiscina']];;
            }
        }
        return $melhor_tempo;
    }
}
