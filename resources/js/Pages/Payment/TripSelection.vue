<template>
  <MainLayout>
    <div class="bg-gray-100 min-h-screen py-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <!-- Título y pasos -->
        <div class="mb-8 px-4">
          <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800">
            Selecciona el programa a pagar de {{ user }}
          </h1>

          <!-- Indicadores de pasos -->
          <div
            class="mt-8 flex flex-wrap items-center justify-center max-w-3xl mx-auto">
            <div class="flex items-center">
              <div class="relative flex items-center justify-center">
                <div
                  class="rounded-full bg-teal-600 w-10 h-10 flex items-center justify-center text-white font-bold">
                  1
                </div>
              </div>
              <div class="text-sm text-teal-600 ml-2 font-medium">
                Selecciona viaje a pagar
              </div>
            </div>

            <div class="hidden sm:flex ml-2 mr-2">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"></path>
              </svg>
            </div>

            <div class="flex items-center mt-4 sm:mt-0">
              <div class="relative flex items-center justify-center">
                <div
                  class="rounded-full bg-gray-300 w-10 h-10 flex items-center justify-center text-white font-bold">
                  2
                </div>
              </div>
              <div class="text-sm text-gray-500 ml-2 font-medium">
                Selecciona método de pago
              </div>
            </div>

            <div class="hidden sm:flex ml-2 mr-2">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"></path>
              </svg>
            </div>

            <div class="flex items-center mt-4 sm:mt-0">
              <div class="relative flex items-center justify-center">
                <div
                  class="rounded-full bg-gray-300 w-10 h-10 flex items-center justify-center text-white font-bold">
                  3
                </div>
              </div>
              <div class="text-sm text-gray-500 ml-2 font-medium">
                Completar pago
              </div>
            </div>

            <div class="hidden sm:flex ml-2 mr-2">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"></path>
              </svg>
            </div>

            <div class="flex items-center mt-4 sm:mt-0">
              <div class="relative flex items-center justify-center">
                <div
                  class="rounded-full bg-gray-300 w-10 h-10 flex items-center justify-center text-white font-bold">
                  4
                </div>
              </div>
              <div class="text-sm text-gray-500 ml-2 font-medium">
                Pagar programa
              </div>
            </div>
          </div>
        </div>

        <div class="relative">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
              v-for="trip in trips"
              :key="trip.id"
              class="bg-white rounded-lg shadow-md overflow-hidden">
              <div class="overflow-hidden h-48 relative">
                <img
                  :src="trip.image_url"
                  :alt="trip.name"
                  class="w-full h-full object-cover" />
                <div
                  class="absolute top-3 left-3 bg-teal-600 text-white text-xs px-2 py-1 rounded-md">
                  {{ formatDate(trip.departure_date) }} -
                  {{ formatDate(trip.return_date) }}
                </div>
              </div>

              <div class="p-6">
                <h3 class="text-lg font-bold text-gray-800">{{ trip.name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ trip.destination }}</p>

                <div class="mt-4">
                  <div v-if="trip.has_pending_payments">
                    <p class="text-gray-700 font-medium">Restante por pagar:</p>
                    <p class="text-xl font-bold text-teal-600">
                      ${{ formatPrice(trip.remaining_amount) }}
                    </p>
                  </div>
                  <div v-else>
                    <p class="text-green-600 font-medium">Totalmente pagado</p>
                    <p class="text-xl font-bold text-gray-800">
                      ${{ formatPrice(trip.total_price) }}
                    </p>
                  </div>

                  <div
                    v-if="trip.last_payment_date"
                    class="mt-2 text-sm text-gray-500">
                    <p>Último pago: {{ formatDate(trip.last_payment_date) }}</p>
                  </div>

                  <div
                    v-if="trip.next_payment_date"
                    class="mt-1 text-sm text-gray-500">
                    <p>
                      Próximo pago: {{ formatDate(trip.next_payment_date) }}
                    </p>
                  </div>
                </div>

                <div class="mt-6">
                  <button
                    v-if="trip.has_pending_payments"
                    @click="goToPayment(trip.id)"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 px-4 rounded-lg transition duration-200 font-medium">
                    Pagar
                    {{
                      trip.remaining_amount < trip.total_price
                        ? "saldo"
                        : "programa"
                    }}
                  </button>
                  <button
                    v-else
                    disabled
                    class="w-full bg-gray-300 text-gray-600 py-3 px-4 rounded-lg font-medium cursor-not-allowed">
                    Programa completado
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-8 flex justify-center">
            <button
              @click="goBackHome"
              class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition duration-150">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
              Volver al home
            </button>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
  import { defineProps } from "vue";
  import { router } from "@inertiajs/vue3";
  import MainLayout from "@/Layouts/MainLayout.vue";

  const props = defineProps({
    trips: {
      type: Array,
      required: true
    },
    user: {
      type: String,
      required: false,
      default: "usuario"
    },
    rut: {
      type: String,
      required: true
    }
  });

  // Formatear precios
  const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  };

  // Formatear fechas
  const formatDate = (dateString) => {
    if (!dateString) return "N/A";

    const date = new Date(dateString);
    const day = date.getDate().toString().padStart(2, "0");
    const month = (date.getMonth() + 1).toString().padStart(2, "0");
    const year = date.getFullYear();

    return `${day}-${month}-${year}`;
  };

  // Función para ir a la página de pago
  const goToPayment = (passengerId) => {
    router.get(`/pago/${passengerId}`);
  };

  // Función para volver al home
  const goBackHome = () => {
    router.get("/");
  };
</script>
