#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Para
Ejercicio 5: Promediar un conjunto de calificaciones de estudiantes
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def validar_calificacion(calificacion):
    """Valida que la calificación esté en el rango 0-100"""
    return 0 <= calificacion <= 100

def clasificar_calificacion(calificacion):
    """Clasifica una calificación según escalas comunes"""
    if calificacion >= 90:
        return "Excelente", "A"
    elif calificacion >= 80:
        return "Muy Bueno", "B"
    elif calificacion >= 70:
        return "Bueno", "C"
    elif calificacion >= 60:
        return "Regular", "D"
    else:
        return "Deficiente", "F"

def main():
    print("=================================")
    print(" EJERCICIO 5: Promedio de Calificaciones")
    print("=================================\n")

    try:
        # Leer número de estudiantes
        num_estudiantes = int(input("¿Cuántos estudiantes hay en el grupo? "))

        if num_estudiantes <= 0:
            print("Error: El número de estudiantes debe ser mayor a 0.")
            return

        calificaciones = []
        nombres_estudiantes = []

        print(f"\nIngrese las calificaciones de los {num_estudiantes} estudiantes:")
        print("(Rango válido: 0-100)")
        print("-" * 50)

        # Ciclo para leer calificaciones
        for i in range(num_estudiantes):
            while True:
                try:
                    nombre = input(f"Nombre del estudiante {i+1}: ").strip()
                    if nombre:
                        nombres_estudiantes.append(nombre)
                        break
                    else:
                        print("Por favor ingrese un nombre válido.")
                except:
                    print("Error al leer el nombre. Intente de nuevo.")

            while True:
                try:
                    calificacion = float(input(f"Calificación de {nombres_estudiantes[i]} (0-100): "))
                    if validar_calificacion(calificacion):
                        calificaciones.append(calificacion)
                        break
                    else:
                        print("Error: La calificación debe estar entre 0 y 100.")
                except ValueError:
                    print("Error: Por favor ingrese un número válido.")

        # Calcular estadísticas
        suma_total = sum(calificaciones)
        promedio = suma_total / num_estudiantes
        calificacion_mayor = max(calificaciones)
        calificacion_menor = min(calificaciones)

        # Mostrar resultados
        print("\n" + "="*70)
        print("REPORTE DE CALIFICACIONES")
        print("="*70)

        print(f"\n📚 DATOS DEL GRUPO:")
        print("-" * 20)
        print(f"• Número de estudiantes: {num_estudiantes}")
        print(f"• Suma total de puntos: {suma_total:.1f}")
        print(f"• Promedio del grupo: {promedio:.2f}")

        clasificacion_promedio, letra_promedio = clasificar_calificacion(promedio)
        print(f"• Clasificación del grupo: {clasificacion_promedio} ({letra_promedio})")

        # Estadísticas generales
        print(f"\n📊 ESTADÍSTICAS GENERALES:")
        print("-" * 26)
        print(f"• Calificación más alta: {calificacion_mayor:.1f}")
        print(f"• Calificación más baja: {calificacion_menor:.1f}")
        print(f"• Diferencia (rango): {calificacion_mayor - calificacion_menor:.1f}")

        # Calcular mediana
        calificaciones_ordenadas = sorted(calificaciones)
        n = len(calificaciones_ordenadas)
        if n % 2 == 0:
            mediana = (calificaciones_ordenadas[n//2 - 1] + calificaciones_ordenadas[n//2]) / 2
        else:
            mediana = calificaciones_ordenadas[n//2]

        print(f"• Mediana: {mediana:.2f}")

        # Calcular desviación estándar básica
        varianza = sum((x - promedio) ** 2 for x in calificaciones) / num_estudiantes
        desviacion_estandar = varianza ** 0.5
        print(f"• Desviación estándar: {desviacion_estandar:.2f}")

        # Detalles por estudiante
        print(f"\n👥 DETALLES POR ESTUDIANTE:")
        print("-" * 28)
        print(f"{'#':<3} {'Nombre':<20} {'Calif.':<8} {'Clasif.':<12} {'Letra':<6}")
        print("-" * 60)

        for i in range(num_estudiantes):
            clasificacion, letra = clasificar_calificacion(calificaciones[i])
            print(f"{i+1:<3} {nombres_estudiantes[i]:<20} {calificaciones[i]:<8.1f} {clasificacion:<12} {letra:<6}")

        # Análisis de distribución
        print(f"\n📈 ANÁLISIS DE DISTRIBUCIÓN:")
        print("-" * 29)

        # Contar por categorías
        excelentes = sum(1 for c in calificaciones if c >= 90)
        muy_buenos = sum(1 for c in calificaciones if 80 <= c < 90)
        buenos = sum(1 for c in calificaciones if 70 <= c < 80)
        regulares = sum(1 for c in calificaciones if 60 <= c < 70)
        deficientes = sum(1 for c in calificaciones if c < 60)

        print(f"• Excelentes (90-100): {excelentes} estudiantes ({excelentes/num_estudiantes*100:.1f}%)")
        print(f"• Muy Buenos (80-89):  {muy_buenos} estudiantes ({muy_buenos/num_estudiantes*100:.1f}%)")
        print(f"• Buenos (70-79):      {buenos} estudiantes ({buenos/num_estudiantes*100:.1f}%)")
        print(f"• Regulares (60-69):   {regulares} estudiantes ({regulares/num_estudiantes*100:.1f}%)")
        print(f"• Deficientes (0-59):  {deficientes} estudiantes ({deficientes/num_estudiantes*100:.1f}%)")

        # Estudiantes destacados
        if calificaciones:
            print(f"\n🏆 ESTUDIANTES DESTACADOS:")
            print("-" * 26)

            # Mejor estudiante
            indice_mejor = calificaciones.index(calificacion_mayor)
            print(f"🥇 Mejor calificación: {nombres_estudiantes[indice_mejor]} con {calificacion_mayor:.1f}")

            # Estudiantes por encima del promedio
            por_encima = [(nombres_estudiantes[i], calificaciones[i])
                         for i in range(num_estudiantes)
                         if calificaciones[i] > promedio]

            print(f"📈 Por encima del promedio ({promedio:.1f}): {len(por_encima)} estudiantes")
            for nombre, calif in por_encima[:5]:  # Mostrar máximo 5
                print(f"   • {nombre}: {calif:.1f}")

            if len(por_encima) > 5:
                print(f"   • ... y {len(por_encima) - 5} más")

        # Recomendaciones
        print(f"\n💡 RECOMENDACIONES:")
        print("-" * 18)
        if promedio >= 80:
            print("✅ Excelente desempeño del grupo. ¡Continúen así!")
        elif promedio >= 70:
            print("✅ Buen desempeño general. Algunas áreas de mejora.")
        elif promedio >= 60:
            print("⚠️  Desempeño regular. Se recomienda reforzar conceptos.")
        else:
            print("🚨 Desempeño bajo. Se requiere intervención pedagógica.")

        if deficientes > 0:
            print(f"• Atención especial para {deficientes} estudiante(s) con calificación deficiente")

        if desviacion_estandar > 15:
            print("• Alta variabilidad en calificaciones. Revisar métodos de enseñanza.")

        print(f"\n✅ Análisis completado exitosamente")
        print("=" * 45)

    except ValueError:
        print("Error: Por favor ingrese valores numéricos válidos.")
    except Exception as e:
        print(f"Error inesperado: {e}")

if __name__ == "__main__":
    main()