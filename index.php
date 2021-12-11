<?php
session_start();
class CalculadoraBasica
{
    public $pantalla = "";
    public $contador = 0;
    public $memoria = 0;
    public $mem = 0;

    public function digito($numero)
    {
        $this->pantalla .= $numero;
    }

    /**Borra todo lo que esté en pantalla */

    public function borrarTodo()
    {
        $this->pantalla = "";
    }

    /**Guarda número en memoria y resta esa misma cantidad a la memoria cuando se vuelve a presionar */

    public function mMenos()
    {
        if ($this->contador == 0) {
            $this->mem = (float)$this->pantalla;
            $this->memoria = $this->mem;
        } else {
            $this->memoria -= $this->mem;
        }
        $this->pantalla = $this->memoria;
        $this->contador++;
    }

    /**Guarda número en memoria y resta esa misma cantidad a la memoria cuando se vuelve a presionar */

    public function mMas()
    {
        if ($this->contador == 0) {
            $this->mem = (float)$this->pantalla;
            $this->memoria = $this->mem;
        } else {
            $this->memoria += $this->mem;
        }
        $this->pantalla = $this->memoria;
        $this->contador++;
    }

    /**Elimina número en memoria */

    public function mrc()
    {
        $this->mem=0;
        $this->memoria = 0;
        $this->contador = 0;
        $this->pantalla = "";
    }

    /**Separar método en submétodos (uno para separar operadores y numeros)*/

    /**Evalúa la expresión con eval */

    public function igual()
    {
        try{
            $resultado = eval("return $this->pantalla ;");
            $this->pantalla = $resultado;
        } catch (Exception $e) {
            "Error: operación inválida";
        }
    }
}


if (isset($_SESSION['calculadora'])) {
    $calculadora = $_SESSION['calculadora'];
} else {
    $calculadora = new CalculadoraBasica();
    $_SESSION['calculadora'] = $calculadora;
}

if (count($_POST) > 0) {
    try {
        if (isset($_POST["borrar"])) {
            $calculadora->borrarTodo();
        }
        if (isset($_POST["digito"])) {
            $calculadora->digito($_POST["digito"]);
        } else if (isset($_POST["igual"])) {
            $calculadora->igual();
        } else if (isset($_POST["mMas"])) {
            $calculadora->mMas();
        } else if (isset($_POST["mMenos"])) {
            $calculadora->mMenos();
        } else if (isset($_POST["mrc"])) {
            $calculadora->mrc();
        }
    } catch (Exception $e) {
        $calculadora->error($e);
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Básica</title>
    <link href="CalculadoraBasica.css" rel="stylesheet" />
</head>

<body>
    <h1>Calculadora Básica</h1>
    <main>
        <form action="#" method="post">
            <p name="expresion"><?php echo $_SESSION['calculadora']->pantalla; ?></p>
            <input type="submit" name="mrc" value="mrc" />
            <input type="submit" name="mMenos" value="m-" />
            <input type="submit" name="mMas" value="m+" />
            <input type="submit" name="digito" value="/" />
            <input type="submit" name="digito" value="7" />
            <input type="submit" name="digito" value="8" />
            <input type="submit" name="digito" value="9" />
            <input type="submit" name="digito" value="*" />
            <input type="submit" name="digito" value="4" />
            <input type="submit" name="digito" value="5" />
            <input type="submit" name="digito" value="6" />
            <input type="submit" name="digito" value="-" />
            <input type="submit" name="digito" value="1" />
            <input type="submit" name="digito" value="2" />
            <input type="submit" name="digito" value="3" />
            <input type="submit" name="digito" value="+" />
            <input type="submit" name="digito" value="0" />
            <input type="submit" name="digito" value="." />
            <input type="submit" name="borrar" value="C" />
            <input type="submit" name="igual" value="=" />
        </form>
    </main>
</body>

</html>
