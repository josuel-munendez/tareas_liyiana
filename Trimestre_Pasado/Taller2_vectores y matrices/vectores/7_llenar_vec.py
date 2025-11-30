# 7)Llenar un vector, donde el algoritmo sea capaz de calcular y llenarse solo
# con múltiplos de 20, cuando esté listo, debe realizar tres preguntas al usuario,
# desea promediar el vector, mostrar su suma, mostrar cada resultado de cada
# posición dividido por 2.


from rich.console import Console #investigando la libreria puedo añadir color al input de la consola
from rich import print #importo una libreria para agregar colores

console = Console() #agregamos la funcion Console a una variable
tamaño = 10  # Defino el tamaño del vector

vector = []  # Inicializo un vector vacío

for i in range(1,tamaño+1):  # Recorro segun el tamaño del vector
    vector.append(i*20) #Lleno el vector con multiplos de 20

print("[yellow]Responda con un (si) o con un (no)[/]")
print(f"[violet]El vector es: {vector}[/]")


while True: #inicio un ciclo while para manejar sino se ingresa si o no
    prom = console.input(f"[blue]Desea promediar el vector?: [/]") #y le agregamos console al input
    if prom == "si":
        promedio = sum(vector)/tamaño
        print(f"[blue]El promedio del vector es: {promedio} [/]")
        break
    elif prom == "no":
        break
    else:
        print("[red]Valor incorrecto[/]") #en caso de que no se cumpla si o no, se repetira el ciclo

        
while True: #inicio un ciclo while para manejar sino se ingresa si o no
    suma = console.input(f"[blue]Desea sumar el vector?: [/]") #y le agregamos console al input
    if suma == "si":
        sumaf= sum(vector)
        print(f"[blue]La suma del vector es: {sumaf} [/]")
        break
    elif suma == "no":
        break
    else:
        print("[red]Valor incorrecto[/]") #en caso de que no se cumpla si o no, se repetira el ciclo
      
while True: #inicio un ciclo while para manejar sino se ingresa si o no
    division = console.input(f"[blue]Desea dividir cada posicion por 2 ?: [/]") #y le agregamos console al input
    if division == "si":
        for i in range(len(vector)): #con un ciclo dividimos cada posicion
            resultado = vector[i] / 2
            print(f"Posición {i}: {vector[i]} / 2 = {resultado}")
        break
    elif division == "no":
        break
    else:
        print("[red]Valor incorrecto[/]") #en caso de que no se cumpla si o no, se repetira el ciclo
        

    

      
  
    




        

    


