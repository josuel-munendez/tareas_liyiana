#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Funciones Matemáticas
Ejercicio 4: Implementar función cos() para calcular coseno
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

import math

def factorial(n):
    """Función auxiliar para calcular factorial"""
    if n <= 1:
        return 1
    resultado = 1
    for i in range(2, n + 1):
        resultado *= i
    return resultado

def mi_cos(x, terminos=15):
    """
    Implementación propia de cos() usando serie de Taylor
    cos(x) = 1 - x²/2! + x⁴/4! - x⁶/6! + x⁸/8! - ...
    Args:
        x: Ángulo en radianes
        terminos: Número de términos en la serie de Taylor
    Returns:
        Coseno del ángulo
    """
    # Normalizar el ángulo al rango [-2π, 2π]
    x = x % (2 * math.pi)
    if x > math.pi:
        x -= 2 * math.pi

    resultado = 0
    x_potencia = 1  # x^0
    signo = 1

    for n in range(terminos):
        # Añadir término actual
        resultado += signo * x_potencia / factorial(2*n)

        # Preparar siguiente término
        x_potencia *= x * x  # x^(2n+2) = x^(2n) * x^2
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
    print("     CALCULADORA DE COSENO")
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

        # Calcular coseno con nuestra implementación
        mi_resultado = mi_cos(angulo_radianes)

        # Calcular con función nativa
        resultado_nativo = math.cos(angulo_radianes)

        # Mostrar resultados
        print("\n" + "="*70)
        print("RESULTADO DEL CÁLCULO")
        print("="*70)
        if unidad == 1:
            print(f"Ángulo: {angulo_grados}° = {angulo_radianes:.6f} rad")
        else:
            print(f"Ángulo: {angulo_radianes} rad = {angulo_grados:.6f}°")

        print(f"cos(x) - Mi implementación:  {mi_resultado:.10f}")
        print(f"cos(x) - Python nativo:     {resultado_nativo:.10f}")

        # Calcular error
        error = abs(mi_resultado - resultado_nativo)
        porcentaje_error = (error / abs(resultado_nativo)) * 100 if resultado_nativo != 0 else 0

        print(f"\nError absoluto: {error:.2e}")
        print(f"Error relativo: {porcentaje_error:.8f}%")

        # Verificar identidad fundamental: sen²(x) + cos²(x) = 1
        # Para esto necesitamos implementar seno también
        def mi_sen_basico(x):
            """Implementación básica de seno usando serie de Taylor"""
            x = x % (2 * math.pi)
            if x > math.pi:
                x -= 2 * math.pi

            resultado = 0
            for n in range(15):
                termino = ((-1)**n) * (x**(2*n + 1)) / factorial(2*n + 1)
                resultado += termino
            return resultado

        mi_seno = mi_sen_basico(angulo_radianes)
        identidad = mi_seno**2 + mi_resultado**2
        print(f"\nVerificación de identidad fundamental:")
        print(f"sen²(x) + cos²(x) = {mi_seno:.6f}² + {mi_resultado:.6f}² = {identidad:.10f}")
        print(f"Debería ser ≈ 1.0, diferencia: {abs(1.0 - identidad):.2e}")

        # Mostrar algunos ángulos conocidos
        print(f"\n📚 Valores de coseno para ángulos conocidos:")
        angulos_conocidos = [0, 30, 45, 60, 90, 180, 270, 360]

        for angulo in angulos_conocidos:
            rad = grados_a_radianes(angulo)
            mi_cos_val = mi_cos(rad)
            nativo_cos = math.cos(rad)
            print(f"cos({angulo:3d}°) = {mi_cos_val:8.6f} (nativo: {nativo_cos:8.6f})")

        # Información sobre la serie de Taylor
        print(f"\n🔍 Información sobre la serie de Taylor:")
        print(f"cos(x) = 1 - x²/2! + x⁴/4! - x⁶/6! + x⁸/8! - ...")
        print(f"Términos usados en el cálculo: 15")

        # Mostrar algunos términos de la serie para el ángulo dado
        if abs(angulo_radianes) < 2:  # Solo para ángulos pequeños
            print(f"\nPrimeros términos de la serie para x = {angulo_radianes:.4f}:")
            x = angulo_radianes
            termino1 = 1
            termino2 = -x**2 / factorial(2)
            termino3 = x**4 / factorial(4)
            termino4 = -x**6 / factorial(6)

            print(f"Término 1: 1 = {termino1:.8f}")
            print(f"Término 2: -x²/2! = {termino2:.8f}")
            print(f"Término 3: x⁴/4! = {termino3:.8f}")
            print(f"Término 4: -x⁶/6! = {termino4:.8f}")
            suma_parcial = termino1 + termino2 + termino3 + termino4
            print(f"Suma de 4 términos: {suma_parcial:.8f}")

        # Relación con otras funciones trigonométricas
        print(f"\n📐 Relaciones trigonométricas:")
        print(f"cos(x) = sen(90° - x) = sen({90 - angulo_grados:.2f}°)")
        cos_como_sen = mi_sen_basico(grados_a_radianes(90 - angulo_grados))
        print(f"Verificación: sen({90 - angulo_grados:.2f}°) = {cos_como_sen:.6f}")

    except ValueError:
        print("Error: Por favor ingrese valores numéricos válidos.")
    except Exception as e:
        print(f"Error inesperado: {e}")

if __name__ == "__main__":
    main()