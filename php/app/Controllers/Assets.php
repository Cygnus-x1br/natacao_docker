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
    public static function verificaCPF($cpf)
    {
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
}
