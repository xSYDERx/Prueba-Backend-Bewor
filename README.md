# Prueba Técnica Backend - Laravel con Arquitectura Hexagonal para Óptima Cultura

## Descripción

Esta es una prueba técnica para evaluar habilidades en el desarrollo backend utilizando PHP y el framework Laravel, implementando una arquitectura hexagonal (Hexagonal Architecture). El proyecto incluye la entidad de dominio `Company` como ejemplo, separando claramente las capas de aplicación, dominio e infraestructura. Se espera que el candidato complete los ejercicios propuestos, implemente funcionalidades adicionales y valide los cambios mediante pruebas unitarias y de integración.

## Tecnologías Utilizadas

- **PHP 8.4**: Lenguaje de programación principal.
- **Laravel**: Framework PHP para desarrollo web.
- **Arquitectura Hexagonal**: Patrón de diseño que separa la lógica de negocio de las interfaces externas.
- **MySQL/MariaDB**: Base de datos relacional.
- **Composer**: Gestor de dependencias para PHP.
- **PHPUnit**: Framework para pruebas unitarias.


## Ejercicios

Completa los siguientes ejercicios para demostrar tus habilidades:

- Agregar las propiedades `email` y `address` al modelo de dominio de compañías (`Company`).
- Crear un nuevo caso de uso para actualizar el estado de una compañía de `inactive` a `active`.
- Crear un nuevo endpoint de API que actualice el estado utilizando el caso de uso del punto anterior.
- Crear un nuevo caso de uso que liste todas las compañías.
- Crear un nuevo endpoint de API que liste las compañías basado en el caso de uso del punto anterior.
- Crear los tests necesarios para validar los cambios realizados.
- Asegurarse de que todos los tests pasen después de realizar los cambios.
- **Opcional:** Implementa cualquier otra entidad de dominio que consideres relevante.

## Notas y recomendaciones

- Revisa el código existente para entender la estructura y las convenciones utilizadas.
- Mantén la coherencia con el estilo de codificación y las convenciones del proyecto.
- Aplica los principios SOLID y las mejores prácticas de diseño de software.
- Aplica API RESTful para la creación de endpoints.
- Utiliza inyección de dependencias.
- El proyecto no incluye vistas de frontend, es solo una API.
- Si deseas añadir alguna vista, puedes hacerlo, pero no es obligatorio, no se evaluará el diseño frontend.
- Si deseas añadir alguna funcionalidad adicional que consideres relevante, puedes hacerlo, siéntete libre de hacerlo.
- Revisa los tests antes y después de realizar los cambios.
- El proyecto incluye un archivo `docker-compose.yml` para facilitar la configuración del entorno de desarrollo utilizando contenedores Docker, puedes usarlo si lo deseas.
- Si tienes alguna duda, contacta a Óptima Cultura a través del email proporcionado.

-----------------------------

## Resolución

- Se han creado los arhivos CompanyEmail.php y CompanyAddress.php para agregar las propiedades que dan nombre a los archivos.
- Creados los casos de uso, con nombre de archivo EnableCompany y ListCompany, además de el caso de uso adicional (APARTADO OPCIONAL) para también poder desactivar compañias, con nombre de archivo DisableCompany. Este ultimo, usa la misma logica que el de activar una compañia, pero en lugar de cambiar el estado de 1 (inactiva) a 2 (activa), lo hace al revés [un caso de uso algo sencillo pero que veía conveniente su implementación].
- Creados los tests para los casos de uso anteriores.
- Creados los endpoints de la API para los casos de uso EnableCompany, DisableCompany, y ListCompany.
- Creados los tests para comprobar que los endpoints de la API funcionen correctamente.
