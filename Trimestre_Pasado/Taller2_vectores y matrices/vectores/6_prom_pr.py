# 6) Del ejercicio 5 el algoritmo debe ser capaz de preguntar al usuario el nombre
# del estudiante que desee mostrar el promedio.

# Inicio con las 5 notas


from rich import print #importo una libreria para agregar colores

#inicializo las variables
cant_nt = 5
nombr = []
prom_mat = []
promin = []


# le pido cuantos estudiantes va ingresar para almacenar cada nombre en una posicion

cant = int(input("Cuantos estudiantes desea ingresar: "))
for i in range(1,cant+1):
    nombres = input(f"Nombre del estudiante {i}: ")
    nombr.append(nombres)
    
    # genero los arrays o las listas de cada estudiante
    matest = []
    inest =[]
    prom_mat_es = []
    prom_in_es = []

    
    
    # pido las notas, lo del 1 y +1 es para que no inicie en 0
    print("[red] Notas de matematicas [/red]")
    for m in range(1, cant_nt+1):
        mat_not = int(input(f"Ingresa la nota {m} de matematicas del estudiante {nombres}: "))
        matest.append(mat_not)
    print("[violet]Notas para ingles[/violet]")
    for en in range(1, cant_nt+1):
        ingles_not = int(input(f"Ingresa la nota {en} de ingles del estudiante {nombres}: "))
        inest.append(ingles_not)
        
    prom_mat_es = sum(matest)/cant_nt
    prom_in_es = sum(inest)/cant_nt
    prom_mat.append(prom_mat_es)
    promin.append(prom_in_es)

    
    # dejo todo lo anterior igual del punto 5
    
# obtenemos la variable
buscar_est = input("Cual es el nombre del estudiante a buscar?: ")



    
if buscar_est in nombr:  #una condicion para saber de que el estudiante este dentro de la lista
    posicion = nombr.index(buscar_est) #buscamos la posicion
    print(f"[blue] Estudiante: {nombr[posicion]} \n  Promedio de matematicas:{prom_mat[posicion]} \n  Promedio de Inglés:{promin[posicion]} [/blue]")
else:
    print(f"[red]estudiante {buscar_est} no encontrado [/red]")#en caso de que no