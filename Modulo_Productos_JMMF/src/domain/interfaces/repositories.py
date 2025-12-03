from abc import ABC, abstractmethod
from typing import List, Optional

class ProductoRepository(ABC):
    """Interfaz para el repositorio de productos"""
    
    @abstractmethod
    def guardar(self, producto: Producto) -> None:
        """Guarda un producto"""
        pass
    
    @abstractmethod
    def buscar_por_id(self, id: int) -> Optional[Producto]:
        """Busca un producto por ID"""
        pass
    
    @abstractmethod
    def buscar_todos(self) -> List[Producto]:
        """Retorna todos los productos"""
        pass
    
    @abstractmethod
    def buscar_por_nombre(self, nombre: str) -> List[Producto]:
        """Busca productos por nombre"""
        pass
    
    @abstractmethod
    def buscar_aprobados(self) -> List[Producto]:
        """Retorna productos aprobados para catálogo"""
        pass
    
    @abstractmethod
    def eliminar(self, id: int) -> bool:
        """Elimina (desactiva) un producto"""
        pass


class CategoriaRepository(ABC):
    """Interfaz para el repositorio de categorías"""
    
    @abstractmethod
    def guardar(self, categoria: Categoria) -> None:
        pass
    
    @abstractmethod
    def buscar_por_id(self, id: int) -> Optional[Categoria]:
        pass
    
    @abstractmethod
    def buscar_todas(self) -> List[Categoria]:
        pass
    
    @abstractmethod
    def eliminar(self, id: int) -> bool:
        pass
