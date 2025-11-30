# 10) Leer una secuencia de números, hasta que se introduce un número
# negativo y mostrar la suma de dichos números.
from rich import print #importo una libreria para agregar colores
vector = []

num = 1
contador = 0
while True:
    num = float(input("Ingresa un número: "))
    if num <=0:
        break
    else:
        vector.append(num)
        contador += 1
    
suma = sum(vector)
print(f"[green]Vector: {vector}[/]")
print(f"[blue]La suma de los {contador} números introducidos es: {suma} [/]")