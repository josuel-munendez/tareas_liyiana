usuarios = {}
productos = {}
inventario = {}


def crear_usuario(uid, nombre, rol):
    usuarios[uid] = {"nombre": nombre, "rol": rol}

def leer_usuario(uid):
    return usuarios.get(uid, "No encontrado")

def actualizar_usuario(uid, nombre=None, rol=None):
    if uid in usuarios:
        if nombre: usuarios[uid]["nombre"] = nombre
        if rol: usuarios[uid]["rol"] = rol
    else:
        print("Usuario no existe")

def eliminar_usuario(uid):
    usuarios.pop(uid, None)

def crear_producto(pid, nombre, precio):
    productos[pid] = {"nombre": nombre, "precio": precio}

def leer_producto(pid):
    return productos.get(pid, "No encontrado")

def actualizar_producto(pid, nombre=None, precio=None):
    if pid in productos:
        if nombre: productos[pid]["nombre"] = nombre
        if precio: productos[pid]["precio"] = precio

def eliminar_producto(pid):
    productos.pop(pid, None)

def agregar_inventario(iid, pid, stock):
    inventario[iid] = {"producto_id": pid, "stock": stock}

def leer_inventario(iid):
    return inventario.get(iid, "No encontrado")

def actualizar_inventario(iid, stock=None):
    if iid in inventario:
        if stock is not None: inventario[iid]["stock"] = stock

def eliminar_inventario(iid):
    inventario.pop(iid, None)


crear_usuario(1, "Carlos", "cliente")
crear_producto(10, "Camiseta básica", 15.99)
agregar_inventario(100, 10, 50)

print(leer_usuario(1))
print(leer_producto(10))
print(leer_inventario(100))
