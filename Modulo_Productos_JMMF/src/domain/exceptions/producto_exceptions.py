class ProductoException(Exception):
    """Excepción base para errores de productos"""
    pass

class ProductoNoEncontradoException(ProductoException):
    """Se lanza cuando no se encuentra un producto"""
    pass

class ProductoNoDisponibleException(ProductoException):
    """Se lanza cuando un producto no está disponible"""
    pass

class ConfiguracionIncompletaException(ProductoException):
    """Se lanza cuando la configuración del producto está incompleta"""
    pass

class StockInsuficienteException(ProductoException):
    """Se lanza cuando no hay suficiente stock"""
    pass

class LimiteExcedidoException(ProductoException):
    """Se lanza cuando se excede un límite"""
    pass

