<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

// session_start();
class Assets extends Action
{
    public static function authenticate(): void
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

    public static function admin_authenticate(): void
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

    public static function verificaCPF(string $cpf): bool
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

    public static function verificaCadastroAtleta(string $sobreNome, string $dataNasc, string $cpf, string $email, string $numRegistroAtleta, string $nomeAtleta): void
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

    public static function verificaCadastroUsuario($username, $user_id): void
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

    public static function test_category(int $idade)
    {
        $categoria = Container::getModel('Categoria');
        $categoria->__set('idcategoria', $idade);
        return $categoria->getCategoria();
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

    public static function count_atletas(): int
    {
        $atletas = Container::getModel('Atleta');
        $atletas_data = $atletas->getAllAtletas();
        return count($atletas_data);
    }

    public static function count_equipes(): int
    {
        $equipes = Container::getModel('Equipe');
        $equipes_data = $equipes->getAllEquipes();
        return count($equipes_data);
    }

    public static function count_complexos(): int
    {
        $complexos = Container::getModel('Complexo');
        $complexos_data = $complexos->getAllComplexos();
        return count($complexos_data);
    }

    public static function count_torneios(): int
    {
        $torneios = Container::getModel('Torneio');
        $torneios_data = $torneios->getAllTorneios();
        return count($torneios_data);
    }

    public static function adjustCategory($date):int
    {
        if ($date < 7) {
            return 7;
        } elseif ($date > 18) {
            return 99;
        } else {
            return $date;
        }
    }
}
