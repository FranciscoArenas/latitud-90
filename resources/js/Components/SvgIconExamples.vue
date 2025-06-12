<template>
  <div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto">
      <h1 class="text-3xl font-bold text-gray-900 mb-8">
        Uso del Componente SvgIcon
      </h1>

      <!-- Ejemplo básico -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Uso Básico</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
          <div class="flex flex-col items-center">
            <SvgIcon
              name="house"
              :size="32"
              class="text-blue-500 mb-2" />
            <code class="text-xs bg-gray-100 px-2 py-1 rounded"
              >name="house"</code
            >
          </div>
          <div class="flex flex-col items-center">
            <SvgIcon
              name="backpack"
              :size="32"
              class="text-green-500 mb-2"
              color-type="stroke" />
            <code class="text-xs bg-gray-100 px-2 py-1 rounded"
              >name="backpack"</code
            >
          </div>
          <div class="flex flex-col items-center">
            <SvgIcon
              name="school"
              :size="32"
              class="text-purple-500 mb-2"
              color-type="stroke" />
            <code class="text-xs bg-gray-100 px-2 py-1 rounded"
              >name="school"</code
            >
          </div>
          <div class="flex flex-col items-center">
            <SvgIcon
              name="persons"
              :size="32"
              class="text-red-500 mb-2"
              color-type="stroke" />
            <code class="text-xs bg-gray-100 px-2 py-1 rounded"
              >name="persons"</code
            >
          </div>
          <div class="flex flex-col items-center">
            <SvgIcon
              name="edit"
              :size="32"
              class="text-orange-500 mb-2"
              color-type="fill" />
            <code class="text-xs bg-gray-100 px-2 py-1 rounded"
              >name="edit"</code
            >
          </div>
        </div>
      </div>

      <!-- Ejemplos con diferentes tamaños -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
          Diferentes Tamaños
        </h2>
        <div class="flex items-center justify-around">
          <div class="text-center">
            <SvgIcon
              name="check"
              :size="16"
              class="text-green-500 mb-2" />
            <code class="text-xs bg-gray-100 px-2 py-1 rounded"
              >:size="16"</code
            >
          </div>
          <div class="text-center">
            <SvgIcon
              name="check"
              :size="24"
              class="text-green-500 mb-2" />
            <code class="text-xs bg-gray-100 px-2 py-1 rounded"
              >:size="24"</code
            >
          </div>
          <div class="text-center">
            <SvgIcon
              name="check"
              :size="32"
              class="text-green-500 mb-2" />
            <code class="text-xs bg-gray-100 px-2 py-1 rounded"
              >:size="32"</code
            >
          </div>
          <div class="text-center">
            <SvgIcon
              name="check"
              :size="48"
              class="text-green-500 mb-2" />
            <code class="text-xs bg-gray-100 px-2 py-1 rounded"
              >:size="48"</code
            >
          </div>
        </div>
      </div>

      <!-- Ejemplos en botones -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">En Botones</h2>
        <div class="space-y-4">
          <button
            class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
            <SvgIcon
              name="plus"
              :size="16"
              class="mr-2" />
            Agregar Programa
          </button>

          <button
            class="flex items-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors">
            <SvgIcon
              name="check"
              :size="16"
              class="mr-2" />
            Confirmar Inscripción
          </button>

          <button
            class="flex items-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
            <SvgIcon
              name="chevron-left"
              :size="16"
              class="mr-2" />
            Volver
          </button>
        </div>
      </div>

      <!-- Navegación simplificada -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
          Navegación Simplificada
        </h2>
        <nav class="flex space-x-1">
          <a
            href="#"
            class="flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-500 rounded-md">
            <SvgIcon
              name="house"
              :size="16"
              class="mr-2 text-white" />
            Dashboard
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
            <SvgIcon
              name="backpack"
              :size="16"
              class="mr-2"
              color-type="stroke" />
            Programas
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
            <SvgIcon
              name="school"
              :size="16"
              class="mr-2"
              color-type="stroke" />
            Pasajeros
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
            <SvgIcon
              name="persons"
              :size="16"
              class="mr-2"
              color-type="stroke" />
            Pagos
          </a>
        </nav>
      </div>

      <!-- Ejemplos de código -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
          Ejemplos de Código
        </h2>
        <div class="space-y-4">
          <div class="bg-gray-100 p-4 rounded-md">
            <h3 class="font-medium text-gray-800 mb-2">Icono básico:</h3>
            <code class="text-sm text-gray-700">
              &lt;SvgIcon name="house" :size="24" class="text-blue-500" /&gt;
            </code>
          </div>

          <div class="bg-gray-100 p-4 rounded-md">
            <h3 class="font-medium text-gray-800 mb-2">Icono con stroke:</h3>
            <code class="text-sm text-gray-700">
              &lt;SvgIcon name="backpack" :size="32" class="text-green-500"
              color-type="stroke" /&gt;
            </code>
          </div>

          <div class="bg-gray-100 p-4 rounded-md">
            <h3 class="font-medium text-gray-800 mb-2">Icono en botón:</h3>
            <code class="text-sm text-gray-700">
              &lt;button class="flex items-center px-4 py-2 bg-blue-500
              text-white rounded-md"&gt;<br />
              &nbsp;&nbsp;&lt;SvgIcon name="plus" :size="16" class="mr-2"
              /&gt;<br />
              &nbsp;&nbsp;Agregar<br />
              &lt;/button&gt;
            </code>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { SvgIcon } from "@/Components/Icons";
</script>
