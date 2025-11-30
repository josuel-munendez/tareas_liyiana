#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Mientras
Ejercicio 2: Sumar números positivos hasta que se ingrese un 0
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def main():
    print("=================================")
    print(" EJERCICIO 2: Suma de Positivos")
    print("=================================\n")

    print("Ingrese números positivos (se detiene con 0):")
    print("Los números negativos serán ignorados")
    print("-" * 45)

    suma_total = 0
    contador_positivos = 0
    contador_negativos = 0
    contador_total = 0
    numeros_positivos = []

    try:
        # Ciclo mientras para leer y sumar números positivos
        while True:
            try:
                numero = float(input(f"Número {contador_total + 1}: "))
                contador_total += 1

                # Verificar si es 0 para detener
                if numero == 0:
                    print(f"\n🛑 Cero detectado. Deteniendo suma...")
                    break

                # Procesar según el signo del número
                if numero > 0:
                    # Número positivo: sumarlo
                    numeros_positivos.append(numero)
                    suma_total += numero
                    contador_positivos += 1
                    print(f"   ✅ +{numero} sumado. Suma actual: {suma_total:.2f}")
                else:
                    # Número negativo: ignorarlo
                    contador_negativos += 1
                    print(f"   ⚠️  {numero} ignorado (negativo). Suma actual: {suma_total:.2f}")

            except ValueError:
                print("   ❌ Error: Por favor ingrese un número válido.")
                contador_total -= 1  # No contar entradas inválidas
                continue

    except KeyboardInterrupt:
        print(f"\n\n⏹️  Proceso interrumpido por el usuario.")

    # Mostrar resultados
    print("\n" + "="*60)
    print("REPORTE FINAL DE SUMA")
    print("="*60)

    print(f"\n📊 ESTADÍSTICAS GENERALES:")
    print("-" * 25)
    print(f"• Total de números ingresados: {contador_total}")
    print(f"• Números positivos procesados: {contador_positivos}")
    print(f"• Números negativos ignorados: {contador_negativos}")
    print(f"• Suma total de positivos: {suma_total:.2f}")

    if contador_positivos > 0:
        promedio = suma_total / contador_positivos
        print(f"• Promedio de positivos: {promedio:.2f}")
        print(f"• Mayor número positivo: {max(numeros_positivos):.2f}")
        print(f"• Menor número positivo: {min(numeros_positivos):.2f}")
    else:
        print("• No se ingresaron números positivos")

    # Detalles de números positivos
    if numeros_positivos:
        print(f"\n📝 NÚMEROS POSITIVOS PROCESADOS:")
        print("-" * 33)
        if len(numeros_positivos) <= 15:  # Mostrar todos si son pocos
            print(f"Lista completa: {numeros_positivos}")
        else:  # Mostrar solo algunos si son muchos
            print(f"Primeros 10: {numeros_positivos[:10]}")
            print(f"Últimos 5: {numeros_positivos[-5:]}")
            print(f"... (y {len(numeros_positivos) - 15} números más)")

    # Análisis de la distribución
    if contador_positivos > 0:
        print(f"\n🔍 ANÁLISIS DE DISTRIBUCIÓN:")
        print("-" * 28)

        # Clasificar números
        enteros = [n for n in numeros_positivos if n == int(n)]
        decimales = [n for n in numeros_positivos if n != int(n)]

        print(f"• Números enteros: {len(enteros)} ({len(enteros)/contador_positivos*100:.1f}%)")
        print(f"• Números decimales: {len(decimales)} ({len(decimales)/contador_positivos*100:.1f}%)")

        # Rangos de valores
        if contador_positivos > 1:
            # Clasificar por magnitud
            pequeños = [n for n in numeros_positivos if 0 < n < 1]
            unitarios = [n for n in numeros_positivos if 1 <= n < 10]
            decenas = [n for n in numeros_positivos if 10 <= n < 100]
            centenas = [n for n in numeros_positivos if n >= 100]

            print(f"• Entre 0 y 1: {len(pequeños)} números")
            print(f"• Entre 1 y 10: {len(unitarios)} números")
            print(f"• Entre 10 y 100: {len(decenas)} números")
            print(f"• 100 o más: {len(centenas)} números")

    # Estadísticas avanzadas
    if contador_positivos >= 2:
        promedio = suma_total / contador_positivos
        varianza = sum((x - promedio) ** 2 for x in numeros_positivos) / contador_positivos
        desviacion = varianza ** 0.5

        # Mediana
        numeros_ordenados = sorted(numeros_positivos)
        n = len(numeros_ordenados)
        if n % 2 == 0:
            mediana = (numeros_ordenados[n//2 - 1] + numeros_ordenados[n//2]) / 2
        else:
            mediana = numeros_ordenados[n//2]

        print(f"\n📈 ESTADÍSTICAS AVANZADAS:")
        print("-" * 27)
        print(f"• Mediana: {mediana:.2f}")
        print(f"• Desviación estándar: {desviacion:.2f}")
        print(f"• Coeficiente de variación: {(desviacion/promedio)*100:.1f}%")

        # Cuartiles
        q1_pos = n * 0.25
        q3_pos = n * 0.75
        q1 = numeros_ordenados[int(q1_pos)]
        q3 = numeros_ordenados[int(q3_pos)]
        print(f"• Primer cuartil (Q1): {q1:.2f}")
        print(f"• Tercer cuartil (Q3): {q3:.2f}")
        print(f"• Rango intercuartil: {q3 - q1:.2f}")

    # Proceso de suma paso a paso (si no son demasiados)
    if contador_positivos <= 8:
        print(f"\n⚙️  PROCESO DE SUMA PASO A PASO:")
        print("-" * 32)
        suma_acumulada = 0
        for i, numero in enumerate(numeros_positivos, 1):
            suma_acumulada += numero
            print(f"Paso {i:2d}: {suma_acumulada - numero:8.2f} + {numero:8.2f} = {suma_acumulada:8.2f}")

    # Análisis de eficiencia
    if contador_total > 0:
        eficiencia = (contador_positivos / contador_total) * 100
        print(f"\n📊 ANÁLISIS DE EFICIENCIA:")
        print("-" * 26)
        print(f"• Eficiencia del proceso: {eficiencia:.1f}%")
        print(f"  ({contador_positivos} útiles de {contador_total} ingresados)")

        if contador_negativos > 0:
            print(f"• Números desperdiciados: {contador_negativos} ({contador_negativos/contador_total*100:.1f}%)")

        if eficiencia >= 80:
            print("✅ Muy buena eficiencia en la entrada de datos")
        elif eficiencia >= 60:
            print("✅ Buena eficiencia en la entrada de datos")
        else:
            print("⚠️  Baja eficiencia - muchos números negativos ingresados")

    # Verificación matemática
    if numeros_positivos:
        suma_verificacion = sum(numeros_positivos)
        print(f"\n🔍 VERIFICACIÓN MATEMÁTICA:")
        print("-" * 28)
        print(f"• Suma calculada: {suma_total:.2f}")
        print(f"• Suma verificación: {suma_verificacion:.2f}")
        if abs(suma_total - suma_verificacion) < 0.001:
            print("✅ Verificación correcta")
        else:
            print("❌ Error en la verificación")

    # Información del algoritmo
    print(f"\n🔍 INFORMACIÓN DEL ALGORITMO:")
    print("-" * 31)
    print(f"• Estructura: Ciclo MIENTRAS (while)")
    print(f"• Condición de parada: número == 0")
    print(f"• Procesamiento: Solo suma números > 0")
    print(f"• Comportamiento: Ignora negativos, para en 0")

    print(f"\n✅ Proceso de suma completado")
    print("=" * 35)

if __name__ == "__main__":
    main()