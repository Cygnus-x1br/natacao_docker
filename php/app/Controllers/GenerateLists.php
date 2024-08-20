<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class GenerateLists extends Action
{
    public static function list_anos(int $user_id): array
    {
        $tempos = Container::getModel('Tempo');
        $tempos->__set('id_atleta', $user_id);
        $tempos_data = $tempos->getTempos();
        $anos = [];
        foreach ($tempos_data as $key => $value) {
            $ano = (explode('-', $value['dataTorneio']))[0];
            $anos[] = $ano;
        }
        return array_unique($anos);
    }

    public static function list_estados(): array
    {
        $estado = Container::getModel('Estados');
        return $estado->getAllEstados();
    }

    public static function list_complexos(): array
    {
        $piscinas = Container::getModel('Complexo');
        return $piscinas->getAllComplexos();
    }

    public static function list_federacoes(): array
    {
        $federacao = Container::getModel('Federacao');
        return $federacao->getAllFederacoes();
    }

    public static function list_equipes(): array
    {
        $equipes = Container::getModel('Equipe');
        return $equipes->getAllEquipes();
    }

    public static function list_categorias(): array
    {
        $categorias = Container::getModel('Categoria');
        return $categorias->getAllCategorias();
    }

    public static function list_torneios(): array
    {
        $torneio = Container::getModel('Torneio');
        return $torneio->getAllTorneios();
    }

    public static function list_todas_piscinas(): array
    {
        $piscinas = Container::getModel('Piscina');
        return $piscinas->getPiscinas();
    }

    public static function list_todos_estilos(): array
    {
        $estilo = Container::getModel('DistanciaEstilo');
        return $estilo->getAllDistanciaEstilo();
    }

    public static function list_torneios_atleta(int $user_id): array
    {
        $torneios = Container::getModel('Tempo');
        $torneios->__set('id_atleta', $user_id);
        $torneios_data = $torneios->getTempos();

        $torneio = [];
        foreach ($torneios_data as $key => $value) {
            $torneio[] = $value['nomeTorneio'];
        }
        return array_unique($torneio);
    }

    public static function list_estilos(int $user_id): array
    {
        $estilos = Container::getModel('Tempo');
        $estilos->__set('id_atleta', $user_id);
        $estilos_data = $estilos->getTempos();
        $estilo = [];
        foreach ($estilos_data as $key => $value) {
            $estilo[] = $value['distancia'] . ' m ' . $value['nomeEstilo'] . '*' . $value['distanciaEstilo'];
        }
        return array_unique($estilo);
    }
    public static function list_anos_indices(): array
    {
        $indices = Container::getModel('Indices');
        $indices_data = $indices->getIndicesSorted();
        foreach ($indices_data as $key => $value) {
            $anos[] = $value['anoIndice'];
        }
        return array_unique($anos);
    }

    public static function list_tipos(): array
    {
        $indices = Container::getModel('Indices');
        $indices_data = $indices->getIndicesSorted();
        foreach ($indices_data as $key => $value) {
            $tipoIndice[] = $value['tipoIndice'];
        }
        return array_unique($tipoIndice);
    }

    public static function list_tipos_recorde(): array
    {
        $tipoRecorde = [];
        $recordes = Container::getModel('Recordes');
        $recordes_data = $recordes->getRecordesSorted();
        foreach ($recordes_data as $key => $value) {
            //print_r($recordes_data);
            $tipoRecorde[] = $value['tipoRecorde'];
        }
        $tiposDeRecorde = array_unique($tipoRecorde) ?? [];

        return $tiposDeRecorde;
    }

    public static function list_piscinas(): array
    {
        $piscinas = Container::getModel('Piscina');
        $piscinas_data = $piscinas->getPiscinas();
        foreach ($piscinas_data as $key => $value) {
            $tamanhos[] = $value['tamanhoPiscina'];
        }
        return array_unique($tamanhos);
    }
    
    public static function list_atleta_email():array
    {
        $atletas = Container::getModel('Atleta');
        return $atletas->getAtletaIDEmail();
        
    }

}
