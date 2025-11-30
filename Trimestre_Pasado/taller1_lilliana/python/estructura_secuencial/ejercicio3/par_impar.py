#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Algoritmos Secuenciales
Ejercicio 3: Determinar si un número es par o impar
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def es_par(numero):
    """Función que determina si un número es par"""
    return numero % 2 == 0

def main():
    print("=================================")
    print("   DETECTOR DE NÚMEROS PAR/IMPAR")
    print("=================================\n")

    try:
        # Leer número del usuario
        numero = int(input("Ingrese un número entero: "))

        # Determinar si es par o impar
        if es_par(numero):
            resultado = "PAR"
            emoji = "✅"
            descripcion = "es divisible entre 2"
        else:
            resultado = "IMPAR"
            emoji = "❌"
            descripcion = "NO es divisible entre 2"

        # Mostrar resultado
        print("\n" + "="*40)
        print("RESULTADO DEL ANÁLISIS")
        print("="*40)
        print(f"Número ingresado: {numero}")
        print(f"Clasificación: {emoji} {resultado}")
        print(f"Explicación: El número {numero} {descripcion}")

        # Información adicional
        residuo = numero % 2
        print(f"\nDatos técnicos:")
        print(f"• {numero} ÷ 2 = {numero // 2} (residuo: {residuo})")
        print(f"• Como el residuo es {residuo}, el número es {resultado.lower()}")

        # Números cercanos
        print(f"\nNúmeros cercanos:")
        if es_par(numero - 1):
            print(f"• {numero - 1}: PAR")
        else:
            print(f"• {numero - 1}: IMPAR")

        if es_par(numero + 1):
            print(f"• {numero + 1}: PAR")
        else:
            print(f"• {numero + 1}: IMPAR")

    except ValueError:
        print("Error: Por favor ingrese un número entero válido.")
    except Exception as e:
        print(f"Error inesperado: {e}")

if __name__ == "__main__":
    main()