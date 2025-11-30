#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Repetir (Do-While)
Ejercicio 5: Promedio de calificaciones usando repetir
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
    print(" EJERCICIO 5: Calificaciones (Repetir)")
    print("=================================\n")

    print("📚 CALCULADORA DE PROMEDIO DE CALIFICACIONES")
    print("Usando estructura REPETIR (Do-While)")
    print("-" * 50)

    calificaciones = []
    nombres_estudiantes = []
    suma_total = 0
    contador = 0

    # Método de entrada
    print("\nSeleccione el método de entrada:")
    print("1. Número fijo de estudiantes")
    print("2. Ingresar hasta decidir parar")

    try:
        metodo = int(input("Ingrese su opción (1 o 2): "))

        if metodo == 1:
            # Método 1: Número fijo conocido
            num_estudiantes = int(input("¿Cuántos estudiantes? "))
            if num_estudiantes <= 0:
                print("Error: Debe ingresar un número positivo.")
                return

            print(f"\nIngrese datos para {num_estudiantes} estudiantes:")
            print("(Calificaciones en rango 0-100)")
            print("-" * 35)

            # REPETIR con contador fijo
            i = 1
            while True:
                try:
                    nombre = input(f"Nombre del estudiante {i}: ").strip()
                    if not nombre:
                        nombre = f"Estudiante {i}"

                    while True:
                        calificacion = float(input(f"Calificación de {nombre} (0-100): "))
                        if validar_calificacion(calificacion):
                            break
                        else:
                            print("⚠️ Error: La calificación debe estar entre 0 y 100")

                    nombres_estudiantes.append(nombre)
                    calificaciones.append(calificacion)
                    suma_total += calificacion
                    contador += 1

                    print(f"✅ {nombre}: {calificacion} - Promedio parcial: {suma_total/contador:.2f}")

                except ValueError:
                    print("❌ Error: Ingrese un número válido")
                    continue

                # Condición de salida del REPETIR
                if i >= num_estudiantes:
                    break
                i += 1

        elif metodo == 2:
            # Método 2: Hasta decidir parar
            print("\nIngrese estudiantes (ingrese 'fin' como nombre para terminar):")
            print("(Calificaciones en rango 0-100)")
            print("-" * 45)

            # REPETIR hasta decisión del usuario
            estudiante_num = 1
            while True:
                try:
                    nombre = input(f"Nombre del estudiante {estudiante_num} (o 'fin' para terminar): ").strip()

                    if nombre.lower() == 'fin':
                        if contador == 0:
                            print("⚠️ Debe ingresar al menos un estudiante")
                            continue
                        break

                    if not nombre:
                        nombre = f"Estudiante {estudiante_num}"

                    while True:
                        try:
                            calificacion = float(input(f"Calificación de {nombre} (0-100): "))
                            if validar_calificacion(calificacion):
                                break
                            else:
                                print("⚠️ Error: La calificación debe estar entre 0 y 100")
                        except ValueError:
                            print("❌ Error: Ingrese un número válido")

                    nombres_estudiantes.append(nombre)
                    calificaciones.append(calificacion)
                    suma_total += calificacion
                    contador += 1

                    promedio_actual = suma_total / contador
                    print(f"✅ {nombre}: {calificacion} - Promedio actual: {promedio_actual:.2f}")

                    # Preguntar si continuar (característica del REPETIR)
                    if contador >= 3:  # Después de 3 estudiantes, preguntar
                        continuar = input("¿Agregar otro estudiante? (s/n): ").lower()
                        if continuar in ['n', 'no']:
                            break

                    estudiante_num += 1

                except KeyboardInterrupt:
                    print("\n\n⏹️ Proceso interrumpido")
                    if contador > 0:
                        print("Procesando datos ingresados...")
                        break
                    else:
                        return
        else:
            print("❌ Opción inválida")
            return

        # Procesar resultados si hay datos
        if contador == 0:
            print("❌ No se ingresaron calificaciones válidas")
            return

        # Calcular estadísticas
        promedio_final = suma_total / contador
        calificacion_mayor = max(calificaciones)
        calificacion_menor = min(calificaciones)

        # Mostrar resultados usando análisis de REPETIR
        print(f"\n" + "="*70)
        print("REPORTE FINAL DE CALIFICACIONES")
        print("="*70)

        print(f"\n📊 RESUMEN GENERAL:")
        print("-" * 18)
        print(f"• Método utilizado: {'Número fijo' if metodo == 1 else 'Entrada flexible'}")
        print(f"• Total de estudiantes: {contador}")
        print(f"• Suma total de puntos: {suma_total:.1f}")
        print(f"• Promedio del grupo: {promedio_final:.2f}")

        clasificacion_grupo, letra_grupo = clasificar_calificacion(promedio_final)
        print(f"• Clasificación del grupo: {clasificacion_grupo} ({letra_grupo})")

        # Estadísticas detalladas
        print(f"\n📈 ESTADÍSTICAS DETALLADAS:")
        print("-" * 27)
        print(f"• Calificación más alta: {calificacion_mayor:.1f}")
        print(f"• Calificación más baja: {calificacion_menor:.1f}")
        print(f"• Rango (diferencia): {calificacion_mayor - calificacion_menor:.1f}")

        # Calcular mediana y otras estadísticas
        calificaciones_ordenadas = sorted(calificaciones)
        n = len(calificaciones_ordenadas)
        if n % 2 == 0:
            mediana = (calificaciones_ordenadas[n//2 - 1] + calificaciones_ordenadas[n//2]) / 2
        else:
            mediana = calificaciones_ordenadas[n//2]

        varianza = sum((x - promedio_final) ** 2 for x in calificaciones) / contador
        desviacion = varianza ** 0.5

        print(f"• Mediana: {mediana:.2f}")
        print(f"• Desviación estándar: {desviacion:.2f}")
        if promedio_final > 0:
            print(f"• Coeficiente de variación: {(desviacion/promedio_final)*100:.1f}%")

        # Listado por estudiante
        print(f"\n👥 LISTADO POR ESTUDIANTE:")
        print("-" * 26)
        print(f"{'#':<3} {'Nombre':<20} {'Calificación':<12} {'Clasificación':<15} {'Letra'}")
        print("-" * 65)

        for i in range(contador):
            clasificacion, letra = clasificar_calificacion(calificaciones[i])
            print(f"{i+1:<3} {nombres_estudiantes[i]:<20} {calificaciones[i]:<12.1f} {clasificacion:<15} {letra}")

        # Análisis de distribución
        print(f"\n📊 ANÁLISIS DE DISTRIBUCIÓN:")
        print("-" * 27)

        excelentes = sum(1 for c in calificaciones if c >= 90)
        muy_buenos = sum(1 for c in calificaciones if 80 <= c < 90)
        buenos = sum(1 for c in calificaciones if 70 <= c < 80)
        regulares = sum(1 for c in calificaciones if 60 <= c < 70)
        deficientes = sum(1 for c in calificaciones if c < 60)

        print(f"• Excelentes (90-100): {excelentes} ({excelentes/contador*100:.1f}%)")
        print(f"• Muy Buenos (80-89):  {muy_buenos} ({muy_buenos/contador*100:.1f}%)")
        print(f"• Buenos (70-79):      {buenos} ({buenos/contador*100:.1f}%)")
        print(f"• Regulares (60-69):   {regulares} ({regulares/contador*100:.1f}%)")
        print(f"• Deficientes (0-59):  {deficientes} ({deficientes/contador*100:.1f}%)")

        # Análisis del algoritmo REPETIR usado
        print(f"\n⚙️  ANÁLISIS DEL ALGORITMO REPETIR:")
        print("-" * 36)
        print(f"• Estructura: REPETIR...HASTA")
        print(f"• Garantía: Al menos un estudiante procesado")
        print(f"• Flexibilidad: Permite entrada variable")
        print(f"• Validación: Repetir hasta datos válidos")
        print(f"• Control: Usuario decide cuándo parar")

        # Proceso paso a paso (para pocos estudiantes)
        if contador <= 8:
            print(f"\n📝 PROCESO PASO A PASO:")
            print("-" * 22)
            suma_parcial = 0
            for i in range(contador):
                suma_parcial += calificaciones[i]
                promedio_parcial = suma_parcial / (i + 1)
                print(f"Paso {i+1}: {nombres_estudiantes[i]:<15} {calificaciones[i]:6.1f} → Promedio: {promedio_parcial:6.2f}")

        # Comparación con otros enfoques
        print(f"\n📊 COMPARACIÓN DE ENFOQUES:")
        print("-" * 27)

        # Calcular con diferentes métodos para verificar
        suma_for = sum(calificaciones)
        promedio_for = suma_for / len(calificaciones) if calificaciones else 0

        suma_mientras = 0
        for calif in calificaciones:
            suma_mientras += calif
        promedio_mientras = suma_mientras / len(calificaciones) if calificaciones else 0

        print(f"• REPETIR (usado):    Promedio: {promedio_final:.6f}")
        print(f"• FOR automático:     Promedio: {promedio_for:.6f}")
        print(f"• MIENTRAS manual:    Promedio: {promedio_mientras:.6f}")
        print(f"• Función sum():      Promedio: {sum(calificaciones)/len(calificaciones) if calificaciones else 0:.6f}")

        coinciden = all(abs(p - promedio_final) < 0.000001 for p in [promedio_for, promedio_mientras])
        print(f"• Todos coinciden: {'✅ Sí' if coinciden else '❌ No'}")

        # Recomendaciones pedagógicas
        print(f"\n💡 RECOMENDACIONES:")
        print("-" * 18)
        if promedio_final >= 85:
            print("✅ Excelente desempeño grupal")
            print("• Mantener metodología actual")
            print("• Continuar con desafíos avanzados")
        elif promedio_final >= 75:
            print("✅ Buen desempeño general")
            print("• Reforzar conceptos débiles")
            print("• Motivar estudiantes con dificultades")
        elif promedio_final >= 65:
            print("⚠️ Desempeño regular")
            print("• Revisar métodos de enseñanza")
            print("• Atención personalizada necesaria")
        else:
            print("🚨 Desempeño bajo")
            print("• Intervención pedagógica urgente")
            print("• Reevaluar curriculum y métodos")

        if deficientes > 0:
            print(f"• Atención especial para {deficientes} estudiante(s)")

        if desviacion > 15:
            print("• Alta variabilidad - revisar métodos de evaluación")

        # Ventajas del REPETIR para este caso
        print(f"\n⚖️  VENTAJAS DEL REPETIR AQUÍ:")
        print("-" * 28)
        print(f"✅ Garantiza procesar al menos un estudiante")
        print(f"✅ Permite validación iterativa de datos")
        print(f"✅ Usuario controla cuándo terminar")
        print(f"✅ Natural para entrada interactiva")
        print(f"✅ Manejo flexible de errores")

        # Pseudocódigo del proceso
        print(f"\n📝 PSEUDOCÓDIGO EQUIVALENTE:")
        print("-" * 27)
        print(f"INICIO")
        print(f"    contador ← 0")
        print(f"    suma ← 0")
        print(f"    REPETIR")
        print(f"        REPETIR")
        print(f"            pedir_calificacion()")
        print(f"        HASTA calificacion_valida")
        print(f"        suma ← suma + calificacion")
        print(f"        contador ← contador + 1")
        print(f"        preguntar_continuar()")
        print(f"    HASTA no_continuar OR contador = maximo")
        print(f"    promedio ← suma / contador")
        print(f"    mostrar_resultados()")
        print(f"FIN")

        print(f"\n✅ Análisis de calificaciones con REPETIR completado")
        print("=" * 52)

    except ValueError:
        print("❌ Error: Ingrese valores numéricos válidos")
    except KeyboardInterrupt:
        print(f"\n\n⏹️ Proceso interrumpido por el usuario")
    except Exception as e:
        print(f"❌ Error inesperado: {e}")

if __name__ == "__main__":
    main()