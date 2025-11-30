# 11) Leer una secuencia de números y mostrar su producto, el proceso finalizará
# cuando el usuario pulsa la tecla n

from rich import print #importo una libreria para agregar colores
vector = []

num = 1
contador = 0
while True:
    num = input("Ingresa un número: ")
    # primero recibe los datos tipo string para verificar
    if num == "n":
        break
    else: # en caso no convierte el numero tipo string en un float y lo agrega a la lista
        vectoren = float(num)
        vector.append(vectoren)
        contador += 1
    

multi = 1 
for i in range(len(vector)):#multiplicamos cada elemento del vector
    num_vec = vector[i]
    multi *= num_vec
    
    
print(f"[green]Vector: {vector}[/]")
print(f"[blue]La multiplicación de los {contador} números introducidos es: {multi} [/]")