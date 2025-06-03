<template>
  <MainLayout :tittle="'Selecciona el programa a pagar de'">
    <div class="bg-gray-100 min-h-screen py-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
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
                <div v-if="trip.has_pending_payments">
                  <p class="text-gray-700 font-medium">Restante por pagar:</p>
                  <p class="text-xl font-bold text-teal-600">
                    ${{ formatPrice(trip.remaining_amount) }}
                  </p>
                  <!-- Barra de progreso con rayas diagonales -->
                  <div
                    class="w-full bg-gray-200 rounded-full h-2.5 mb-4 overflow-hidden">
                    <div
                      class="progress-striped h-2.5 rounded-full"
                      :class="getProgressColorClass(trip.payment_percentage)"
                      :style="{ width: trip.payment_percentage + '%' }"></div>
                  </div>
                </div>
                <div class="mt-6">
                  {{ trip }}
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

  // Función para ir al paso 2 (selección de método de pago)
  const goToPayment = (tripId) => {
    // Encontrar el viaje seleccionado
    const selectedTrip = props.trips.find((trip) => trip.id === tripId);
    if (selectedTrip) {
      router.get(`/payment/method`, {
        trip: selectedTrip,
        rut: props.rut
      });
    }
  };

  // Función para volver al home
  const goBackHome = () => {
    router.get("/");
  };
  const getProgressColorClass = (percentage) => {
    if (percentage >= 80) return "bg-green-500";
    if (percentage >= 50) return "bg-yellow-400";
    return "bg-orange-500";
  };
</script>
<style>
  .progress-striped {
    background-image: repeating-linear-gradient(
      45deg,
      rgba(255, 255, 255, 0.2),
      rgba(255, 255, 255, 0.2) 10px,
      transparent 10px,
      transparent 20px
    );
    background-size: 28px 28px;
    animation: progress-animation 1s linear infinite;
  }

  .bg-yellow-400 {
    background-color: #fbbf24;
  }

  .bg-orange-500 {
    background-color: #f97316;
  }

  .bg-green-500 {
    background-color: #10b981;
  }

  @keyframes progress-animation {
    0% {
      background-position: 0 0;
    }
    100% {
      background-position: 28px 0;
    }
  }
</style>
