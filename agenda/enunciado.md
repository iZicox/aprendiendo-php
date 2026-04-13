Desarrollar una aplicación agenda ABM/CRUD en php.

Divide la aplicación en los siguientes archivos php:

    CategariaListado: que muestre un listado de las categorías que hay en la BD.
    CategoriaEliminar: permitirá eliminar una categoría.
    categoriaFicha: En el caso de que no exista una categoría, devolverá al usuario un formulario para que la pueda crear.
    CategoriaGuardar: recoge los datos de una categoría y permite actualizarlos.
    PersonaEliminar
    PersonaFicha
    PersonaGuardar
    PersonaListado
    Varios: incluye funciones que utilizarán el resto de los archivos php.

Crea una BD agenda que tenga 2 tablas:

    persona: ID (PK), nombre, apellidos, teléfono, categoría ID.
    categoria: categoría ID, categoriaNombre.
