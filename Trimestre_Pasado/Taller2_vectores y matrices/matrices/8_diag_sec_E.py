# 8). De una matriz 5*5 llenar la diagonal segundaria con la letra E:

from rich import print
matriz = [
    [25, 12, 26, 7, 15],
    [12, 12, 2, 9, 25],
    [25, 6, 4, 25, 6],
    [1, 4, 6, 10, 9],
    [2, 25, 8, 5, 8]
        
]

contador = 4
for f, fila in enumerate(matriz):
    for c, elemento in enumerate(fila):
        if c == contador: #como ya toca ir para atras entonces ahi si toca agregar un contador pero va restando de uno
            matriz[f][c] = "E" #introduzo la e en la matriz
            print(f"[red]{matriz[f][c]:^5}[/]", end="")
        else:
            print(f"{elemento:^5}", end="") #agrego el :^5 para que se vea mas ordenado
    contador -= 1
    print()

