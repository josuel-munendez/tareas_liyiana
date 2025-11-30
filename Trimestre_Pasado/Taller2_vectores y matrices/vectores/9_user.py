# 9) Llenar un vector de 30 números por el usuario, donde saque promedio de los
# números, diga el menor, el mayor y los que son múltiplos de 2.
tamaño = 5
vector = []
from rich import print #importo una libreria para agregar colores

for i in range(tamaño):
    llenar= int(input(f"Llena la posicion {i}: "))
    vector.append(llenar) #el usuario llena la lista
    
#se hacen las operaciones    
promedio = sum(vector)/tamaño 
mayor = max(vector) 
menor = min(vector)
print(f"[red]El mayor es: {mayor}[/]")
print(f"[green]El menor es: {menor}[/]")

print(f"[yellow]Los números que son múltiplos de 2 son:[/]")
#utilizo el modulo para los multiplos, ya que los pares son multiplos de 2
for m in range(len(vector)):
    if vector[m] % 2 == 0 :
        print(f"[blue]posicion: {m} - Valor: {vector[m]}[/] ")