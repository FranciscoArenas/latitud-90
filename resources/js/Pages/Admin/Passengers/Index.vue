<template>
  <AdminLayout>
    <Head title="Gestión de Pasajeros" />
    
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-2xl font-bold">Gestión de Pasajeros</h2>
              <div class="flex space-x-4">
                <input
                  v-model="searchTerm"
                  type="text"
                  placeholder="Buscar pasajeros..."
                  class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
                <select
                  v-model="filterStatus"
                  class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                >
                  <option value="">Todos los estados</option>
                  <option value="active">Activo</option>
                  <option value="inactive">Inactivo</option>
                  <option value="withdrawn">Retirado</option>
                </select>
              </div>
            </div>

            <!-- Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
              <div class="bg-blue-50 p-6 rounded-lg">
                <div class="flex items-center">
                  <div class="p-2 bg-blue-100 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Total Pasajeros</p>
                    <p class="text-2xl font-bold text-gray-900">{{ stats.total }}</p>
                  </div>
                </div>
              </div>
              
              <div class="bg-green-50 p-6 rounded-lg">
                <div class="flex items-center">
                  <div class="p-2 bg-green-100 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Activos</p>
                    <p class="text-2xl font-bold text-green-600">{{ stats.confirmed }}</p>
                  </div>
                </div>
              </div>
              
              <div class="bg-yellow-50 p-6 rounded-lg">
                <div class="flex items-center">
                  <div class="p-2 bg-yellow-100 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Inactivos</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ stats.pending }}</p>
                  </div>
                </div>
              </div>
              
              <div class="bg-red-50 p-6 rounded-lg">
                <div class="flex items-center">
                  <div class="p-2 bg-red-100 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Retirados</p>
                    <p class="text-2xl font-bold text-red-600">{{ stats.cancelled }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabla de Pasajeros -->
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Pasajero
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Programa
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Fecha Reserva
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Estado
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Total
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="passenger in filteredPassengers" :key="passenger.id" class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                          <span class="text-sm font-medium text-gray-700">
                            {{ (passenger.first_name + ' ' + passenger.last_name).charAt(0).toUpperCase() }}
                          </span>
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">{{ passenger.first_name }} {{ passenger.last_name }}</div>
                          <div class="text-sm text-gray-500">{{ passenger.email }}</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">{{ passenger.program.title }}</div>
                      <div class="text-sm text-gray-500">{{ passenger.program.duration }} días</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ formatDate(passenger.created_at) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span :class="getStatusClass(passenger.status)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                        {{ getStatusText(passenger.status) }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      ${{ (passenger.individual_price * (passenger.adults || 1) + (passenger.children || 0) * passenger.individual_price * 0.7).toLocaleString() }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <div class="flex space-x-2">
                        <button
                          @click="viewPassenger(passenger)"
                          class="text-blue-600 hover:text-blue-900"
                        >
                          Ver
                        </button>
                        <button
                          @click="editPassenger(passenger)"
                          class="text-indigo-600 hover:text-indigo-900"
                        >
                          Editar
                        </button>
                        <button
                          @click="cancelReservation(passenger)"
                          class="text-red-600 hover:text-red-900"
                          v-if="passenger.status !== 'cancelled'"
                        >
                          Cancelar
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Paginación -->
            <div class="mt-6 flex items-center justify-between">
              <div class="text-sm text-gray-700">
                Mostrando {{ passengers.from }} a {{ passengers.to }} de {{ passengers.total }} resultados
              </div>
              <div class="flex space-x-2">
                <button
                  v-for="link in passengers.links"
                  :key="link.label"
                  @click="changePage(link.url)"
                  :disabled="!link.url"
                  :class="[
                    'px-3 py-2 text-sm rounded-md',
                    link.active
                      ? 'bg-blue-500 text-white'
                      : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50'
                  ]"
                  v-html="link.label"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal de Vista de Pasajero -->
    <div v-if="showViewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Detalles del Pasajero</h3>
            <button @click="showViewModal = false" class="text-gray-400 hover:text-gray-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
          
          <div v-if="selectedPassenger" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <p class="mt-1 text-sm text-gray-900">{{ selectedPassenger.name }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <p class="mt-1 text-sm text-gray-900">{{ selectedPassenger.email }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                <p class="mt-1 text-sm text-gray-900">{{ selectedPassenger.phone }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Documento</label>
                <p class="mt-1 text-sm text-gray-900">{{ selectedPassenger.document_number }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Programa</label>
                <p class="mt-1 text-sm text-gray-900">{{ selectedPassenger.program.title }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Estado</label>
                <span :class="getStatusClass(selectedPassenger.status)" class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                  {{ getStatusText(selectedPassenger.status) }}
                </span>
              </div>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700">Comentarios</label>
              <p class="mt-1 text-sm text-gray-900">{{ selectedPassenger.comments || 'Sin comentarios' }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { Head, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
  passengers: Object,
  stats: Object
})

const searchTerm = ref('')
const filterStatus = ref('')
const showViewModal = ref(false)
const selectedPassenger = ref(null)

const filteredPassengers = computed(() => {
  let filtered = props.passengers.data || []
  
  if (searchTerm.value) {
    const term = searchTerm.value.toLowerCase()
    filtered = filtered.filter(passenger => 
      passenger.first_name.toLowerCase().includes(term) ||
      passenger.last_name.toLowerCase().includes(term) ||
      passenger.email.toLowerCase().includes(term) ||
      passenger.program.title.toLowerCase().includes(term)
    )
  }
  
  if (filterStatus.value) {
    filtered = filtered.filter(passenger => passenger.status === filterStatus.value)
  }
  
  return filtered
})

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('es-ES', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  })
}

const getStatusClass = (status) => {
  const classes = {
    active: 'bg-green-100 text-green-800',
    inactive: 'bg-yellow-100 text-yellow-800',
    withdrawn: 'bg-red-100 text-red-800'
  }
  return classes[status] || 'bg-gray-100 text-gray-800'
}

const getStatusText = (status) => {
  const texts = {
    active: 'Activo',
    inactive: 'Inactivo',
    withdrawn: 'Retirado'
  }
  return texts[status] || status
}

const viewPassenger = (passenger) => {
  selectedPassenger.value = passenger
  showViewModal.value = true
}

const editPassenger = (passenger) => {
  router.visit(`/admin/passengers/${passenger.id}/edit`)
}

const cancelReservation = (passenger) => {
  if (confirm('¿Estás seguro de que quieres cancelar esta reserva?')) {
    router.post(`/admin/passengers/${passenger.id}/cancel`)
  }
}

const changePage = (url) => {
  if (url) {
    router.visit(url)
  }
}
</script>
