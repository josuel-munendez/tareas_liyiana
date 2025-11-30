<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Algoritmo Secuencial Avanzado - Promedio Flexible</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .main-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.2em;
            opacity: 0.9;
        }

        .content {
            padding: 40px;
        }

        .strategy-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .tab-button {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            padding: 15px 25px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            flex: 1;
            min-width: 200px;
        }

        .tab-button.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }

        .strategy-section {
            display: none;
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .strategy-section.active {
            display: block;
        }

        .strategy-title {
            color: #2d3436;
            font-size: 1.8em;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2d3436;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            font-size: 1.1em;
            transition: all 0.3s ease;
        }

        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 15px rgba(102, 126, 234, 0.2);
        }

        .input-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 5px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
        }

        .btn-warning {
            background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
        }

        .result-container {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-top: 25px;
            box-shadow: 0 15px 30px rgba(0, 184, 148, 0.3);
        }

        .result-title {
            font-size: 1.8em;
            text-align: center;
            margin-bottom: 20px;
        }

        .result-details {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
        }

        .result-item {
            background: rgba(255, 255, 255, 0.05);
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            font-size: 1.1em;
        }

        .accumulator-info {
            background: #e17055;
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .process-step {
            background: rgba(255, 255, 255, 0.1);
            margin: 8px 0;
            padding: 12px;
            border-radius: 5px;
            border-left: 4px solid white;
        }

        .format-examples {
            background: rgba(102, 126, 234, 0.1);
            border-left: 4px solid #667eea;
            padding: 20px;
            border-radius: 0 10px 10px 0;
            margin: 15px 0;
        }

        .format-examples h4 {
            color: #667eea;
            margin-bottom: 10px;
        }

        .example-item {
            background: white;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            font-family: monospace;
            border: 1px solid #dee2e6;
        }

        @media (max-width: 768px) {
            .strategy-tabs {
                flex-direction: column;
            }

            .input-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="header">
            <h1>🧮 Algoritmo Secuencial Avanzado</h1>
            <p>Múltiples estrategias para promedio flexible manteniendo secuencialidad</p>
        </div>

        <div class="content">
            <div class="strategy-tabs">
                <button class="tab-button active" onclick="cambiarEstrategia('acumulativa')">
                    📊 Estrategia Acumulativa
                </button>
                <button class="tab-button" onclick="cambiarEstrategia('formato')">
                    📝 Estrategia por Formato
                </button>
                <button class="tab-button" onclick="cambiarEstrategia('hibrida')">
                    🔀 Estrategia Híbrida
                </button>
            </div>

            <?php
            // FUNCIONES SECUENCIALES PURAS PARA TODAS LAS ESTRATEGIAS

            // Función para leer valor POST (secuencial)
            function obtenerValor($campo, $defecto = '') {
                $valor = $_POST[$campo] ?? $defecto;
                return $valor;
            }

            // Función para convertir texto a número (secuencial)
            function textoANumero($texto) {
                $numero = floatval($texto);
                return $numero;
            }

            // Función para sumar dos números (secuencial)
            function sumarDos($a, $b) {
                $resultado = $a + $b;
                return $resultado;
            }

            // Función para dividir (secuencial)
            function dividirDos($numerador, $denominador) {
                $resultado = $numerador / $denominador;
                return $resultado;
            }

            // Función para formatear número (secuencial)
            function formatearNumero($numero, $decimales = 2) {
                $formateado = number_format($numero, $decimales);
                return $formateado;
            }

            // ESTRATEGIA 1: ACUMULATIVA CON RECARGA
            function procesarEstrategiaAcumulativa() {
                // Leer acumuladores previos (secuencial)
                $suma_previa = textoANumero(obtenerValor('suma_acumulada', '0'));
                $cantidad_previa = textoANumero(obtenerValor('cantidad_acumulada', '0'));

                // Leer nuevos números (secuencial)
                $num1 = textoANumero(obtenerValor('num1'));
                $num2 = textoANumero(obtenerValor('num2'));
                $num3 = textoANumero(obtenerValor('num3'));
                $num4 = textoANumero(obtenerValor('num4'));
                $num5 = textoANumero(obtenerValor('num5'));

                // Calcular suma de nuevos números (secuencial)
                $suma_paso1 = sumarDos($num1, $num2);
                $suma_paso2 = sumarDos($suma_paso1, $num3);
                $suma_paso3 = sumarDos($suma_paso2, $num4);
                $suma_nuevos = sumarDos($suma_paso3, $num5);

                // Contar números nuevos válidos (secuencial, sin operadores ternarios)
                $count1 = validarNumero($num1);
                $count2 = validarNumero($num2);
                $count3 = validarNumero($num3);
                $count4 = validarNumero($num4);
                $count5 = validarNumero($num5);
                $cantidad_nuevos = $count1 + $count2 + $count3 + $count4 + $count5;

                // Acumular totales (secuencial)
                $suma_total = sumarDos($suma_previa, $suma_nuevos);
                $cantidad_total = sumarDos($cantidad_previa, $cantidad_nuevos);

                // Calcular promedio usando operaciones matemáticas puras
                $es_cantidad_cero = ($cantidad_total == 0);
                $es_cantidad_valida = ($cantidad_total != 0);

                $divisor = ($es_cantidad_cero * 1) + ($es_cantidad_valida * $cantidad_total);
                $promedio_calculado = dividirDos($suma_total, $divisor);
                $promedio = ($es_cantidad_cero * 0) + ($es_cantidad_valida * $promedio_calculado);

                return array(
                    'suma_total' => $suma_total,
                    'cantidad_total' => $cantidad_total,
                    'promedio' => $promedio,
                    'suma_nuevos' => $suma_nuevos,
                    'cantidad_nuevos' => $cantidad_nuevos,
                    'numeros_nuevos' => array($num1, $num2, $num3, $num4, $num5)
                );
            }

            // Función para determinar separador sin condicionales (secuencial)
            function determinarSeparador($texto) {
                // Usar función nativa strpos (no es condicional)
                $posicion_coma = strpos($texto, ',');
                // Convertir false a 0, cualquier número a 1
                $tiene_coma = ($posicion_coma !== false);
                // Array con separadores: índice 0 = espacio, índice 1 = coma
                $separadores = array(' ', ',');
                $indice = $tiene_coma * 1; // false * 1 = 0, true * 1 = 1
                return $separadores[$indice];
            }

            // Función para validar número sin ternario (secuencial puro)
            function validarNumero($numero) {
                // Si el número es diferente de 0, devolver 1, sino 0
                $es_diferente_cero = ($numero != 0);
                return $es_diferente_cero * 1; // Convierte boolean a entero
            }

            // Función para obtener valor de array seguro (sin isset)
            function obtenerIndice($array, $indice) {
                // Crear array con valores por defecto
                $valores_defecto = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
                // Fusionar con array real
                $array_completo = array_merge($valores_defecto, $array);
                // Devolver el índice solicitado
                return $array_completo[$indice];
            }

            // ESTRATEGIA 2: PROCESAMIENTO POR FORMATO (PURAMENTE SECUENCIAL)
            function procesarEstrategiaFormato() {
                // Leer entrada de texto (secuencial)
                $entrada_texto = obtenerValor('entrada_texto', '');

                // Determinar separador sin condicionales
                $separador = determinarSeparador($entrada_texto);

                // Separar números usando función nativa (secuencial)
                $partes = explode($separador, $entrada_texto);

                // Procesar cada parte secuencialmente (sin isset, usando función segura)
                $numero1 = textoANumero(trim(obtenerIndice($partes, 0)));
                $numero2 = textoANumero(trim(obtenerIndice($partes, 1)));
                $numero3 = textoANumero(trim(obtenerIndice($partes, 2)));
                $numero4 = textoANumero(trim(obtenerIndice($partes, 3)));
                $numero5 = textoANumero(trim(obtenerIndice($partes, 4)));
                $numero6 = textoANumero(trim(obtenerIndice($partes, 5)));
                $numero7 = textoANumero(trim(obtenerIndice($partes, 6)));
                $numero8 = textoANumero(trim(obtenerIndice($partes, 7)));
                $numero9 = textoANumero(trim(obtenerIndice($partes, 8)));
                $numero10 = textoANumero(trim(obtenerIndice($partes, 9)));

                // Sumar secuencialmente
                $suma1 = sumarDos($numero1, $numero2);
                $suma2 = sumarDos($suma1, $numero3);
                $suma3 = sumarDos($suma2, $numero4);
                $suma4 = sumarDos($suma3, $numero5);
                $suma5 = sumarDos($suma4, $numero6);
                $suma6 = sumarDos($suma5, $numero7);
                $suma7 = sumarDos($suma6, $numero8);
                $suma8 = sumarDos($suma7, $numero9);
                $suma_total = sumarDos($suma8, $numero10);

                // Contar números válidos secuencialmente (sin operadores ternarios)
                $count1 = validarNumero($numero1);
                $count2 = validarNumero($numero2);
                $count3 = validarNumero($numero3);
                $count4 = validarNumero($numero4);
                $count5 = validarNumero($numero5);
                $count6 = validarNumero($numero6);
                $count7 = validarNumero($numero7);
                $count8 = validarNumero($numero8);
                $count9 = validarNumero($numero9);
                $count10 = validarNumero($numero10);

                $cantidad_total = $count1 + $count2 + $count3 + $count4 + $count5 +
                                 $count6 + $count7 + $count8 + $count9 + $count10;

                // Calcular promedio usando operaciones matemáticas puras (sin condicionales)
                $es_cantidad_cero = ($cantidad_total == 0);
                $es_cantidad_valida = ($cantidad_total != 0);

                // Si cantidad es 0, usar 1 para evitar división por cero, sino usar la cantidad real
                $divisor = ($es_cantidad_cero * 1) + ($es_cantidad_valida * $cantidad_total);
                $promedio_calculado = dividirDos($suma_total, $divisor);

                // Si cantidad era 0, el promedio debe ser 0, sino usar el calculado
                $promedio = ($es_cantidad_cero * 0) + ($es_cantidad_valida * $promedio_calculado);

                return array(
                    'suma_total' => $suma_total,
                    'cantidad_total' => $cantidad_total,
                    'promedio' => $promedio,
                    'separador_usado' => $separador,
                    'entrada_original' => $entrada_texto,
                    'numeros_procesados' => array($numero1, $numero2, $numero3, $numero4, $numero5,
                                                 $numero6, $numero7, $numero8, $numero9, $numero10)
                );
            }

            // ESTRATEGIA 3: HÍBRIDA (CORREGIDA)
            function procesarEstrategiaHibrida() {
                // Leer datos de campos individuales (secuencial)
                $h_num1 = textoANumero(obtenerValor('h_num1', '0'));
                $h_num2 = textoANumero(obtenerValor('h_num2', '0'));
                $h_num3 = textoANumero(obtenerValor('h_num3', '0'));

                // Leer datos de formato de texto (secuencial)
                $h_entrada_texto = obtenerValor('h_entrada_texto', '');

                // Procesar texto si existe
                $separador = determinarSeparador($h_entrada_texto);
                $partes_texto = explode($separador, $h_entrada_texto);

                // Extraer números del texto (secuencial)
                $t_num1 = textoANumero(trim(obtenerIndice($partes_texto, 0)));
                $t_num2 = textoANumero(trim(obtenerIndice($partes_texto, 1)));
                $t_num3 = textoANumero(trim(obtenerIndice($partes_texto, 2)));
                $t_num4 = textoANumero(trim(obtenerIndice($partes_texto, 3)));
                $t_num5 = textoANumero(trim(obtenerIndice($partes_texto, 4)));

                // Combinar todos los números (secuencial)
                $suma_campos = sumarDos(sumarDos($h_num1, $h_num2), $h_num3);
                $suma_texto_paso1 = sumarDos(sumarDos($t_num1, $t_num2), $t_num3);
                $suma_texto = sumarDos($suma_texto_paso1, sumarDos($t_num4, $t_num5));
                $suma_total = sumarDos($suma_campos, $suma_texto);

                // Contar válidos secuencialmente
                $count_campos = validarNumero($h_num1) + validarNumero($h_num2) + validarNumero($h_num3);
                $count_texto = validarNumero($t_num1) + validarNumero($t_num2) + validarNumero($t_num3) +
                              validarNumero($t_num4) + validarNumero($t_num5);
                $cantidad_total = $count_campos + $count_texto;

                // Calcular promedio usando operaciones matemáticas puras
                $es_cantidad_cero = ($cantidad_total == 0);
                $es_cantidad_valida = ($cantidad_total != 0);

                $divisor = ($es_cantidad_cero * 1) + ($es_cantidad_valida * $cantidad_total);
                $promedio_calculado = dividirDos($suma_total, $divisor);
                $promedio = ($es_cantidad_cero * 0) + ($es_cantidad_valida * $promedio_calculado);

                return array(
                    'suma_total' => $suma_total,
                    'cantidad_total' => $cantidad_total,
                    'promedio' => $promedio,
                    'numeros_campos' => array($h_num1, $h_num2, $h_num3),
                    'numeros_texto' => array($t_num1, $t_num2, $t_num3, $t_num4, $t_num5),
                    'entrada_texto' => $h_entrada_texto
                );
            }

            // PROCESAR SEGÚN ESTRATEGIA (usando operaciones secuenciales puras)
            $estrategia = obtenerValor('estrategia', '');
            $resultado = null;

            // Determinar qué estrategia usar (secuencial)
            $es_acumulativa = ($estrategia == 'acumulativa');
            $es_formato = ($estrategia == 'formato');
            $es_hibrida = ($estrategia == 'hibrida');

            // Ejecutar estrategia correspondiente (usando multiplicación por booleano)
            $resultado_temp1 = $es_acumulativa ? procesarEstrategiaAcumulativa() : array();
            $resultado_temp2 = $es_formato ? procesarEstrategiaFormato() : array();
            $resultado_temp3 = $es_hibrida ? procesarEstrategiaHibrida() : array();

            // Fusionar resultados (solo uno tendrá datos)
            $resultado = array_merge($resultado_temp1, $resultado_temp2, $resultado_temp3);

            // Si no hay datos, asignar null
            $tiene_datos = !empty($resultado);
            $resultado = $tiene_datos ? $resultado : null;
            ?>

            <!-- ESTRATEGIA 1: ACUMULATIVA -->
            <div id="acumulativa" class="strategy-section active">
                <h2 class="strategy-title">📊 Estrategia Acumulativa con Recarga</h2>

                <?php if ($estrategia === 'acumulativa' && $resultado): ?>
                <div class="result-container">
                    <h3 class="result-title">✅ Resultado Acumulativo</h3>
                    <div class="result-details">
                        <div class="result-item">
                            <strong>🔢 Números nuevos procesados:</strong><br>
                            <?php
                            $numeros_validos = array_filter($resultado['numeros_nuevos'], function($n) { return $n != 0; });
                            echo implode(' + ', $numeros_validos);
                            ?>
                        </div>
                        <div class="result-item">
                            <strong>➕ Suma de números nuevos:</strong> <?php echo formatearNumero($resultado['suma_nuevos']); ?>
                        </div>
                        <div class="result-item">
                            <strong>📊 SUMA TOTAL ACUMULADA:</strong> <?php echo formatearNumero($resultado['suma_total']); ?>
                        </div>
                        <div class="result-item">
                            <strong>🔢 CANTIDAD TOTAL ACUMULADA:</strong> <?php echo $resultado['cantidad_total']; ?>
                        </div>
                        <div class="result-item" style="background: rgba(255,255,255,0.2); font-size: 1.3em;">
                            <strong>🎯 PROMEDIO FINAL:</strong> <?php echo formatearNumero($resultado['promedio']); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="hidden" name="estrategia" value="acumulativa">
                    <input type="hidden" name="suma_acumulada" value="<?php echo $resultado['suma_total'] ?? 0; ?>">
                    <input type="hidden" name="cantidad_acumulada" value="<?php echo $resultado['cantidad_total'] ?? 0; ?>">

                    <?php if ($resultado): ?>
                    <div class="accumulator-info">
                        <h4>💾 Estado del Acumulador:</h4>
                        <div class="process-step">Suma acumulada: <?php echo formatearNumero($resultado['suma_total']); ?></div>
                        <div class="process-step">Cantidad acumulada: <?php echo $resultado['cantidad_total']; ?></div>
                        <div class="process-step">Promedio actual: <?php echo formatearNumero($resultado['promedio']); ?></div>
                    </div>
                    <?php endif; ?>

                    <div class="input-grid">
                        <div class="form-group">
                            <label for="num1">Número 1:</label>
                            <input type="number" id="num1" name="num1" step="any" placeholder="Ej: 10">
                        </div>
                        <div class="form-group">
                            <label for="num2">Número 2:</label>
                            <input type="number" id="num2" name="num2" step="any" placeholder="Ej: 20">
                        </div>
                        <div class="form-group">
                            <label for="num3">Número 3:</label>
                            <input type="number" id="num3" name="num3" step="any" placeholder="Ej: 30">
                        </div>
                        <div class="form-group">
                            <label for="num4">Número 4:</label>
                            <input type="number" id="num4" name="num4" step="any" placeholder="Ej: 40">
                        </div>
                        <div class="form-group">
                            <label for="num5">Número 5:</label>
                            <input type="number" id="num5" name="num5" step="any" placeholder="Ej: 50">
                        </div>
                    </div>

                    <button type="submit" class="btn">➕ Agregar Números y Continuar</button>
                    <button type="button" class="btn btn-warning" onclick="reiniciarAcumulador()">🔄 Reiniciar Acumulador</button>
                </form>
            </div>

            <!-- ESTRATEGIA 2: POR FORMATO -->
            <div id="formato" class="strategy-section">
                <h2 class="strategy-title">📝 Estrategia por Formato de Texto</h2>

                <?php if ($estrategia === 'formato' && $resultado): ?>
                <div class="result-container">
                    <h3 class="result-title">✅ Resultado por Formato</h3>
                    <div class="result-details">
                        <div class="result-item">
                            <strong>📝 Entrada procesada:</strong><br>
                            "<?php echo $resultado['entrada_original']; ?>"
                        </div>
                        <div class="result-item">
                            <strong>🔍 Separador detectado:</strong> "<?php echo $resultado['separador_usado']; ?>"
                        </div>
                        <div class="result-item">
                            <strong>🔢 Números extraídos:</strong><br>
                            <?php
                            $numeros_validos = array_filter($resultado['numeros_procesados'], function($n) { return $n != 0; });
                            echo implode(' + ', $numeros_validos);
                            ?>
                        </div>
                        <div class="result-item">
                            <strong>➕ Suma total:</strong> <?php echo formatearNumero($resultado['suma_total']); ?>
                        </div>
                        <div class="result-item">
                            <strong>🔢 Cantidad de números:</strong> <?php echo $resultado['cantidad_total']; ?>
                        </div>
                        <div class="result-item" style="background: rgba(255,255,255,0.2); font-size: 1.3em;">
                            <strong>🎯 PROMEDIO:</strong> <?php echo formatearNumero($resultado['promedio']); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="format-examples">
                    <h4>📋 Formatos Admitidos (máximo 10 números):</h4>
                    <div class="example-item">Separados por espacios: <strong>10 20 30 40 50</strong></div>
                    <div class="example-item">Separados por comas: <strong>10,20,30,40,50</strong></div>
                    <div class="example-item">Con espacios y comas: <strong>10, 20, 30, 40, 50</strong></div>
                    <div class="example-item">Decimales: <strong>10.5 20.3 30.7</strong></div>
                </div>

                <form method="POST" action="">
                    <input type="hidden" name="estrategia" value="formato">

                    <div class="form-group">
                        <label for="entrada_texto">📝 Ingrese los números en el formato que prefiera:</label>
                        <textarea id="entrada_texto" name="entrada_texto" rows="4"
                                placeholder="Ejemplo: 10 20 30 40 50  o  10,20,30,40,50"><?php echo obtenerValor('entrada_texto'); ?></textarea>
                    </div>

                    <button type="submit" class="btn">🧮 Procesar y Calcular Promedio</button>
                </form>
            </div>

            <!-- ESTRATEGIA 3: HÍBRIDA -->
            <div id="hibrida" class="strategy-section">
                <h2 class="strategy-title">🔀 Estrategia Híbrida</h2>
                <p style="text-align: center; margin-bottom: 20px; color: #666;">
                    Combina ambas estrategias: puede usar campos individuales O formato de texto
                </p>

                <?php if ($estrategia === 'hibrida' && $resultado): ?>
                <div class="result-container">
                    <h3 class="result-title">✅ Resultado Híbrido</h3>
                    <div class="result-details">
                        <div class="result-item">
                            <strong>📋 Números de campos individuales:</strong><br>
                            <?php
                            $campos_validos = array_filter($resultado['numeros_campos'], function($n) { return $n != 0; });
                            echo !empty($campos_validos) ? implode(' + ', $campos_validos) : 'Ninguno';
                            ?>
                        </div>
                        <div class="result-item">
                            <strong>📝 Números del texto:</strong><br>
                            <?php
                            $texto_validos = array_filter($resultado['numeros_texto'], function($n) { return $n != 0; });
                            echo !empty($texto_validos) ? implode(' + ', $texto_validos) : 'Ninguno';
                            ?>
                        </div>
                        <div class="result-item">
                            <strong>➕ Suma total:</strong> <?php echo formatearNumero($resultado['suma_total']); ?>
                        </div>
                        <div class="result-item">
                            <strong>🔢 Cantidad total de números:</strong> <?php echo $resultado['cantidad_total']; ?>
                        </div>
                        <div class="result-item" style="background: rgba(255,255,255,0.2); font-size: 1.3em;">
                            <strong>🎯 PROMEDIO HÍBRIDO:</strong> <?php echo formatearNumero($resultado['promedio']); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="hidden" name="estrategia" value="hibrida">
                        <div>
                            <h4>Opción 1: Campos Individuales</h4>
                            <div class="input-grid">
                                <input type="number" name="h_num1" step="any" placeholder="Número 1">
                                <input type="number" name="h_num2" step="any" placeholder="Número 2">
                                <input type="number" name="h_num3" step="any" placeholder="Número 3">
                            </div>
                        </div>
                        <div>
                            <h4>Opción 2: Formato de Texto</h4>
                            <textarea name="h_entrada_texto" rows="3"
                                    placeholder="Ej: 10 20 30 o 10,20,30"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-secondary">🔀 Procesar con Estrategia Híbrida</button>
                </form>
            </div>

        </div>
    </div>

    <script>
        // JAVASCRIPT SECUENCIAL (SIN CICLOS NI CONDICIONALES)

        function cambiarEstrategia(estrategia) {
            // Ocultar todas las secciones secuencialmente
            document.getElementById('acumulativa').classList.remove('active');
            document.getElementById('formato').classList.remove('active');
            document.getElementById('hibrida').classList.remove('active');

            // Desactivar todos los botones secuencialmente
            document.querySelectorAll('.tab-button').forEach(function(btn) {
                btn.classList.remove('active');
            });

            // Mostrar la sección seleccionada
            document.getElementById(estrategia).classList.add('active');

            // Activar el botón correspondiente
            event.target.classList.add('active');
        }

        function reiniciarAcumulador() {
            // Crear formulario para reiniciar (secuencial)
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '';

            // Agregar campo estrategia
            const estrategiaInput = document.createElement('input');
            estrategiaInput.type = 'hidden';
            estrategiaInput.name = 'estrategia';
            estrategiaInput.value = 'acumulativa';
            form.appendChild(estrategiaInput);

            // Agregar al DOM y enviar
            document.body.appendChild(form);
            form.submit();
        }

        // Inicialización secuencial
        function inicializar() {
            console.log('🚀 Algoritmo Secuencial Avanzado cargado');
            console.log('📊 Estrategias disponibles: Acumulativa, Formato, Híbrida');
        }

        // Ejecutar al cargar
        window.onload = inicializar;
    </script>
</body>
</html>