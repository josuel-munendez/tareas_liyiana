#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Funciones Matemáticas
Ejercicio 3: Implementar función sin() para calcular seno
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

import math

def mi_sin(x, terminos=10):
    """
    Implementación propia de sin() usando serie de Taylor
    sin(x) = x - x³/3! + x⁵/5! - x⁷/7! + ...
    Args:
        x: Ángulo en radianes
        terminos: Número de términos en la serie de Taylor
    Returns:
        Seno del ángulo
    """
    # Normalizar el ángulo al rango [-2π, 2π]
    while x > 2 * math.pi:
        x -= 2 * math.pi
    while x < -2 * math.pi:
        x += 2 * math.pi

    resultado = 0
    for n in range(terminos):
        # Calcular factorial de (2n + 1)
        factorial = 1
        for i in range(1, 2*n + 2):
            factorial *= i

        # Calcular término de la serie
        termino = ((-1)**n) * (x**(2*n + 1)) / factorial
        resultado += termino

    return resultado

def factorial(n):
    """Función auxiliar para calcular factorial"""
    if n <= 1:
        return 1
    resultado = 1
    for i in range(2, n + 1):
        resultado *= i
    return resultado

def mi_sin_optimizado(x, terminos=15):
    """
    Implementación optimizada de sin() usando serie de Taylor
    """
    # Normalizar el ángulo
    x = x % (2 * math.pi)
    if x > math.pi:
        x -= 2 * math.pi

    resultado = 0
    x_potencia = x  # x^1
    signo = 1

    for n in range(terminos):
        # Añadir término actual
        resultado += signo * x_potencia / factorial(2*n + 1)

        # Preparar siguiente término
        x_potencia *= x * x  # x^(2n+3) = x^(2n+1) * x^2
        signo *= -1

    return resultado

def grados_a_radianes(grados):
    """Convierte grados a radianes"""
    return grados * math.pi / 180

def radianes_a_grados(radianes):
    """Convierte radianes a grados"""
    return radianes * 180 / math.pi

def main():
    print("=================================")
    print("      CALCULADORA DE SENO")
    print("=================================\n")

    try:
        print("Seleccione la unidad del ángulo:")
        print("1. Grados")
        print("2. Radianes")

        unidad = int(input("Ingrese su opción (1 o 2): "))

        if unidad == 1:
            angulo_grados = float(input("Ingrese el ángulo en grados: "))
            angulo_radianes = grados_a_radianes(angulo_grados)
            print(f"Ángulo convertido: {angulo_radianes:.6f} radianes")
        elif unidad == 2:
            angulo_radianes = float(input("Ingrese el ángulo en radianes: "))
            angulo_grados = radianes_a_grados(angulo_radianes)
            print(f"Ángulo convertido: {angulo_grados:.6f} grados")
        else:
            print("Error: Opción no válida.")
            return

        # Calcular seno con nuestras implementaciones
        mi_resultado = mi_sin(angulo_radianes)
        mi_resultado_opt = mi_sin_optimizado(angulo_radianes)

        # Calcular con función nativa
        resultado_nativo = math.sin(angulo_radianes)

        # Mostrar resultados
        print("\n" + "="*70)
        print("RESULTADO DEL CÁLCULO")
        print("="*70)
        if unidad == 1:
            print(f"Ángulo: {angulo_grados}° = {angulo_radianes:.6f} rad")
        else:
            print(f"Ángulo: {angulo_radianes} rad = {angulo_grados:.6f}°")

        print(f"sen(x) - Serie Taylor básica:    {mi_resultado:.10f}")
        print(f"sen(x) - Serie Taylor optimizada: {mi_resultado_opt:.10f}")
        print(f"sen(x) - Python nativo:          {resultado_nativo:.10f}")

        # Calcular errores
        error1 = abs(mi_resultado - resultado_nativo)
        error2 = abs(mi_resultado_opt - resultado_nativo)

        print(f"\nErrores absolutos:")
        print(f"Serie básica:     {error1:.2e}")
        print(f"Serie optimizada: {error2:.2e}")

        # Mostrar algunos ángulos conocidos
        print(f"\n📚 Valores de seno para ángulos conocidos:")
        angulos_conocidos = [0, 30, 45, 60, 90, 180, 270, 360]

        for angulo in angulos_conocidos:
            rad = grados_a_radianes(angulo)
            mi_sen = mi_sin_optimizado(rad)
            nativo_sen = math.sin(rad)
            print(f"sen({angulo:3d}°) = {mi_sen:8.6f} (nativo: {nativo_sen:8.6f})")

        # Información sobre la serie de Taylor
        print(f"\n🔍 Información sobre la serie de Taylor:")
        print(f"sen(x) = x - x³/3! + x⁵/5! - x⁷/7! + x⁹/9! - ...")
        print(f"Términos usados en el cálculo: 15")

        # Mostrar algunos términos de la serie para el ángulo dado
        if abs(angulo_radianes) < 2:  # Solo para ángulos pequeños
            print(f"\nPrimeros términos de la serie para x = {angulo_radianes:.4f}:")
            x = angulo_radianes
            termino1 = x
            termino2 = -x**3 / factorial(3)
            termino3 = x**5 / factorial(5)
            termino4 = -x**7 / factorial(7)

            print(f"Término 1: x = {termino1:.8f}")
            print(f"Término 2: -x³/3! = {termino2:.8f}")
            print(f"Término 3: x⁵/5! = {termino3:.8f}")
            print(f"Término 4: -x⁷/7! = {termino4:.8f}")
            suma_parcial = termino1 + termino2 + termino3 + termino4
            print(f"Suma de 4 términos: {suma_parcial:.8f}")

    except ValueError:
        print("Error: Por favor ingrese valores numéricos válidos.")
    except Exception as e:
        print(f"Error inesperado: {e}")

if __name__ == "__main__":
    main()