from rich import print
filas = 5
columnas = 5
matriz = []

for i in range(filas):
    fila = []
    for m in range(columnas):
        elemento = int(input(f"Ingrese el valor de la fila [{i}] de la columna [{m}]: "))
        fila.append(elemento)
    matriz.append(fila)



suma = 0
count = {}     
for n in matriz:
    for element in n:
        suma += element
        if element in count:
            count[element] +=1 
        else:
            count[element] = 1
            
print("[blue]La matriz es: [/]") 
for fil in matriz:
    for elem in fil:
        print(f"[yellow]{elem}[/]", end=" ")
    print()

print(f"[green]La suma de todos sus valores es: {suma}[/]")

contador = 0
for dic in count.values():
    if dic >= 2:
        contador +=1
    
    
if contador > 0:
    print(f"[violet]Numeros repetidos: {contador}[/]") 
else:
    print("[red]no hay numeros repetidos[/]")   

repetidos = []
for num, cant in count.items():
    if cant >= 2:
        repetidos.append(num)
        print(f"[blue]el número {num} se repite {cant} veces. [/]")
if contador >=2: 
    print(f"[red]El vector con los numeros repetidos:\n{repetidos}[/]")