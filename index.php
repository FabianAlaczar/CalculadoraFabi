<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Operaciones Básicas</h1>
            <h3>José Fabián Alcázar Ramírez - 9A DyGS</h3>
        </header>
        <form method="POST">
            <div class="input-group">
                <label for="valor1">Número 1:</label>
                <input type="number" id="valor1" name="valor1" required>
            </div>
            <div class="input-group">
                <label for="valor2">Número 2:</label>
                <input type="number" id="valor2" name="valor2" required>
            </div>
            <div class="button-group">
                <button type="submit" name="operacion" value="sumar">Sumar</button>
                <button type="submit" name="operacion" value="restar">Restar</button>
                <!-- <button type="submit" name="operacion" value="multiplicar">Multiplicar</button>
                <button type="submit" name="operacion" value="dividir">Dividir</button> -->
            </div>
        </form>

        <?php
        $resultado = 0; // Inicializa el resultado en 0

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validación de datos
            $valor1 = filter_input(INPUT_POST, 'valor1', FILTER_VALIDATE_INT);
            $valor2 = filter_input(INPUT_POST, 'valor2', FILTER_VALIDATE_INT);
            $operacion = filter_input(INPUT_POST, 'operacion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $errores = [];

            if ($valor1 === false) {
                $errores[] = "El valor 1 no es un número válido.";
            }

            if ($valor2 === false) {
                $errores[] = "El valor 2 no es un número válido.";
            }

            if (empty($operacion) || !in_array($operacion, ['sumar', 'restar', 'multiplicar', 'dividir'])) {
                $errores[] = "Operación no válida.";
            }

            if (empty($errores)) {
                try {
                    if ($operacion == "sumar") {
                        $resultado = $valor1 + $valor2;
                    } elseif ($operacion == "restar") {
                        $resultado = $valor1 - $valor2;
                    // } elseif ($operacion == "multiplicar") {
                    //     $resultado = $valor1 * $valor2;
                    // } elseif ($operacion == "dividir") {
                    //     if ($valor2 != 0) {
                    //         $resultado = $valor1 / $valor2;
                    //     } else {
                    //         $errores[] = "No se puede dividir por cero.";
                    //     }
                    }
                } catch (Exception $e) {
                    echo "<div class='error'>Se ha producido un error: " . htmlspecialchars($e->getMessage()) . "</div>";
                }
            }

            if (!empty($errores)) {
                foreach ($errores as $error) {
                    echo "<div class='error'>" . htmlspecialchars($error) . "</div>";
                }
            } else {
                echo "<div class='result'>Resultado: " . htmlspecialchars($resultado) . "</div>";
            }
        } else {
            echo "<div class='result'>Resultado: " . htmlspecialchars($resultado) . "</div>";
        }
        ?>
    </div>
</body>
</html>
