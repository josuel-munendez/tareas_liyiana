#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Funciones Matemáticas
Ejercicio 5: Implementar función tan() para calcular tangente
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

def mi_sen(x, terminos=15):
    """Implementación de seno usando serie de Taylor"""
    x = x % (2 * math.pi)
    if x > math.pi:
        x -= 2 * math.pi

    resultado = 0
    for n in range(terminos):
        termino = ((-1)**n) * (x**(2*n + 1)) / factorial(2*n + 1)
        resultado += termino
    return resultado

def mi_cos(x, terminos=15):
    """Implementación de coseno usando serie de Taylor"""
    x = x % (2 * math.pi)
    if x > math.pi:
        x -= 2 * math.pi

    resultado = 0
    x_potencia = 1
    signo = 1

    for n in range(terminos):
        resultado += signo * x_potencia / factorial(2*n)
        x_potencia *= x * x
        signo *= -1

    return resultado

def mi_tan(x):
    """
    Implementación propia de tan() usando tan(x) = sen(x)/cos(x)
    Args:
        x: Ángulo en radianes
    Returns:
        Tangente del ángulo o None si no está definida
    """
    coseno = mi_cos(x)

    # Verificar si la tangente está definida
    if abs(coseno) < 1e-10:  # Muy cercano a cero
        return None  # Tangente no definida

    seno = mi_sen(x)
    return seno / coseno

def grados_a_radianes(grados):
    """Convierte grados a radianes"""
    return grados * math.pi / 180

def radianes_a_grados(radianes):
    """Convierte radianes a grados"""
    return radianes * 180 / math.pi

def es_angulo_indefinido(angulo_grados):
    """Verifica si la tangente está indefinida para un ángulo en grados"""
    # La tangente es indefinida en 90°, 270°, 450°, etc. (90° + n*180°)
    angulo_normalizado = angulo_grados % 180
    return abs(angulo_normalizado - 90) < 1e-6

def main():
    print("=================================")
    print("    CALCULADORA DE TANGENTE")
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

        # Verificar si la tangente está definida
        if unidad == 1 and es_angulo_indefinido(angulo_grados):
            print(f"\n⚠️  La tangente de {angulo_grados}° no está definida (es infinita).")
            print("La tangente no está definida cuando cos(x) = 0")
            print("Esto ocurre en: ..., -90°, 90°, 270°, 450°, ...")
            return

        # Calcular tangente con nuestra implementación
        mi_resultado = mi_tan(angulo_radianes)

        if mi_resultado is None:
            print(f"\n⚠️  La tangente de este ángulo no está definida (división por cero).")
            return

        # Calcular con función nativa
        resultado_nativo = math.tan(angulo_radianes)

        # Mostrar resultados
        print("\n" + "="*70)
        print("RESULTADO DEL CÁLCULO")
        print("="*70)
        if unidad == 1:
            print(f"Ángulo: {angulo_grados}° = {angulo_radianes:.6f} rad")
        else:
            print(f"Ángulo: {angulo_radianes} rad = {angulo_grados:.6f}°")

        print(f"tan(x) - Mi implementación:  {mi_resultado:.10f}")
        print(f"tan(x) - Python nativo:     {resultado_nativo:.10f}")

        # Calcular error
        error = abs(mi_resultado - resultado_nativo)
        if resultado_nativo != 0:
            porcentaje_error = (error / abs(resultado_nativo)) * 100
        else:
            porcentaje_error = 0

        print(f"\nError absoluto: {error:.2e}")
        print(f"Error relativo: {porcentaje_error:.8f}%")

        # Mostrar cálculo paso a paso
        mi_seno = mi_sen(angulo_radianes)
        mi_coseno = mi_cos(angulo_radianes)
        print(f"\nCálculo paso a paso:")
        print(f"sen({angulo_grados:.2f}°) = {mi_seno:.8f}")
        print(f"cos({angulo_grados:.2f}°) = {mi_coseno:.8f}")
        print(f"tan({angulo_grados:.2f}°) = sen/cos = {mi_seno:.8f}/{mi_coseno:.8f} = {mi_resultado:.8f}")

        # Verificar identidad: tan(x) = sen(x)/cos(x)
        verificacion = mi_seno / mi_coseno if abs(mi_coseno) > 1e-10 else None
        if verificacion is not None:
            diferencia_verificacion = abs(mi_resultado - verificacion)
            print(f"Verificación sen/cos: {verificacion:.8f} (diff: {diferencia_verificacion:.2e})")

        # Mostrar algunos ángulos conocidos
        print(f"\n📚 Valores de tangente para ángulos conocidos:")
        angulos_conocidos = [0, 30, 45, 60, 180, 225, 315, 360]

        for angulo in angulos_conocidos:
            if not es_angulo_indefinido(angulo):
                rad = grados_a_radianes(angulo)
                mi_tan_val = mi_tan(rad)
                nativo_tan = math.tan(rad)
                if mi_tan_val is not None:
                    print(f"tan({angulo:3d}°) = {mi_tan_val:8.6f} (nativo: {nativo_tan:8.6f})")
                else:
                    print(f"tan({angulo:3d}°) = indefinida")
            else:
                print(f"tan({angulo:3d}°) = indefinida (∞)")

        # Información sobre la función tangente
        print(f"\n🔍 Información sobre la función tangente:")
        print(f"tan(x) = sen(x) / cos(x)")
        print(f"• Período: 180° (π radianes)")
        print(f"• Indefinida cuando cos(x) = 0 (cada 90° + n×180°)")
        print(f"• Rango: (-∞, +∞)")
        print(f"• tan(45°) = 1")
        print(f"• tan(0°) = 0")

        # Relaciones importantes
        print(f"\n📐 Relaciones trigonométricas:")
        print(f"tan(x) = 1/cot(x)")
        if abs(mi_resultado) > 1e-10:
            cotangente = 1 / mi_resultado
            print(f"cot({angulo_grados:.2f}°) = 1/tan({angulo_grados:.2f}°) = {cotangente:.8f}")

        # Identidades
        if angulo_grados != 0:
            tan_negativo = mi_tan(grados_a_radianes(-angulo_grados))
            if tan_negativo is not None:
                print(f"tan(-x) = -tan(x): tan({-angulo_grados:.2f}°) = {tan_negativo:.8f}")

    except ValueError:
        print("Error: Por favor ingrese valores numéricos válidos.")
    except Exception as e:
        print(f"Error inesperado: {e}")

if __name__ == "__main__":
    main()