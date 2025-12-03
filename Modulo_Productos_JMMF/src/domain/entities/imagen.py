class Imagen:
    """
    Entidad Imagen - Representa una imagen del producto
    Relación de COMPOSICIÓN con Producto
    """
    
    def __init__(self, id: int, producto_id: int, ruta_imagen: str,
                 alt_text: str, principal: bool = False, orden: int = 0):
        self._id = id
        self._producto_id = producto_id
        self._ruta_imagen = ruta_imagen
        self._alt_text = alt_text
        self._principal = principal
        self._orden = orden
        self._fecha_carga = datetime.now()
        
        self._validar()
    
    def _validar(self):
        """Validaciones de imagen"""
        # Validar formato (RN-013)
        formatos_validos = ['.jpg', '.jpeg', '.png']
        if not any(self._ruta_imagen.lower().endswith(fmt) for fmt in formatos_validos):
            raise ValueError("Formato de imagen inválido. Permitidos: JPG, PNG")
        
        if not self._alt_text:
            raise ValueError("El texto alternativo es obligatorio para accesibilidad")
    
    @property
    def id(self) -> int:
        return self._id
    
    @property
    def ruta_imagen(self) -> str:
        return self._ruta_imagen
    
    @property
    def alt_text(self) -> str:
        return self._alt_text
    
    @property
    def principal(self) -> bool:
        return self._principal
    
    @property
    def orden(self) -> int:
        return self._orden
    
    def marcar_como_principal(self) -> None:
        """Marca esta imagen como principal"""
        self._principal = True
    
    def desmarcar_principal(self) -> None:
        """Desmarca esta imagen como principal"""
        self._principal = False
    
    def obtener_info(self) -> dict:
        return {
            'id': self._id,
            'ruta': self._ruta_imagen,
            'alt_text': self._alt_text,
            'principal': self._principal,
            'orden': self._orden
        }
    
    def __str__(self) -> str:
        tipo = "Principal" if self._principal else "Secundaria"
        return f"Imagen({tipo}, orden={self._orden})"
