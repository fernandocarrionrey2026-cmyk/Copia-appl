# Copias de páginas de inicio para WordPress

Este repositorio tiene dos temas de WordPress en español:

| Tema | Carpeta | Zip para instalar |
|------|---------|-------------------|
| Estilo apple.com/la | `tema-inicio-es` | `tema-inicio-es.zip` |
| Estilo asus.com/ec | `tema-asus-es` | `tema-asus-es.zip` |

Los dos se instalan y se editan igual (ver abajo). En el de ASUS, las imágenes recomendadas miden 1920 × 716 px (carrusel) y 1040 × 1020 px (cuadros).

## Tema estilo Apple

Tema de WordPress en español que recrea la página de inicio de apple.com/la:
barra de menú, franja de aviso, tres secciones grandes, cuadros en dos columnas
y pie de página. Es para un proyecto personal.

Vista previa: carpeta `capturas/`.

## Cómo instalarlo

1. Descarga el zip del tema que quieras.
2. En WordPress ve a **Apariencia → Temas → Añadir nuevo → Subir tema** y elige el zip.
3. Actívalo. La página de inicio se verá así automáticamente.

## Dónde cambiar las cosas

| Quiero cambiar…                     | Archivo                                   |
|-------------------------------------|-------------------------------------------|
| Títulos, textos, botones, secciones | `tema-inicio-es/inc/contenido-inicio.php` |
| Colores, tamaños de letra, espacios | `assets/css/inicio.css`    |
| Imágenes                            | Ponlas en `assets/img/`    |
| Menú de arriba                      | En WordPress: Apariencia → Menús          |
| Logo                                | En WordPress: Apariencia → Personalizar → Identidad del sitio |

Mientras no pongas imágenes, cada sección muestra un círculo de color de muestra.

## Nota

No se usaron los logos ni las fotos de Apple ni de ASUS (son de su propiedad); hay espacios
listos para poner las tuyas. Los textos siguen el estilo de la página original,
pero conviene compararlos con la página actual por si cambiaron.

## Tema ASUS: editar con clics (versión 1.1)

El tema `tema-asus-es` trae dos bloques para el editor de WordPress:
**Carrusel ASUS** y **Cuadros ASUS**, y el patrón **Página de inicio ASUS**.

- Al instalarlo, crea la página **Inicio** con el carrusel y los cuadros y,
  si tu portada mostraba las últimas entradas, la deja como página de inicio.
- Para cambiar textos, enlaces y fotos: **Pages → Inicio**, haz clic en el
  bloque y usa el panel de la derecha. Al final pulsa **Save**.
- Para usarlos en otras páginas: botón **+** del editor → busca «ASUS».
- La franja de aviso, el menú lateral y el pie se siguen cambiando en
  `inc/contenido-inicio.php`.

Guía con imágenes: `capturas/asus-como-editar-con-clics.png`.
