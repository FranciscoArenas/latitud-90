<template>
  <!-- Filters -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-sm p-6">
      <h3 class="text-lg font-semibold text-gray-900 mb-4">
        Filtrar Programas
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1"
            >Tipo de Servicio</label
          >
          <select
            v-model="filters.service_type"
            @change="applyFilters"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">Todos</option>
            <option
              v-for="type in serviceTypes"
              :key="type"
              :value="type">
              {{ formatServiceType(type) }}
            </option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1"
            >Precio Mínimo</label
          >
          <input
            v-model="filters.price_min"
            type="number"
            @input="applyFilters"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="0" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1"
            >Precio Máximo</label
          >
          <input
            v-model="filters.price_max"
            type="number"
            @input="applyFilters"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Sin límite" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1"
            >Fecha de Salida</label
          >
          <input
            v-model="filters.departure_date_from"
            type="date"
            @input="applyFilters"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        </div>
      </div>
    </div>
  </div>

  <!-- Programs Grid -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div
        v-for="program in programs.data"
        :key="program.id"
        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
        <div
          class="h-48 bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
          <div class="text-center text-white">
            <h3 class="text-xl font-bold">{{ program.name }}</h3>
            <p class="text-indigo-100 mt-2">
              {{ formatServiceType(program.service_type) }}
            </p>
          </div>
        </div>
        <div class="p-6">
          <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-gray-500">{{ program.destination }}</span>
            <span class="text-sm text-gray-500"
              >{{ program.duration_days }} días</span
            >
          </div>
          <p class="text-gray-700 text-sm mb-4 line-clamp-3">
            {{ program.description }}
          </p>
          <div class="flex items-center justify-between mb-4">
            <div>
              <span class="text-2xl font-bold text-indigo-400">
                ${{ formatPrice(program.base_price) }}
              </span>
              <span class="text-gray-500 text-sm ml-1">CLP</span>
            </div>
            <div class="text-right">
              <span class="text-sm text-gray-500">Disponibles:</span>
              <span
                :class="
                  program.available_spots > 0
                    ? 'text-green-600'
                    : 'text-red-600'
                "
                class="font-semibold">
                {{ program.available_spots }} / {{ program.capacity }}
              </span>
            </div>
          </div>
          <div
            class="flex items-center justify-between text-sm text-gray-500 mb-4">
            <span>Salida: {{ formatDate(program.departure_date) }}</span>
            <span>Regreso: {{ formatDate(program.return_date) }}</span>
          </div>
          <div class="flex space-x-2">
            <Link
              :href="route('ecommerce.show', program.id)"
              class="flex-1 bg-indigo-600 text-white text-center py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-200">
              Ver Detalles
            </Link>
            <Link
              v-if="program.is_available"
              :href="route('ecommerce.reservation', program.id)"
              class="flex-1 bg-yellow-500 text-gray-900 text-center py-2 px-4 rounded-md hover:bg-yellow-400 transition duration-200 font-semibold">
              Reservar
            </Link>
            <button
              v-else
              disabled
              class="flex-1 bg-gray-300 text-gray-500 text-center py-2 px-4 rounded-md cursor-not-allowed">
              Sin Disponibilidad
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <div
      v-if="programs.last_page > 1"
      class="mt-12 flex justify-center">
      <nav class="flex space-x-2">
        <Link
          v-if="programs.prev_page_url"
          :href="programs.prev_page_url"
          class="px-3 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
          Anterior
        </Link>
        <span
          v-for="page in generatePagination()"
          :key="page"
          class="px-3 py-2"
          :class="
            page === programs.current_page
              ? 'bg-indigo-600 text-white'
              : 'bg-white border border-gray-300 hover:bg-gray-50'
          ">
          <Link
            v-if="page !== programs.current_page"
            :href="programs.path + '?page=' + page">
            {{ page }}
          </Link>
          <span v-else>{{ page }}</span>
        </span>
        <Link
          v-if="programs.next_page_url"
          :href="programs.next_page_url"
          class="px-3 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
          Siguiente
        </Link>
      </nav>
    </div>
  </div>
</template>
<script></script>
<style></style>
