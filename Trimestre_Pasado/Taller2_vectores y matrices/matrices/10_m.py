# 9) realizar un algoritmo que sea capaz de mover una m gigante hasta desaparecer
from rich import print
matriz = [
    [0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0]
]

contador = 0 #se me ocurrio usar un contador y encerrando en un ciclo, como cada elemento se va corriendo de a uno
for i in range(8):#tiene 7 columnas entonces se va a repetir hasta que llegue 8 y desaparezca, ya que no va a encontrar es fila o columna
    
    for f, filas in enumerate(matriz):# imprimo normal la matriz y solo dibujo la m
        for c, element in enumerate(filas):
            if c == (0+contador):#solo agrego el contador para que se sume
                print(f"[red]{element:5}[/]", end="")
                
            elif c == (1+contador):
                if f == 1:#aqui no aplica porque siempre va a ser la fila 1
                    print(f"[red]{element:5}[/]", end="")
                else:
                    print(f"{element:5}", end="")
            elif c == (2+contador):
                    print(f"[red]{element:5}[/]", end="")
                
   
            else:
                print(f"{element:5}", end="")
        print()#separo las listas
    contador += 1#añado el contador
    print()#separo para que no se vea todo junto
        

        
    