#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Algoritmos Secuenciales
Ejercicio 5: Convertir temperatura de Celsius a Fahrenheit
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def celsius_a_fahrenheit(celsius):
    """Función que convierte grados Celsius a Fahrenheit"""
    return (celsius * 9/5) + 32

def fahrenheit_a_celsius(fahrenheit):
    """Función que convierte grados Fahrenheit a Celsius"""
    return (fahrenheit - 32) * 5/9

def main():
    print("=================================")
    print("   CONVERSOR DE TEMPERATURA")
    print("=================================\n")

    try:
        print("Seleccione el tipo de conversión:")
        print("1. Celsius a Fahrenheit")
        print("2. Fahrenheit a Celsius")

        opcion = int(input("\nIngrese su opción (1 o 2): "))

        if opcion == 1:
            # Celsius a Fahrenheit
            celsius = float(input("Ingrese la temperatura en grados Celsius: "))
            fahrenheit = celsius_a_fahrenheit(celsius)

            print("\n" + "="*50)
            print("RESULTADO DE LA CONVERSIÓN")
            print("="*50)
            print(f"Temperatura en Celsius: {celsius}°C")
            print(f"Temperatura en Fahrenheit: {fahrenheit:.2f}°F")

        elif opcion == 2:
            # Fahrenheit a Celsius
            fahrenheit = float(input("Ingrese la temperatura en grados Fahrenheit: "))
            celsius = fahrenheit_a_celsius(fahrenheit)

            print("\n" + "="*50)
            print("RESULTADO DE LA CONVERSIÓN")
            print("="*50)
            print(f"Temperatura en Fahrenheit: {fahrenheit}°F")
            print(f"Temperatura en Celsius: {celsius:.2f}°C")

        else:
            print("Error: Opción no válida. Seleccione 1 o 2.")
            return

        # Información adicional sobre la temperatura
        temp_celsius = celsius if opcion == 1 else fahrenheit_a_celsius(fahrenheit)

        print(f"\nInformación adicional:")
        print(f"• Punto de congelación del agua: 0°C = 32°F")
        print(f"• Punto de ebullición del agua: 100°C = 212°F")

        # Clasificar la temperatura
        if temp_celsius < 0:
            clasificacion = "Muy frío (bajo cero)"
        elif temp_celsius < 15:
            clasificacion = "Frío"
        elif temp_celsius < 25:
            clasificacion = "Templado"
        elif temp_celsius < 35:
            clasificacion = "Caliente"
        else:
            clasificacion = "Muy caliente"

        print(f"• Clasificación: {clasificacion}")

        # Mostrar fórmula utilizada
        if opcion == 1:
            print(f"\nFórmula utilizada: °F = (°C × 9/5) + 32")
            print(f"Cálculo: ({celsius} × 9/5) + 32 = {fahrenheit:.2f}")
        else:
            print(f"\nFórmula utilizada: °C = (°F - 32) × 5/9")
            print(f"Cálculo: ({fahrenheit} - 32) × 5/9 = {celsius:.2f}")

    except ValueError:
        print("Error: Por favor ingrese valores numéricos válidos.")
    except Exception as e:
        print(f"Error inesperado: {e}")

if __name__ == "__main__":
    main()