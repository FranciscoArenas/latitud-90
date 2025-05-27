<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-indigo-600">TravelCMS</h1>
                    </div>
                    <nav class="hidden md:flex space-x-8">
                        <Link href="/" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">
                            Inicio
                        </Link>
                        <Link :href="route('ecommerce.find-reservation')" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">
                            Buscar Reserva
                        </Link>
                        <Link :href="route('login')" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">
                            Admin
                        </Link>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <div class="relative bg-indigo-800 py-24">
            <div class="absolute inset-0">
                <div class="bg-indigo-800 opacity-75"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Descubre el Mundo
                </h1>
                <p class="text-xl text-indigo-100 mb-8 max-w-3xl mx-auto">
                    Tours, excursiones, intercambios y cruceros diseñados para crear experiencias inolvidables
                </p>
                <div class="max-w-lg mx-auto">
                    <div class="flex">
                        <input 
                            v-model="searchQuery"
                            type="text" 
                            placeholder="¿A dónde te gustaría ir?"
                            class="flex-1 px-4 py-3 rounded-l-lg border-0 focus:ring-2 focus:ring-indigo-500"
                            @keypress.enter="performSearch"
                        />
                        <button 
                            @click="performSearch"
                            class="px-6 py-3 bg-yellow-500 text-gray-900 font-semibold rounded-r-lg hover:bg-yellow-400 transition duration-200"
                        >
                            Buscar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Filtrar Programas</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Servicio</label>
                        <select 
                            v-model="filters.service_type"
                            @change="applyFilters"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="">Todos</option>
                            <option v-for="type in serviceTypes" :key="type" :value="type">
                                {{ formatServiceType(type) }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Precio Mínimo</label>
                        <input 
                            v-model="filters.price_min"
                            type="number"
                            @input="applyFilters"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="0"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Precio Máximo</label>
                        <input 
                            v-model="filters.price_max"
                            type="number"
                            @input="applyFilters"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Sin límite"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Salida</label>
                        <input 
                            v-model="filters.departure_date_from"
                            type="date"
                            @input="applyFilters"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
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
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300"
                >
                    <div class="h-48 bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
                        <div class="text-center text-white">
                            <h3 class="text-xl font-bold">{{ program.name }}</h3>
                            <p class="text-indigo-100 mt-2">{{ formatServiceType(program.service_type) }}</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-500">{{ program.destination }}</span>
                            <span class="text-sm text-gray-500">{{ program.duration_days }} días</span>
                        </div>
                        <p class="text-gray-700 text-sm mb-4 line-clamp-3">{{ program.description }}</p>
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-2xl font-bold text-indigo-600">
                                    ${{ formatPrice(program.base_price) }}
                                </span>
                                <span class="text-gray-500 text-sm ml-1">CLP</span>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500">Disponibles:</span>
                                <span :class="program.available_spots > 0 ? 'text-green-600' : 'text-red-600'" class="font-semibold">
                                    {{ program.available_spots }} / {{ program.capacity }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span>Salida: {{ formatDate(program.departure_date) }}</span>
                            <span>Regreso: {{ formatDate(program.return_date) }}</span>
                        </div>
                        <div class="flex space-x-2">
                            <Link 
                                :href="route('ecommerce.show', program.id)"
                                class="flex-1 bg-indigo-600 text-white text-center py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-200"
                            >
                                Ver Detalles
                            </Link>
                            <Link 
                                v-if="program.is_available"
                                :href="route('ecommerce.reservation', program.id)"
                                class="flex-1 bg-yellow-500 text-gray-900 text-center py-2 px-4 rounded-md hover:bg-yellow-400 transition duration-200 font-semibold"
                            >
                                Reservar
                            </Link>
                            <button 
                                v-else
                                disabled
                                class="flex-1 bg-gray-300 text-gray-500 text-center py-2 px-4 rounded-md cursor-not-allowed"
                            >
                                Sin Disponibilidad
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="programs.last_page > 1" class="mt-12 flex justify-center">
                <nav class="flex space-x-2">
                    <Link 
                        v-if="programs.prev_page_url"
                        :href="programs.prev_page_url"
                        class="px-3 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50"
                    >
                        Anterior
                    </Link>
                    <span 
                        v-for="page in generatePagination()" 
                        :key="page"
                        class="px-3 py-2"
                        :class="page === programs.current_page ? 'bg-indigo-600 text-white' : 'bg-white border border-gray-300 hover:bg-gray-50'"
                    >
                        <Link v-if="page !== programs.current_page" :href="programs.path + '?page=' + page">
                            {{ page }}
                        </Link>
                        <span v-else>{{ page }}</span>
                    </span>
                    <Link 
                        v-if="programs.next_page_url"
                        :href="programs.next_page_url"
                        class="px-3 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50"
                    >
                        Siguiente
                    </Link>
                </nav>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">TravelCMS</h3>
                        <p class="text-gray-300">
                            Tu agencia de viajes de confianza para experiencias únicas e inolvidables.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contacto</h3>
                        <div class="text-gray-300 space-y-2">
                            <p>📧 info@travelcms.com</p>
                            <p>📞 +56 2 2345 6789</p>
                            <p>📍 Santiago, Chile</p>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Enlaces</h3>
                        <div class="text-gray-300 space-y-2">
                            <Link href="/" class="block hover:text-white">Inicio</Link>
                            <Link :href="route('ecommerce.find-reservation')" class="block hover:text-white">Buscar Reserva</Link>
                            <Link :href="route('login')" class="block hover:text-white">Administración</Link>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                    <p>&copy; 2025 TravelCMS. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import { Link, Head } from '@inertiajs/vue3'
import { ref, reactive } from 'vue'
import { router } from '@inertiajs/vue3'

export default {
    components: {
        Link,
        Head
    },
    props: {
        programs: Object,
        filters: Object,
        serviceTypes: Array
    },
    setup(props) {
        const searchQuery = ref(props.filters.search || '')
        const filters = reactive({
            service_type: props.filters.service_type || '',
            price_min: props.filters.price_min || '',
            price_max: props.filters.price_max || '',
            departure_date_from: props.filters.departure_date_from || '',
            departure_date_to: props.filters.departure_date_to || ''
        })

        const formatServiceType = (type) => {
            const types = {
                'tours': 'Tours',
                'excursiones': 'Excursiones',
                'intercambio': 'Intercambios',
                'cruceros': 'Cruceros'
            }
            return types[type] || type
        }

        const formatPrice = (price) => {
            return new Intl.NumberFormat('es-CL').format(price)
        }

        const formatDate = (date) => {
            return new Date(date).toLocaleDateString('es-CL', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            })
        }

        const performSearch = () => {
            router.get('/', { 
                ...filters,
                search: searchQuery.value 
            }, {
                preserveState: true,
                preserveScroll: true
            })
        }

        const applyFilters = () => {
            router.get('/', {
                ...filters,
                search: searchQuery.value
            }, {
                preserveState: true,
                preserveScroll: true
            })
        }

        const generatePagination = () => {
            const pages = []
            const current = props.programs.current_page
            const last = props.programs.last_page
            
            // Mostrar siempre la primera página
            pages.push(1)
            
            // Calcular rango alrededor de la página actual
            const start = Math.max(2, current - 2)
            const end = Math.min(last - 1, current + 2)
            
            // Agregar puntos suspensivos si es necesario
            if (start > 2) pages.push('...')
            
            // Agregar páginas del rango
            for (let i = start; i <= end; i++) {
                pages.push(i)
            }
            
            // Agregar puntos suspensivos si es necesario
            if (end < last - 1) pages.push('...')
            
            // Mostrar siempre la última página (si no es la primera)
            if (last > 1) pages.push(last)
            
            return pages
        }

        return {
            searchQuery,
            filters,
            formatServiceType,
            formatPrice,
            formatDate,
            performSearch,
            applyFilters,
            generatePagination
        }
    }
}
</script>

<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
