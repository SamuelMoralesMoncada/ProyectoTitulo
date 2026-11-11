# Contador de contracciones de Amandita 🍼

Aplicación web de un solo archivo (`index.html`) para registrar contracciones durante el embarazo.
No necesita servidor ni internet: basta con abrir el archivo en el navegador del celular o computador.

## Funciones

- **Botón grande** para iniciar / terminar cada contracción, con cronómetro en vivo.
- **Duración** de cada contracción (inicio → fin).
- **Frecuencia** (tiempo entre el inicio de una contracción y el inicio de la anterior).
- **Intensidad**: al terminar cada contracción se elige Leve / Moderada / Fuerte.
- **Resumen por periodo** (30 min, 1 hora, 2 horas o todo): cantidad de contracciones,
  duración promedio, frecuencia promedio e intensidad promedio.
- **Aviso 5-1-1**: alerta cuando en la última hora las contracciones ocurren cada ~5 minutos
  o menos y duran 1 minuto o más.
- Historial con opción de eliminar registros, **exportar a CSV** (abre en Excel) y borrar todo.
- Los datos se guardan en el navegador (`localStorage`), así que no se pierden al recargar.

## Uso en el celular

1. Abrir `index.html` en el navegador (o publicarlo en cualquier hosting estático, p. ej. GitHub Pages).
2. Opcional: "Agregar a pantalla de inicio" para usarlo como una app.

> Esta herramienta es sólo de apoyo y no reemplaza la indicación de la matrona o el médico.
