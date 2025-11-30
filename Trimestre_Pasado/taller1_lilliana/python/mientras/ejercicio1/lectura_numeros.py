#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Mientras
Ejercicio 1: Leer números hasta que se ingrese un valor negativo
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def main():
    print("=================================")
    print(" EJERCICIO 1: Lectura de Números")
    print("=================================\n")

    print("Ingrese números (se detiene con un número negativo):")
    print("Presione Ctrl+C para salir forzosamente")
    print("-" * 55)

    numeros = []
    contador = 0
    suma = 0

    try:
        # Ciclo mientras para leer números
        while True:
            try:
                numero = float(input(f"Número {contador + 1}: "))

                # Verificar si es negativo para detener
                if numero < 0:
                    print(f"\n🛑 Número negativo detectado ({numero}). Deteniendo lectura...")
                    break

                # Agregar número a la lista
                numeros.append(numero)
                contador += 1
                suma += numero

                print(f"   ✅ Número {numero} agregado. Total: {contador} números.")

            except ValueError:
                print("   ❌ Error: Por favor ingrese un número válido.")
                continue

    except KeyboardInterrupt:
        print(f"\n\n⏹️  Proceso interrumpido por el usuario.")

    # Mostrar resultados
    print("\n" + "="*60)
    print("REPORTE FINAL DE LECTURA")
    print("="*60)

    if contador == 0:
        print("❌ No se ingresaron números válidos.")
        return

    # Estadísticas básicas
    print(f"\n📊 ESTADÍSTICAS GENERALES:")
    print("-" * 25)
    print(f"• Total de números leídos: {contador}")
    print(f"• Suma de todos los números: {suma:.2f}")
    print(f"• Promedio: {suma / contador:.2f}")
    print(f"• Número mayor: {max(numeros):.2f}")
    print(f"• Número menor: {min(numeros):.2f}")
    print(f"• Rango: {max(numeros) - min(numeros):.2f}")

    # Lista de números
    print(f"\n📝 NÚMEROS INGRESADOS:")
    print("-" * 21)
    if contador <= 20:  # Mostrar todos si son pocos
        print(f"Lista completa: {numeros}")
    else:  # Mostrar solo algunos si son muchos
        print(f"Primeros 10: {numeros[:10]}")
        print(f"Últimos 10: {numeros[-10:]}")
        print(f"... (y {contador - 20} números más)")

    # Análisis de tipos de números
    enteros = [n for n in numeros if n == int(n)]
    decimales = [n for n in numeros if n != int(n)]
    positivos = [n for n in numeros if n > 0]
    ceros = [n for n in numeros if n == 0]

    print(f"\n🔍 ANÁLISIS DE TIPOS:")
    print("-" * 20)
    print(f"• Números enteros: {len(enteros)} ({len(enteros)/contador*100:.1f}%)")
    print(f"• Números decimales: {len(decimales)} ({len(decimales)/contador*100:.1f}%)")
    print(f"• Números positivos: {len(positivos)} ({len(positivos)/contador*100:.1f}%)")
    print(f"• Ceros: {len(ceros)} ({len(ceros)/contador*100:.1f}%)")

    # Estadísticas avanzadas si hay suficientes datos
    if contador >= 2:
        # Calcular mediana
        numeros_ordenados = sorted(numeros)
        n = len(numeros_ordenados)
        if n % 2 == 0:
            mediana = (numeros_ordenados[n//2 - 1] + numeros_ordenados[n//2]) / 2
        else:
            mediana = numeros_ordenados[n//2]

        # Calcular varianza y desviación estándar
        promedio = suma / contador
        varianza = sum((x - promedio) ** 2 for x in numeros) / contador
        desviacion = varianza ** 0.5

        print(f"\n📈 ESTADÍSTICAS AVANZADAS:")
        print("-" * 27)
        print(f"• Mediana: {mediana:.2f}")
        print(f"• Varianza: {varianza:.2f}")
        print(f"• Desviación estándar: {desviacion:.2f}")

        # Coeficiente de variación
        if promedio != 0:
            coef_variacion = (desviacion / promedio) * 100
            print(f"• Coeficiente de variación: {coef_variacion:.2f}%")

    # Proceso paso a paso (si no son demasiados)
    if contador <= 10:
        print(f"\n⚙️  PROCESO PASO A PASO:")
        print("-" * 22)
        suma_acumulada = 0
        for i, numero in enumerate(numeros, 1):
            suma_acumulada += numero
            promedio_parcial = suma_acumulada / i
            print(f"Paso {i:2d}: +{numero:8.2f} → Suma: {suma_acumulada:8.2f}, Promedio: {promedio_parcial:6.2f}")

    # Distribución por rangos
    if contador > 0:
        print(f"\n📊 DISTRIBUCIÓN POR RANGOS:")
        print("-" * 28)

        # Definir rangos automáticamente
        minimo = min(numeros)
        maximo = max(numeros)
        rango_total = maximo - minimo

        if rango_total > 0:
            num_rangos = min(5, contador)  # Máximo 5 rangos
            tamaño_rango = rango_total / num_rangos

            for i in range(num_rangos):
                inicio = minimo + i * tamaño_rango
                fin = inicio + tamaño_rango
                if i == num_rangos - 1:  # Último rango incluye el máximo
                    fin = maximo + 0.01

                en_rango = [n for n in numeros if inicio <= n < fin]
                porcentaje = len(en_rango) / contador * 100
                print(f"• [{inicio:6.2f} - {fin:6.2f}): {len(en_rango):2d} números ({porcentaje:5.1f}%)")

    # Información del algoritmo
    print(f"\n🔍 INFORMACIÓN DEL ALGORITMO:")
    print("-" * 31)
    print(f"• Estructura: Ciclo MIENTRAS (while)")
    print(f"• Condición de parada: número < 0")
    print(f"• Tipo de ciclo: Indefinido (no se sabe cuántos números)")
    print(f"• Validación: Manejo de errores de entrada")

    print(f"\n✅ Proceso de lectura completado")
    print("=" * 38)

if __name__ == "__main__":
    main()