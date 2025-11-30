#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Repetir (Do-While)
Ejercicio 2: Sumar números pares del 1 al 20 usando repetir
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def main():
    print("=================================")
    print(" EJERCICIO 2: Suma Pares (Repetir)")
    print("=================================\n")

    print("Suma de números pares del 1 al 20 usando estructura REPETIR:")
    print("-" * 57)

    suma_pares = 0
    numeros_pares = []
    i = 1

    # Simulación del ciclo REPETIR (do-while)
    while True:
        # Cuerpo del ciclo - verificar si es par y procesar
        if i % 2 == 0:  # Si es par
            numeros_pares.append(i)
            suma_pares += i
            print(f"Par encontrado: {i:2d}, Suma acumulada: {suma_pares:3d}")

        # Condición de salida (evaluar al final)
        if i >= 20:
            break

        i += 1  # Incrementar para siguiente iteración

    # Mostrar resultados
    print(f"\n📊 RESULTADOS FINALES:")
    print("-" * 21)
    print(f"✅ Números pares encontrados: {len(numeros_pares)}")
    print(f"🔢 Lista de pares: {numeros_pares}")
    print(f"➕ Suma total de pares: {suma_pares}")

    if numeros_pares:
        promedio = suma_pares / len(numeros_pares)
        print(f"📐 Promedio de pares: {promedio:.1f}")
        print(f"📈 Mayor número par: {max(numeros_pares)}")
        print(f"📉 Menor número par: {min(numeros_pares)}")

    # Verificación matemática
    # Suma de pares 2+4+6+...+20 = 2(1+2+3+...+10) = 2×55 = 110
    n_pares = len(numeros_pares)  # Debería ser 10
    suma_teorica = n_pares * (n_pares + 1)  # 10 × 11 = 110

    print(f"\n🧮 VERIFICACIÓN MATEMÁTICA:")
    print("-" * 25)
    print(f"• Pares del 1 al 20: {n_pares} números")
    print(f"• Suma teórica: n×(n+1) = {n_pares}×{n_pares+1} = {suma_teorica}")
    print(f"• Suma calculada: {suma_pares}")
    print(f"• ✅ Verificación: {'Correcta' if suma_pares == suma_teorica else 'Error'}")

    # Proceso detallado del ciclo REPETIR
    print(f"\n⚙️  PROCESO DETALLADO (REPETIR):")
    print("-" * 32)
    print("Iter | i  | ¿Par? | Acción      | Suma | ¿i >= 20? | Continuar")
    print("-" * 62)

    # Simular el proceso para documentar
    i_demo = 1
    suma_demo = 0
    iteracion = 1

    while True:
        es_par = "Sí" if i_demo % 2 == 0 else "No"

        if i_demo % 2 == 0:
            suma_demo += i_demo
            accion = f"Sumar {i_demo}"
        else:
            accion = "Ignorar"

        condicion = "Sí" if i_demo >= 20 else "No"
        continuar = "No (break)" if i_demo >= 20 else "Sí"

        print(f" {iteracion:2d}  | {i_demo:2d} |  {es_par:2s}   | {accion:10s} | {suma_demo:3d}  |    {condicion:2s}     | {continuar}")

        if i_demo >= 20:
            break
        i_demo += 1
        iteracion += 1

    # Análisis del algoritmo REPETIR
    print(f"\n🔍 ANÁLISIS DEL ALGORITMO REPETIR:")
    print("-" * 35)
    print(f"• Inicialización: i = 1, suma = 0")
    print(f"• Cuerpo del ciclo:")
    print(f"  1. Verificar si i es par")
    print(f"  2. Si es par: agregarlo a la lista y sumarlo")
    print(f"  3. Incrementar i")
    print(f"• Condición de salida: i >= 20 (al final)")
    print(f"• Garantía: Al menos una iteración")
    print(f"• Total de iteraciones: 20")
    print(f"• Iteraciones útiles (pares): {len(numeros_pares)}")

    # Comparación con otros enfoques
    print(f"\n📊 COMPARACIÓN CON OTROS ENFOQUES:")
    print("-" * 35)

    # Enfoque 1: FOR con rango completo
    suma_for_completo = sum(i for i in range(1, 21) if i % 2 == 0)
    pares_for_completo = [i for i in range(1, 21) if i % 2 == 0]

    # Enfoque 2: FOR con rango optimizado (solo pares)
    suma_for_optimizado = sum(range(2, 21, 2))
    pares_for_optimizado = list(range(2, 21, 2))

    # Enfoque 3: MIENTRAS
    suma_mientras = 0
    pares_mientras = []
    j = 1
    while j <= 20:
        if j % 2 == 0:
            pares_mientras.append(j)
            suma_mientras += j
        j += 1

    print(f"• REPETIR (actual):       Suma: {suma_pares}, Iteraciones: 20")
    print(f"• FOR completo:           Suma: {suma_for_completo}, Iteraciones: 20")
    print(f"• FOR optimizado:         Suma: {suma_for_optimizado}, Iteraciones: 10")
    print(f"• MIENTRAS:               Suma: {suma_mientras}, Iteraciones: 20")

    # Verificar que todos den el mismo resultado
    todas_sumas = [suma_pares, suma_for_completo, suma_for_optimizado, suma_mientras]
    todos_pares = [numeros_pares, pares_for_completo, pares_for_optimizado, pares_mientras]

    print(f"• Todas las sumas coinciden: {'✅ Sí' if len(set(todas_sumas)) == 1 else '❌ No'}")
    print(f"• Todas las listas coinciden: {'✅ Sí' if all(p == numeros_pares for p in todos_pares) else '❌ No'}")

    # Eficiencia comparada
    print(f"\n📈 ANÁLISIS DE EFICIENCIA:")
    print("-" * 26)
    eficiencia_repetir = (len(numeros_pares) / 20) * 100
    eficiencia_for_opt = (len(pares_for_optimizado) / 10) * 100

    print(f"• REPETIR:        {eficiencia_repetir:.1f}% eficiencia (10 útiles de 20 iteraciones)")
    print(f"• FOR optimizado: {eficiencia_for_opt:.1f}% eficiencia (10 útiles de 10 iteraciones)")
    print(f"• Mejor enfoque:  FOR optimizado para este caso específico")
    print(f"• REPETIR útil:   Cuando no se conoce el patrón de antemano")

    # Propiedades matemáticas
    print(f"\n📊 PROPIEDADES MATEMÁTICAS:")
    print("-" * 28)
    print(f"• Secuencia de pares: 2, 4, 6, 8, 10, 12, 14, 16, 18, 20")
    print(f"• Fórmula general: 2n donde n = 1,2,3,...,10")
    print(f"• Diferencia común: +2")
    print(f"• Suma de progresión aritmética: S = n/2 × (primer + último)")
    print(f"  S = 10/2 × (2 + 20) = 5 × 22 = 110 ✅")

    # Casos donde REPETIR es más útil
    print(f"\n💡 CUÁNDO USAR REPETIR:")
    print("-" * 24)
    print(f"✅ Validación de entrada:")
    print(f"   REPETIR")
    print(f"       solicitar_numero()")
    print(f"   HASTA numero_valido")

    print(f"✅ Menús interactivos:")
    print(f"   REPETIR")
    print(f"       mostrar_menu()")
    print(f"       procesar_opcion()")
    print(f"   HASTA opcion = 'salir'")

    print(f"✅ Procesamiento de lotes:")
    print(f"   REPETIR")
    print(f"       procesar_lote()")
    print(f"   HASTA no_hay_mas_datos")

    # Variantes del algoritmo
    print(f"\n🔧 VARIANTES DEL ALGORITMO:")
    print("-" * 28)

    # Variante 1: Solo procesar pares (más eficiente)
    print(f"Variante 1 - Solo procesar pares:")
    print(f"i = 2")
    print(f"REPETIR")
    print(f"    sumar i")
    print(f"    i = i + 2")
    print(f"HASTA i > 20")

    # Implementar variante 1
    suma_variante1 = 0
    pares_variante1 = []
    k = 2
    while True:
        pares_variante1.append(k)
        suma_variante1 += k
        if k >= 20:
            break
        k += 2

    print(f"Resultado variante 1: {pares_variante1}, Suma: {suma_variante1}")

    # Estructura del REPETIR en pseudocódigo
    print(f"\n📝 PSEUDOCÓDIGO EQUIVALENTE:")
    print("-" * 29)
    print(f"INICIO")
    print(f"    i ← 1")
    print(f"    suma ← 0")
    print(f"    REPETIR")
    print(f"        SI i MOD 2 = 0 ENTONCES")
    print(f"            suma ← suma + i")
    print(f"        FIN SI")
    print(f"        i ← i + 1")
    print(f"    HASTA i > 20")
    print(f"    ESCRIBIR suma")
    print(f"FIN")

    print(f"\n✅ Ejercicio de suma con REPETIR completado")
    print("=" * 45)

if __name__ == "__main__":
    main()