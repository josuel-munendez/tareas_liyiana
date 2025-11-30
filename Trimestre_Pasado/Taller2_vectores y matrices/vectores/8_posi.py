#8) Realizar un algoritmo donde se recorra los algoritmos simultáneamente los
# vectores del punto 1, 2,3 mostrando posición y resultado.



from rich import print #importo una libreria para agregar colores
# Traemos los 3 vectores

tamaño1 = 20  # Defino el tamaño del vector, en este caso 20 elementos
vector1 = []  # Inicializo un vector vacío
for i in range(tamaño1):  # Recorro segun el tamaño del vector, y comenzar por defecto en 0
    vector1.append(i*2+1) #la funcion append agrega el elemento al final del vector

tamaño2 = 15 # Defino el tamaño del vector, en este caso 15 elementos
vector2 =[] # Inicializo un vector vacío
for i in range(1, tamaño2): #Hago que comience en 1 para que el primer elemento sea 2, hasta 15 que es la dimension del vector 
    vector2.append(i * 2)  # Comienza en 2 y aumenta de 2 en 2

tamaño3 = 11  # Defino el tamaño del vector, en este caso 11 elementos
vector3 = []  # Inicializo un vector vacío
for i in range(tamaño3):  # Recorro segun el tamaño del vector, y comenzar por defecto en 0
    if i == 0:  # Si es el primer elemento, lo agrego como 1
        vector3.append(1)
    elif i == 1:  
        vector3.append(2)
    else:  
        vector3.append(i * 3) #ya despues de agregar los dos primeros numeros, ahora si continuamos con los multiplos de 3 

# saco la maxima posicion que tiene algunos de los tres vectores para recorrerlo en el for

max_pos = max(len(vector1), len(vector2), len(vector3))
print ("[blue]Posicion [/]|[violet] Vector 1 [/]|[red] Vector 2[/]|[yellow] Vector3 [/]")

for posicion in range(max_pos):
    # verificar en que haiga una valor en esa posicion
    if len(vector1) > posicion:
        valor1 = vector1[posicion]
    else:
        valor1 = " "
    if len(vector2) > posicion:
        valor2 = vector2[posicion]
    else:
        valor2 = " "
    if len(vector3) > posicion:
        valor3 = vector3[posicion]
    else:
        valor3 = " "
    print (f"{posicion:8} | {valor1:8} | {valor2:8}| {valor3:8}") #uso :8 para reservar 8 espacios y no colocar espacios en el print para que alinee con el |
        
