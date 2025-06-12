<template>
  <div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto">
      <h1 class="text-3xl font-bold text-gray-900 mb-8">
        Ejemplos de Iconos SVG con Tailwind CSS
      </h1>

      <!-- Sección de Iconos Básicos -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Iconos Básicos</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
          <div class="flex flex-col items-center">
            <HouseIcon class="w-8 h-8 text-gray-600 mb-2" />
            <span class="text-sm text-gray-500">House</span>
          </div>
          <div class="flex flex-col items-center">
            <BackpackIcon
              class="w-8 h-8 text-gray-600 mb-2"
              stroke-color="currentColor" />
            <span class="text-sm text-gray-500">Backpack</span>
          </div>
          <div class="flex flex-col items-center">
            <SchoolIcon
              class="w-8 h-8 text-gray-600 mb-2"
              stroke-color="currentColor" />
            <span class="text-sm text-gray-500">School</span>
          </div>
          <div class="flex flex-col items-center">
            <PersonsIcon
              class="w-8 h-8 text-gray-600 mb-2"
              stroke-color="currentColor" />
            <span class="text-sm text-gray-500">Persons</span>
          </div>
          <div class="flex flex-col items-center">
            <EditIcon
              class="w-8 h-8 text-gray-600 mb-2"
              fill-color="currentColor" />
            <span class="text-sm text-gray-500">Edit</span>
          </div>
        </div>
      </div>

      <!-- Sección de Colores -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
          Variaciones de Color
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
          <div class="flex flex-col items-center">
            <HouseIcon class="w-8 h-8 text-blue-500 mb-2" />
            <span class="text-sm text-gray-500">Azul</span>
          </div>
          <div class="flex flex-col items-center">
            <HouseIcon class="w-8 h-8 text-green-500 mb-2" />
            <span class="text-sm text-gray-500">Verde</span>
          </div>
          <div class="flex flex-col items-center">
            <HouseIcon class="w-8 h-8 text-red-500 mb-2" />
            <span class="text-sm text-gray-500">Rojo</span>
          </div>
          <div class="flex flex-col items-center">
            <HouseIcon class="w-8 h-8 text-yellow-500 mb-2" />
            <span class="text-sm text-gray-500">Amarillo</span>
          </div>
          <div class="flex flex-col items-center">
            <HouseIcon class="w-8 h-8 text-purple-500 mb-2" />
            <span class="text-sm text-gray-500">Púrpura</span>
          </div>
          <div class="flex flex-col items-center">
            <HouseIcon class="w-8 h-8 text-pink-500 mb-2" />
            <span class="text-sm text-gray-500">Rosa</span>
          </div>
        </div>
      </div>

      <!-- Sección de Tamaños -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
          Variaciones de Tamaño
        </h2>
        <div class="flex items-center justify-around">
          <div class="flex flex-col items-center">
            <BackpackIcon
              class="w-4 h-4 text-teal-500 mb-2"
              stroke-color="currentColor" />
            <span class="text-sm text-gray-500">Pequeño</span>
          </div>
          <div class="flex flex-col items-center">
            <BackpackIcon
              class="w-6 h-6 text-teal-500 mb-2"
              stroke-color="currentColor" />
            <span class="text-sm text-gray-500">Mediano</span>
          </div>
          <div class="flex flex-col items-center">
            <BackpackIcon
              class="w-8 h-8 text-teal-500 mb-2"
              stroke-color="currentColor" />
            <span class="text-sm text-gray-500">Grande</span>
          </div>
          <div class="flex flex-col items-center">
            <BackpackIcon
              class="w-12 h-12 text-teal-500 mb-2"
              stroke-color="currentColor" />
            <span class="text-sm text-gray-500">Extra Grande</span>
          </div>
        </div>
      </div>

      <!-- Sección de Botones -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
          Iconos en Botones
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <button
            class="flex items-center justify-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
            <PlusIcon class="w-4 h-4 mr-2" />
            Agregar
          </button>
          <button
            class="flex items-center justify-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors">
            <CheckIcon class="w-4 h-4 mr-2" />
            Confirmar
          </button>
          <button
            class="flex items-center justify-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
            <ChevronLeftIcon class="w-4 h-4 mr-2" />
            Anterior
          </button>
          <button
            class="flex items-center justify-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
            Siguiente
            <ChevronRightIcon class="w-4 h-4 ml-2" />
          </button>
        </div>
      </div>

      <!-- Sección de Estados Hover -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Estados Hover</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <div
            class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
            <PersonsIcon
              class="w-8 h-8 text-gray-400 hover:text-blue-500 transition-colors mb-2"
              stroke-color="currentColor" />
            <span class="text-sm text-gray-500">Hover Azul</span>
          </div>
          <div
            class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
            <EditIcon
              class="w-8 h-8 text-gray-400 hover:text-green-500 transition-colors mb-2"
              fill-color="currentColor" />
            <span class="text-sm text-gray-500">Hover Verde</span>
          </div>
          <div
            class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
            <SchoolIcon
              class="w-8 h-8 text-gray-400 hover:text-red-500 transition-colors mb-2"
              stroke-color="currentColor" />
            <span class="text-sm text-gray-500">Hover Rojo</span>
          </div>
          <div
            class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
            <CalendarIcon
              class="w-8 h-8 text-gray-400 hover:text-purple-500 transition-colors mb-2"
              stroke-color="currentColor" />
            <span class="text-sm text-gray-500">Hover Púrpura</span>
          </div>
        </div>
      </div>

      <!-- Sección de Navegación -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
          Ejemplo de Navegación
        </h2>
        <nav class="flex space-x-1">
          <a
            href="#"
            class="flex items-center px-3 py-2 text-sm font-medium text-gray-900 bg-gray-100 rounded-md">
            <HouseIcon class="w-4 h-4 mr-2 text-gray-600" />
            Inicio
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
            <BackpackIcon
              class="w-4 h-4 mr-2"
              stroke-color="currentColor" />
            Programas
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
            <PersonsIcon
              class="w-4 h-4 mr-2"
              stroke-color="currentColor" />
            Pasajeros
          </a>
          <a
            href="#"
            class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
            <EditIcon
              class="w-4 h-4 mr-2"
              fill-color="currentColor" />
            Reportes
          </a>
        </nav>
      </div>
    </div>
  </div>
</template>

<script setup>
  import {
    HouseIcon,
    BackpackIcon,
    SchoolIcon,
    PersonsIcon,
    EditIcon,
    PlusIcon,
    CheckIcon,
    ChevronLeftIcon,
    ChevronRightIcon,
    CalendarIcon
  } from "@/Components/Icons";
</script>
