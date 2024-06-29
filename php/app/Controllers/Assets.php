<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

// session_start();
class Assets extends Action
{
    public static function authenticate()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /error?error=1001');
            die();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: /error?error=1001');
            die();
        }
    }
    public static function admin_authenticate()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /error?error=1001');
            die();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: /error?error=1001');
            die();
        }
        if ($_SESSION['permissao'] != '2') {
            header('Location: /error?error=9001');
            die();
        }
    }
    public static function verificaCPF($cpf)
    {
        if (strlen($cpf) != 14) {
            return false;
        }
        if (
            $cpf == '000.000.000-00' ||
            $cpf == '111.111.111-11' ||
            $cpf == '222.222.222-22' ||
            $cpf == '333.333.333-33' ||
            $cpf == '444.444.444-44' ||
            $cpf == '555.555.555-55' ||
            $cpf == '666.666.666-66' ||
            $cpf == '777.777.777-77' ||
            $cpf == '888.888.888-88' ||
            $cpf == '999.999.999-99'
        ) {
            return false;
        }
        $cpfDigitos = explode('-', $cpf);
        $cpfNumeros = explode('.', $cpfDigitos[0]);
        $cpfNumero = '';
        foreach ($cpfNumeros as $numero) {
            $cpfNumero .= $numero;
        }

        $cpfDigito = str_split($cpfDigitos[1]);
        $cpfExplode = str_split($cpfNumero);

        $var = 10;
        $soma = 0;
        foreach ($cpfExplode as $digito) {
            $soma += $digito * $var;
            $var--;
        }

        $digito1 = 11 - ($soma % 11);
        if ($digito1 >= 10) {
            $digito1 = 0;
        }
        if ($digito1 != $cpfDigito[0]) {
            return false;
        }
        array_push($cpfExplode, $digito1);

        $var = 11;
        $soma = 0;
        foreach ($cpfExplode as $digito) {
            $soma += $digito * $var;
            $var--;
        }

        $digito2 = 11 - ($soma % 11);
        if ($digito2 >= 10) {
            $digito2 = 0;
        }
        if ($digito2 != $cpfDigito[1]) {
            return false;
        }
        return true;
    }

    public static function verificaCadastroAtleta($sobreNome, $dataNasc, $cpf, $email, $numRegistroAtleta, $nomeAtleta)
    {
        $atleta = Container::getModel('Atleta');
        $atleta->__set('sobreNomeAtleta', $sobreNome);
        $atleta->__set('dataNascAtleta', $dataNasc);
        $atleta->__set('cpfAtleta', $cpf);
        $atleta->__set('emailAtleta', $email);
        $atleta->__set('numRegistroAtleta', $numRegistroAtleta);
        $atleta_data = $atleta->verificaAllAtletas();

        foreach ($atleta_data as $atleta) {
            if ($atleta['sobreNomeAtleta'] == $sobreNome && $atleta['dataNascAtleta'] == $dataNasc && $atleta['nomeAtleta'] == $nomeAtleta) {
                header("Location: /error?error=2001");
                die();
            } elseif ($atleta['emailAtleta'] == $email) {
                header("Location: /error?error=2002");
                die();
            } elseif ($atleta['cpfAtleta'] == $cpf) {
                header("Location: /error?error=2003");
                die();
            } elseif ($atleta['numRegistroAtleta'] == $numRegistroAtleta && $atleta['numRegistroAtleta'] != '') {
                header("Location: /error?error=2004");
                die();
            }
        }
    }

    public static function verificaCadastroUsuario($username, $user_id)
    {
        $user = Container::getModel('User');
        $user->__set('username', $username);
        $user->__set('user_id', $user_id);
        $user_data = $user->verificaAllUsers();
        foreach ($user_data as $user) {
            if ($user['username'] == $username || $user['user_id'] == $user_id) {
                header("Location: /error?error=2002");
                die();
            }
        }
    }

    public static function list_anos($user_id)
    {
        $tempos = Container::getModel('Tempo');
        $tempos->__set('id_atleta', $user_id);
        $tempos_data = $tempos->getTempo();

        $anos = [];
        foreach ($tempos_data as $key => $value) {
            $ano = (explode('-', $value['dataTorneio']))[0];
            $anos[] = $ano;
        }
        return array_unique($anos);
    }
    public static function list_torneios($user_id)
    {
        $torneios = Container::getModel('Tempo');
        $torneios->__set('id_atleta', $user_id);
        $torneios_data = $torneios->getTempo();

        $torneio = [];
        foreach ($torneios_data as $key => $value) {
            $torneio[] = $value['nomeTorneio'];
        }
        return array_unique($torneio);
    }
    public static function list_estilos($user_id)
    {
        $estilos = Container::getModel('Tempo');
        $estilos->__set('id_atleta', $user_id);
        $estilos_data = $estilos->getTempo();

        $estilo = [];
        foreach ($estilos_data as $key => $value) {
            $estilo[] = $value['distancia'] . ' m ' . $value['nomeEstilo'] . '*' . $value['distanciaEstilo'];
        }
        return array_unique($estilo);
    }

    public static function list_equipes()
    {
        $equipes = Container::getModel('Equipe');
        return $equipes->getAllEquipes();
    }

    public static function test_category($idade)
    {
        $categoria = Container::getModel('Categoria');
        $categoria->__set('idcategoria', $idade);
        return $categoria->getCategoria();
    }

    public static function list_anos_indices()
    {
        $indices = Container::getModel('Indices');
        $indices_data = $indices->getIndicesSorted();
        foreach ($indices_data as $key => $value) {
            $anos[] = $value['anoIndice'];
        }
        return array_unique($anos);
    }
    public static function list_tipos()
    {
        $indices = Container::getModel('Indices');
        $indices_data = $indices->getIndicesSorted();
        foreach ($indices_data as $key => $value) {
            $tipoIndice[] = $value['tipoIndice'];
        }
        return array_unique($tipoIndice);
    }
    public static function list_categorias()
    {
        $categorias = Container::getModel('Categoria');
        $categorias_data = $categorias->getAllCategorias();
        return $categorias_data;
    }
    public static function list_piscinas()
    {
        $piscinas = Container::getModel('Piscina');
        $piscinas_data = $piscinas->getPiscinas();
        foreach ($piscinas_data as $key => $value) {
            $tamanhos[] = $value['tamanhoPiscina'];
        }
        return array_unique($tamanhos);
    }

    public static function list_todos_estilos()
    {
        $estilo = Container::getModel('DistanciaEstilo');
        $estilos_data = $estilo->getAllDistanciaEstilo();
        return $estilos_data;
    }
}
