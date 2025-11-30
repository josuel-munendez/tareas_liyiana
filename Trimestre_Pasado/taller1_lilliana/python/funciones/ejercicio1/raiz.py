#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Funciones Matemáticas
Ejercicio 1: Implementar función sqrt() para calcular raíz cuadrada
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

import math

def mi_sqrt(numero, precision=1e-10):
    """
    Implementación propia de sqrt() usando el método de Newton-Raphson
    Args:
        numero: Número del cual calcular la raíz cuadrada
        precision: Precisión deseada para el cálculo
    Returns:
        Raíz cuadrada del número o None si es negativo
    """
    # Manejar casos especiales
    if numero < 0:
        return None  # No existe raíz cuadrada real para números negativos

    if numero == 0:
        return 0

    # Valor inicial (aproximación inicial)
    x = numero / 2
    iteraciones = 0

    # Iterar hasta alcanzar la precisión deseada
    while True:
        x_nuevo = (x + numero / x) / 2
        diferencia = abs(x_nuevo - x)
        iteraciones += 1

        if diferencia <= precision:
            break

        x = x_nuevo

        # Evitar bucles infinitos
        if iteraciones > 1000:
            break

    return x_nuevo

def comparar_con_nativo(numero, mi_calculo):
    """Función para comparar con sqrt() nativo de Python"""
    if mi_calculo is None:
        return "N/A"

    nativo = math.sqrt(numero)
    diferencia = abs(mi_calculo - nativo)
    if nativo != 0:
        porcentaje_error = (diferencia / nativo) * 100
        return f"{porcentaje_error:.10f}%"
    else:
        return "0%"

def main():
    print("=================================")
    print("  CALCULADORA DE RAÍZ CUADRADA")
    print("=================================\n")

    try:
        # Leer número del usuario
        numero = float(input("Ingrese un número para calcular su raíz cuadrada: "))

        # Validar entrada
        if numero < 0:
            print("Error: No se puede calcular la raíz cuadrada de un número negativo.")
            return

        # Calcular con nuestra implementación
        mi_resultado = mi_sqrt(numero)

        # Calcular con función nativa
        nativo_resultado = math.sqrt(numero)

        # Calcular error
        error = comparar_con_nativo(numero, mi_resultado)

        # Mostrar resultados
        print("\n" + "="*60)
        print("RESULTADO DEL CÁLCULO")
        print("="*60)
        print(f"Número: {numero}")
        print(f"Raíz cuadrada (mi implementación): {mi_resultado:.10f}")
        print(f"Raíz cuadrada (Python nativo):    {nativo_resultado:.10f}")
        print(f"Error relativo: {error}")

        # Verificación
        verificacion = mi_resultado ** 2
        print(f"\nVerificación: ({mi_resultado:.6f})² = {verificacion:.10f}")
        print(f"Diferencia con el original: {abs(numero - verificacion):.2e}")

        # Ejemplos con números conocidos
        print(f"\n📚 Ejemplos de raíces cuadradas conocidas:")
        ejemplos = [1, 4, 9, 16, 25, 36, 49, 64, 81, 100]

        for ejemplo in ejemplos[:5]:  # Mostrar solo 5 ejemplos
            mi_calc = mi_sqrt(ejemplo)
            nativo = math.sqrt(ejemplo)
            error_ej = comparar_con_nativo(ejemplo, mi_calc)
            print(f"√{ejemplo:2d} → Mi: {mi_calc:8.6f}, Python: {nativo:8.6f}, Error: {error_ej}")

    except ValueError:
        print("Error: Por favor ingrese un número válido.")
    except Exception as e:
        print(f"Error inesperado: {e}")

if __name__ == "__main__":
    main()