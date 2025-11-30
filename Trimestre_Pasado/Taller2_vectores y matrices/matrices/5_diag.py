# 5) Imprimir de la siguiente matriz la diagonal principal:
from rich import print
matriz = [
    [25, 12, 26, 7, 15],
    [12, 12, 2, 9, 25],
    [25, 6, 4, 25, 6],
    [1, 4, 6, 10, 9],
    [2, 25, 8, 5, 8]
        
]
for f, fila in enumerate(matriz):
    for c, elemento in enumerate(fila):
        if c == f:  #como se incrementa de a uno la columna en cada fila, entonces se van a pintar cuando estas dos sean iguales
            print(f"[red]{elemento:5}[/]", end="")
        else:
            print(f"{elemento:5}", end="") #agrego el :5 para que se vea mas ordenado
    print()

