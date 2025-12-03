class Categoria:
    """
    Entidad Categoria - Para organizar productos
    Relación de AGREGACIÓN con Producto (puede existir sin productos)
    """
    
    def __init__(self, id: int, nombre: str, descripcion: str = ""):
        self._id = id
        self._nombre = nombre
        self._descripcion = descripcion
        self._activo = True
        
        self._validar()
    
    def _validar(self):
        if not self._nombre or len(self._nombre.strip()) == 0:
            raise ValueError("El nombre de la categoría es obligatorio")
        
        if len(self._nombre) > 100:
            raise ValueError("El nombre no puede exceder 100 caracteres")
    
    @property
    def id(self) -> int:
        return self._id
    
    @property
    def nombre(self) -> str:
        return self._nombre
    
    @property
    def descripcion(self) -> str:
        return self._descripcion
    
    @property
    def activo(self) -> bool:
        return self._activo
    
    def activar(self) -> None:
        self._activo = True
    
    def desactivar(self) -> None:
        self._activo = False
    
    def actualizar(self, nombre: str = None, descripcion: str = None) -> None:
        if nombre:
            if len(nombre) > 100:
                raise ValueError("El nombre no puede exceder 100 caracteres")
            self._nombre = nombre
        
        if descripcion is not None:
            self._descripcion = descripcion
    
    def obtener_info(self) -> dict:
        return {
            'id': self._id,
            'nombre': self._nombre,
            'descripcion': self._descripcion,
            'activo': self._activo
        }
    
    def __str__(self) -> str:
        return f"Categoria(id={self._id}, nombre='{self._nombre}')"
