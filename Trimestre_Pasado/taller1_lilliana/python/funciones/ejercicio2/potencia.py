#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Funciones Matemáticas
Ejercicio 2: Implementar función pow() para calcular potencias
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def mi_pow(base, exponente):
    """
    Implementación propia de pow() para calcular potencias
    Args:
        base: Número base
        exponente: Exponente (debe ser entero)
    Returns:
        Resultado de base elevado a exponente
    """
    # Casos especiales
    if exponente == 0:
        return 1

    if exponente == 1:
        return base

    if base == 0:
        return 0 if exponente > 0 else None  # 0^n con n<0 no está definido

    # Para exponentes negativos
    if exponente < 0:
        return 1 / mi_pow(base, -exponente)

    # Cálculo iterativo para exponentes positivos
    resultado = 1
    for i in range(exponente):
        resultado *= base

    return resultado

def mi_pow_optimizado(base, exponente):
    """
    Implementación optimizada usando exponenciación binaria
    """
    if exponente == 0:
        return 1

    if exponente < 0:
        return 1 / mi_pow_optimizado(base, -exponente)

    resultado = 1
    base_actual = base
    exp_actual = exponente

    while exp_actual > 0:
        if exp_actual % 2 == 1:
            resultado *= base_actual
        base_actual *= base_actual
        exp_actual //= 2

    return resultado

def main():
    print("=================================")
    print("    CALCULADORA DE POTENCIAS")
    print("=================================\n")

    try:
        # Leer datos del usuario
        base = float(input("Ingrese la base: "))
        exponente = int(input("Ingrese el exponente (número entero): "))

        # Validar casos especiales
        if base == 0 and exponente < 0:
            print("Error: 0 elevado a un exponente negativo no está definido.")
            return

        # Calcular con nuestras implementaciones
        resultado_simple = mi_pow(base, exponente)
        resultado_optimizado = mi_pow_optimizado(base, exponente)

        # Calcular con función nativa
        resultado_nativo = pow(base, exponente)

        # Mostrar resultados
        print("\n" + "="*60)
        print("RESULTADO DEL CÁLCULO")
        print("="*60)
        print(f"Base: {base}")
        print(f"Exponente: {exponente}")
        print(f"Resultado (implementación simple):    {resultado_simple}")
        print(f"Resultado (implementación optimizada): {resultado_optimizado}")
        print(f"Resultado (Python nativo):            {resultado_nativo}")

        # Verificar coherencia
        if abs(resultado_simple - resultado_nativo) < 1e-10:
            print("✅ Las implementaciones coinciden con Python nativo")
        else:
            diferencia = abs(resultado_simple - resultado_nativo)
            print(f"⚠️  Diferencia detectada: {diferencia}")

        # Mostrar algunos ejemplos
        print(f"\n📚 Ejemplos de potencias:")
        ejemplos = [
            (2, 3), (3, 2), (5, 0), (2, -3), (10, 2),
            (-2, 3), (-2, 2), (0.5, 2), (4, 0.5) if exponente >= 0 else (2, 4)
        ]

        for base_ej, exp_ej in ejemplos[:6]:
            try:
                if isinstance(exp_ej, int):
                    resultado_ej = mi_pow(base_ej, exp_ej)
                    nativo_ej = pow(base_ej, exp_ej)
                    print(f"{base_ej}^{exp_ej} = {resultado_ej} (nativo: {nativo_ej})")
                else:
                    # Para exponentes no enteros, solo mostrar nativo
                    nativo_ej = pow(base_ej, exp_ej)
                    print(f"{base_ej}^{exp_ej} = {nativo_ej} (solo nativo)")
            except:
                continue

        # Información sobre el algoritmo
        print(f"\n🔍 Información sobre el algoritmo:")
        if exponente >= 0:
            if exponente <= 10:
                pasos = " × ".join([str(base)] * exponente) if exponente > 1 else str(base)
                if exponente == 0:
                    print(f"Cualquier número elevado a 0 es 1 (por definición)")
                elif exponente == 1:
                    print(f"{base}^1 = {base}")
                else:
                    print(f"{base}^{exponente} = {pasos} = {resultado_simple}")
            else:
                print(f"Para exponentes grandes se usa multiplicación iterativa")
        else:
            print(f"Para exponentes negativos: a^(-n) = 1/(a^n)")
            print(f"{base}^({exponente}) = 1/({base}^{-exponente}) = 1/{mi_pow(base, -exponente)} = {resultado_simple}")

    except ValueError:
        print("Error: Por favor ingrese valores válidos (exponente debe ser entero).")
    except Exception as e:
        print(f"Error inesperado: {e}")

if __name__ == "__main__":
    main()