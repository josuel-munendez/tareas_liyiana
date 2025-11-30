# 5) Hacer un vector donde el usuario ingrese 5 nota matemáticas, otro vector 5
# notas inglés y el vector nombre del estudiante al que corresponde dichas notas,
# de esos vectores debe calcular un vector promedio, más adelante vector
# promedio debe mostrar todos los promedios y el estudiante que corresponda.

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

    
    


for est in range(len(nombr)):
    print(f"[cian]Estudiante: {nombr[est]} \n  Promedio de matematicas:{prom_mat[est]} \n  Promedio de Inglés:{promin[est]} [/cian]")

