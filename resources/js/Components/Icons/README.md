# Componentes SVG con Tailwind CSS

Este directorio contiene componentes Vue reutilizables para iconos SVG que se integran perfectamente con Tailwind CSS.

## Estructura

```
Components/Icons/
├── index.js                 # Exportaciones principales
├── SvgIcon.vue             # Componente wrapper genérico
├── HouseIcon.vue           # Icono de casa
├── BackpackIcon.vue        # Icono de mochila
├── SchoolIcon.vue          # Icono de escuela
├── PersonsIcon.vue         # Icono de personas
├── EditIcon.vue            # Icono de edición
├── PlusIcon.vue            # Icono de plus/agregar
├── CheckIcon.vue           # Icono de check/confirmar
├── ChevronLeftIcon.vue     # Flecha izquierda
├── ChevronRightIcon.vue    # Flecha derecha
├── ChevronDownIcon.vue     # Flecha abajo
├── MenuIcon.vue            # Icono de menú hamburguesa
├── CalendarIcon.vue        # Icono de calendario
└── ExclamationIcon.vue     # Icono de exclamación
```

## Uso Básico

### Importación Individual

```vue
<template>
  <HouseIcon class="w-6 h-6 text-blue-500" />
</template>

<script setup>
  import { HouseIcon } from "@/Components/Icons";
</script>
```

### Usando el Componente Genérico SvgIcon

```vue
<template>
  <SvgIcon
    name="house"
    :size="24"
    class="text-blue-500" />
</template>

<script setup>
  import { SvgIcon } from "@/Components/Icons";
</script>
```

## Props Disponibles

### Iconos Individuales

Cada componente de icono acepta las siguientes props:

- **`width`** (String|Number): Ancho del icono (default: valor específico del icono)
- **`height`** (String|Number): Alto del icono (default: valor específico del icono)
- **`class`** (String|Array|Object): Clases CSS adicionales
- **`fillColor`** (String): Color de relleno para iconos filled (default: 'currentColor')
- **`strokeColor`** (String): Color de trazo para iconos outlined (default: 'currentColor')
- **`strokeWidth`** (String|Number): Grosor del trazo (default: específico del icono)

### Componente SvgIcon

- **`name`** (String, requerido): Nombre del icono
- **`size`** (String|Number): Tamaño del icono (default: 24)
- **`color`** (String): Color del icono (default: 'currentColor')
- **`class`** (String|Array|Object): Clases CSS adicionales
- **`strokeWidth`** (String|Number): Grosor del trazo (default: '2')
- **`colorType`** (String): Tipo de color - 'stroke' o 'fill' (default: 'stroke')

## Ejemplos de Uso

### Con Colores de Tailwind

```vue
<!-- Diferentes colores -->
<HouseIcon class="w-6 h-6 text-blue-500" />
<HouseIcon class="w-6 h-6 text-red-500" />
<HouseIcon class="w-6 h-6 text-green-500" />

<!-- Con hover effects -->
<HouseIcon
  class="w-6 h-6 text-gray-400 hover:text-blue-500 transition-colors" />
```

### Diferentes Tamaños

```vue
<!-- Usando clases de Tailwind -->
<HouseIcon class="w-4 h-4 text-gray-600" />
<!-- 16px -->
<HouseIcon class="w-6 h-6 text-gray-600" />
<!-- 24px -->
<HouseIcon class="w-8 h-8 text-gray-600" />
<!-- 32px -->
<HouseIcon class="w-12 h-12 text-gray-600" />
<!-- 48px -->

<!-- Usando props -->
<HouseIcon :width="16" :height="16" class="text-gray-600" />
```

### En Botones

```vue
<button
  class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
  <PlusIcon class="w-4 h-4 mr-2" />
  Agregar Programa
</button>
```

### En Navegación

```vue
<nav class="flex space-x-1">
  <a href="#" class="flex items-center px-3 py-2 text-white bg-blue-500 rounded-md">
    <HouseIcon class="w-4 h-4 mr-2" />
    Dashboard
  </a>
  <a href="#" class="flex items-center px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md">
    <BackpackIcon class="w-4 h-4 mr-2" stroke-color="currentColor" />
    Programas
  </a>
</nav>
```

### Estados Activos

```vue
<template>
  <nav>
    <NavLink
      :href="route('admin.dashboard')"
      :active="route().current('admin.dashboard')"
      class="block px-4 py-2">
      <HouseIcon
        class="w-6 h-6 transition-colors"
        :class="
          route().current('admin.dashboard') ? 'text-blue-500' : 'text-gray-400'
        " />
    </NavLink>
  </nav>
</template>
```

## Iconos Disponibles

| Nombre          | Componente         | Tipo   | Uso                   |
| --------------- | ------------------ | ------ | --------------------- |
| `house`         | `HouseIcon`        | fill   | Dashboard/Inicio      |
| `backpack`      | `BackpackIcon`     | stroke | Programas             |
| `school`        | `SchoolIcon`       | stroke | Escuela/Educación     |
| `persons`       | `PersonsIcon`      | stroke | Usuarios/Personas     |
| `edit`          | `EditIcon`         | fill   | Edición/Configuración |
| `plus`          | `PlusIcon`         | fill   | Agregar/Crear         |
| `check`         | `CheckIcon`        | fill   | Confirmar/Éxito       |
| `chevron-left`  | `ChevronLeftIcon`  | stroke | Navegación izquierda  |
| `chevron-right` | `ChevronRightIcon` | stroke | Navegación derecha    |
| `chevron-down`  | `ChevronDownIcon`  | fill   | Dropdown/Expandir     |
| `menu`          | `MenuIcon`         | stroke | Menú hamburguesa      |
| `calendar`      | `CalendarIcon`     | stroke | Fechas/Calendario     |
| `exclamation`   | `ExclamationIcon`  | fill   | Alerta/Advertencia    |

## Personalización

### Crear Nuevos Iconos

1. Crear un nuevo archivo `.vue` en el directorio `Icons/`
2. Seguir la estructura de componentes existentes
3. Agregar la exportación en `index.js`
4. Agregar el mapeo en `SvgIcon.vue` si es necesario

### Ejemplo de Nuevo Icono

```vue
<!-- UserIcon.vue -->
<template>
  <svg
    :width="width"
    :height="height"
    :class="classes"
    viewBox="0 0 24 24"
    fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <path
      stroke-linecap="round"
      stroke-linejoin="round"
      :stroke-width="strokeWidth"
      :stroke="strokeColor"
      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
  </svg>
</template>

<script setup>
  import { computed } from "vue";

  const props = defineProps({
    width: { type: [String, Number], default: 24 },
    height: { type: [String, Number], default: 24 },
    strokeColor: { type: String, default: "currentColor" },
    strokeWidth: { type: [String, Number], default: "2" },
    class: { type: [String, Array, Object], default: "" }
  });

  const classes = computed(() => {
    const baseClasses = "inline-block";
    return typeof props.class === "string"
      ? `${baseClasses} ${props.class}`.trim()
      : [baseClasses, props.class];
  });
</script>
```

## Mejores Prácticas

1. **Usa `currentColor`** para permitir que los iconos hereden el color del texto
2. **Aplica transiciones** para estados hover: `transition-colors`
3. **Mantén la consistencia** en tamaños dentro de la misma interfaz
4. **Usa el componente genérico `SvgIcon`** para casos simples
5. **Prefiere componentes individuales** cuando necesites más control

## Integración con AdminLayout

El `AdminLayout.vue` ha sido actualizado para usar estos componentes SVG:

```vue
<template>
  <nav class="mt-4">
    <NavLink
      :href="route('admin.dashboard')"
      class="block px-4 py-2">
      <HouseIcon
        class="w-7 h-7 transition-colors"
        :class="
          route().current('admin.dashboard') ? 'text-blue-500' : 'text-gray-400'
        " />
    </NavLink>
    <!-- más enlaces... -->
  </nav>
</template>
```

## Ventajas de Este Enfoque

- ✅ **Totalmente personalizable** con Tailwind CSS
- ✅ **Mejor rendimiento** que imágenes SVG
- ✅ **Type-safe** con TypeScript (si se usa)
- ✅ **Consistent** con el sistema de diseño
- ✅ **Fácil mantenimiento** y actualización
- ✅ **Tree-shaking** automático
- ✅ **Responsive** y escalable
