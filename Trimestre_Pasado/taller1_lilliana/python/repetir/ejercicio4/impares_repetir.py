#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Repetir (Do-While)
Ejercicio 4: Números impares del 1 al 50 usando repetir
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def main():
    print("=================================")
    print(" EJERCICIO 4: Impares 1-50 (Repetir)")
    print("=================================\n")

    print("Números impares del 1 al 50 usando estructura REPETIR:")
    print("-" * 55)

    numeros_impares = []
    suma_impares = 0
    contador = 0
    i = 1

    # Simulación del ciclo REPETIR (do-while)
    while True:
        # Cuerpo del ciclo - verificar si es impar
        if i % 2 != 0:  # Si es impar
            numeros_impares.append(i)
            suma_impares += i
            contador += 1
            print(f"{i:2d}", end="  ")

            # Salto de línea cada 10 números
            if contador % 10 == 0:
                print()

        # Condición de salida (evaluar al final)
        if i >= 50:
            break

        i += 1

    # Salto de línea si no terminó en múltiplo de 10
    if contador % 10 != 0:
        print()

    # Estadísticas generales
    print(f"\n📊 ESTADÍSTICAS GENERALES:")
    print("-" * 25)
    print(f"✅ Total de impares encontrados: {contador}")
    print(f"🔢 Rango analizado: 1 - 50")
    print(f"📐 Números por línea: 10")
    print(f"📏 Total de líneas: {(contador + 9) // 10}")
    print(f"➕ Suma de todos los impares: {suma_impares}")

    # Cálculos matemáticos
    if numeros_impares:
        promedio = suma_impares / contador
        print(f"📐 Promedio: {promedio:.1f}")
        print(f"📈 Mayor impar: {max(numeros_impares)}")
        print(f"📉 Menor impar: {min(numeros_impares)}")
        print(f"📏 Rango (max-min): {max(numeros_impares) - min(numeros_impares)}")

    # Verificación matemática
    # Suma de primeros n números impares = n²
    # Los impares del 1 al 50 son 25 números: 1,3,5,...,49
    # Suma = 25² = 625
    n_impares = contador
    suma_teorica = n_impares * n_impares

    print(f"\n🧮 VERIFICACIÓN MATEMÁTICA:")
    print("-" * 25)
    print(f"• Cantidad de impares (n): {n_impares}")
    print(f"• Suma teórica (n²): {n_impares}² = {suma_teorica}")
    print(f"• Suma calculada: {suma_impares}")
    print(f"• ✅ Verificación: {'Correcta' if suma_impares == suma_teorica else 'Error'}")

    # Proceso detallado del REPETIR (primeras 15 iteraciones)
    print(f"\n⚙️  PROCESO DETALLADO (primeras 15 iteraciones):")
    print("-" * 52)
    print("Iter | i  | ¿Impar? | Acción | Cont | ¿i >= 50? | Continuar")
    print("-" * 58)

    # Simular proceso para documentar
    i_demo = 1
    cont_demo = 0
    iteracion = 1

    while iteracion <= 15:
        es_impar = "Sí" if i_demo % 2 != 0 else "No"

        if i_demo % 2 != 0:
            cont_demo += 1
            accion = "Agregar"
        else:
            accion = "Ignorar"

        condicion = "Sí" if i_demo >= 50 else "No"
        continuar = "No (break)" if i_demo >= 50 else "Sí"

        print(f" {iteracion:2d}  | {i_demo:2d} |   {es_impar:2s}    | {accion:7s} | {cont_demo:4d} |    {condicion:2s}     | {continuar}")

        if i_demo >= 50:
            break
        i_demo += 1
        iteracion += 1

    # Análisis de eficiencia del REPETIR
    print(f"\n📈 ANÁLISIS DE EFICIENCIA:")
    print("-" * 26)
    eficiencia = (contador / 50) * 100
    print(f"• Total de iteraciones: 50")
    print(f"• Iteraciones útiles (impares): {contador}")
    print(f"• Iteraciones desperdiciadas (pares): {50 - contador}")
    print(f"• Eficiencia: {eficiencia:.1f}%")
    print(f"• Patrón: Alternancia 50/50 entre útiles y desperdiciadas")

    # Análisis de patrones
    print(f"\n📈 ANÁLISIS DE PATRONES:")
    print("-" * 25)
    print(f"• Secuencia: 1, 3, 5, 7, 9, 11, ..., 47, 49")
    print(f"• Diferencia común: +2")
    print(f"• Fórmula general: 2n-1 donde n = 1,2,3,...,25")
    print(f"• Todos terminan en: 1, 3, 5, 7, 9")
    print(f"• Primer impar: {numeros_impares[0]}")
    print(f"• Último impar: {numeros_impares[-1]}")

    # Verificación de fórmula 2n-1
    print(f"\n🧮 VERIFICACIÓN FÓRMULA (2n-1):")
    print("-" * 32)
    print("n  | 2n-1 | Real | ✓")
    print("-" * 20)
    for n in range(1, 6):  # Primeros 5
        formula = 2 * n - 1
        real = numeros_impares[n-1]
        check = "✅" if formula == real else "❌"
        print(f"{n:1d}  | {formula:4d} | {real:4d} | {check}")

    # Comparación con otros métodos
    print(f"\n📊 COMPARACIÓN CON OTROS MÉTODOS:")
    print("-" * 34)

    # Método 1: FOR con filtro
    impares_for_filtro = [j for j in range(1, 51) if j % 2 != 0]

    # Método 2: FOR optimizado (solo impares)
    impares_for_opt = list(range(1, 51, 2))

    # Método 3: MIENTRAS
    impares_mientras = []
    k = 1
    while k <= 50:
        if k % 2 != 0:
            impares_mientras.append(k)
        k += 1

    # Método 4: REPETIR optimizado (solo impares)
    impares_repetir_opt = []
    m = 1
    while True:
        impares_repetir_opt.append(m)
        if m >= 49:  # Último impar
            break
        m += 2

    print(f"• REPETIR actual:     {len(numeros_impares)} impares, 50 iteraciones")
    print(f"• FOR con filtro:     {len(impares_for_filtro)} impares, 50 iteraciones")
    print(f"• FOR optimizado:     {len(impares_for_opt)} impares, 25 iteraciones")
    print(f"• MIENTRAS:           {len(impares_mientras)} impares, 50 iteraciones")
    print(f"• REPETIR optimizado: {len(impares_repetir_opt)} impares, 25 iteraciones")

    # Verificar coincidencias
    todos_iguales = (numeros_impares == impares_for_filtro ==
                     impares_for_opt == impares_mientras == impares_repetir_opt)
    print(f"• Todos coinciden: {'✅ Sí' if todos_iguales else '❌ No'}")

    # Distribución por décadas
    print(f"\n📊 DISTRIBUCIÓN POR DÉCADAS:")
    print("-" * 29)
    for decada in range(5):  # 5 décadas: 1-10, 11-20, 21-30, 31-40, 41-50
        inicio = decada * 10 + 1
        fin = (decada + 1) * 10
        impares_en_decada = [x for x in numeros_impares if inicio <= x <= fin]
        print(f"Década {inicio:2d}-{fin:2d}: {len(impares_en_decada)} impares → {impares_en_decada}")

    # Propiedades matemáticas
    print(f"\n🎯 PROPIEDADES MATEMÁTICAS:")
    print("-" * 28)
    print(f"• Suma de impares = cuadrado perfecto: {suma_impares} = {int(suma_impares**0.5)}²")
    print(f"• Número central: {numeros_impares[len(numeros_impares)//2]} (posición {len(numeros_impares)//2 + 1})")
    print(f"• Suma de extremos: {numeros_impares[0]} + {numeros_impares[-1]} = {numeros_impares[0] + numeros_impares[-1]}")
    print(f"• Producto de extremos: {numeros_impares[0]} × {numeros_impares[-1]} = {numeros_impares[0] * numeros_impares[-1]}")

    # Análisis estadístico
    if len(numeros_impares) > 2:
        # Calcular mediana
        n = len(numeros_impares)
        if n % 2 == 0:
            mediana = (numeros_impares[n//2 - 1] + numeros_impares[n//2]) / 2
        else:
            mediana = numeros_impares[n//2]

        # Calcular desviación estándar
        promedio = suma_impares / len(numeros_impares)
        varianza = sum((x - promedio) ** 2 for x in numeros_impares) / len(numeros_impares)
        desviacion = varianza ** 0.5

        print(f"\n📈 ANÁLISIS ESTADÍSTICO:")
        print("-" * 25)
        print(f"• Media: {promedio:.2f}")
        print(f"• Mediana: {mediana:.2f}")
        print(f"• Desviación estándar: {desviacion:.2f}")
        print(f"• Coeficiente de variación: {(desviacion/promedio)*100:.2f}%")

    # Ventajas del REPETIR para este problema
    print(f"\n⚖️  ANÁLISIS DEL REPETIR:")
    print("-" * 24)
    print(f"✅ VENTAJAS:")
    print(f"   • Garantiza procesar al menos el número 1")
    print(f"   • Lógica natural: procesar hasta llegar al límite")
    print(f"   • Fácil de entender y modificar")

    print(f"❌ DESVENTAJAS:")
    print(f"   • Menos eficiente que métodos optimizados")
    print(f"   • Procesa números pares innecesariamente")
    print(f"   • Más iteraciones que enfoques directos")

    # Pseudocódigo del algoritmo
    print(f"\n📝 PSEUDOCÓDIGO:")
    print("-" * 15)
    print(f"INICIO")
    print(f"    i ← 1")
    print(f"    REPETIR")
    print(f"        SI i MOD 2 ≠ 0 ENTONCES")
    print(f"            mostrar i")
    print(f"            agregar i a lista")
    print(f"        FIN SI")
    print(f"        i ← i + 1")
    print(f"    HASTA i > 50")
    print(f"FIN")

    # Casos de uso similares
    print(f"\n💡 CASOS DE USO SIMILARES:")
    print("-" * 27)
    print(f"• Filtrar datos de un rango completo")
    print(f"• Procesar archivos línea por línea")
    print(f"• Validar entrada hasta encontrar valor correcto")
    print(f"• Buscar patrones en secuencias")
    print(f"• Generar muestras con criterios específicos")

    # Optimización sugerida
    print(f"\n🚀 OPTIMIZACIÓN SUGERIDA:")
    print("-" * 26)
    print(f"Para mejor eficiencia:")
    print(f"i ← 1")
    print(f"REPETIR")
    print(f"    mostrar i")
    print(f"    i ← i + 2")
    print(f"HASTA i > 49")
    print(f"(Solo {len(impares_repetir_opt)} iteraciones en lugar de 50)")

    print(f"\n✅ Análisis de impares con REPETIR completado")
    print("=" * 46)

if __name__ == "__main__":
    main()