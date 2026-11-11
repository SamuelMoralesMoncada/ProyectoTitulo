# 📱 Instalar el Contador de Amandita en iPhone

En iPhone **no se puede abrir un archivo `.html` descargado** como una página que funcione
(la app Archivos y WhatsApp solo muestran una vista previa, sin botones activos). Por eso la app
se publica gratis con **GitHub Pages** y se abre desde una dirección web en **Safari**.

## Paso 1 — Publicar la app (una sola vez, desde el computador)

1. Entra a https://github.com/SamuelMoralesMoncada/ProyectoTitulo/settings/pages
2. En **Build and deployment → Source** elige **Deploy from a branch**.
3. En **Branch** elige `claude/contraction-counter-app-6h28jd` y carpeta **/ (root)**. Presiona **Save**.
4. Espera 1–3 minutos y recarga la página: aparecerá *"Your site is live at …"*.

La app quedará en:

**https://samuelmoralesmoncada.github.io/ProyectoTitulo/contador-contracciones/**

## Paso 2 — Crear el ícono tipo app en el iPhone

1. Abre el enlace de arriba en **Safari** (tiene que ser Safari; en Chrome de iPhone también
   funciona en iOS 16.4+, pero Safari es lo más seguro).
2. Toca el botón **Compartir** (cuadrado con flecha hacia arriba ⬆️, abajo al centro).
3. Desliza hacia abajo y toca **"Agregar a pantalla de inicio"**.
   *Si no aparece:* baja hasta el final, toca **"Editar acciones…"** y agrégala.
4. Deja el nombre **Amandita** y toca **Agregar**.

Aparecerá un ícono rosado con un 🍼 que se abre a pantalla completa, como una app.

> ⚠️ **Usen siempre el ícono de la pantalla de inicio.** En iPhone, el ícono y Safari guardan
> los datos por separado: lo registrado en el ícono no se ve en Safari y viceversa.

## Paso 3 — Guardar respaldos en una carpeta

1. En la app, sección **💾 Respaldo de los datos**, toca **💾 Guardar respaldo**.
2. Se abre el menú Compartir: toca **"Guardar en Archivos"**.
3. Elige la carpeta (por ejemplo, crea **iCloud Drive → Amandita**) y toca **Guardar**.

Se guarda un archivo como `respaldo_amandita_2026-11-11_0310.json`. Si está en **iCloud Drive**,
queda respaldado en la nube y también se puede ver desde otro iPhone o el computador.
También se puede enviar por WhatsApp o correo desde ese mismo menú.

## Restaurar un respaldo (por ejemplo, en otro iPhone)

1. Toca **📂 Restaurar respaldo** → **Explorar** → busca la carpeta **Amandita**.
2. Elige el archivo `.json` más reciente. Las contracciones se agregan sin duplicarse.
