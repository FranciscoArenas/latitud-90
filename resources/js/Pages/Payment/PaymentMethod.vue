<template>
  <MainLayout>
    <div class="bg-gray-100 min-h-screen py-10">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <!-- Título y pasos -->
        <div class="mb-8 px-4">
          <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800">
            Selecciona el método de pago
          </h1>

          <!-- Indicadores de pasos -->
          <div
            class="mt-8 flex flex-wrap items-center justify-center max-w-3xl mx-auto">
            <div class="flex items-center">
              <div class="relative flex items-center justify-center">
                <div
                  class="rounded-full bg-green-600 w-10 h-10 flex items-center justify-center text-white font-bold">
                  ✓
                </div>
              </div>
              <div class="text-sm text-green-600 ml-2 font-medium">
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
                  class="rounded-full bg-teal-600 w-10 h-10 flex items-center justify-center text-white font-bold">
                  2
                </div>
              </div>
              <div class="text-sm text-teal-600 ml-2 font-medium">
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

        <!-- Información del viaje seleccionado -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
          <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/3">
              <img
                :src="trip.image_url"
                :alt="trip.name"
                class="w-full h-48 object-cover rounded-lg" />
            </div>
            <div class="md:w-2/3">
              <h2 class="text-xl font-bold text-gray-800">{{ trip.name }}</h2>
              <p class="text-gray-600 mt-2">{{ trip.destination }}</p>
              <div class="mt-4 grid grid-cols-2 gap-4">
                <div>
                  <p class="text-sm text-gray-500">Fecha de salida</p>
                  <p class="font-medium">
                    {{ formatDate(trip.departure_date) }}
                  </p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Fecha de regreso</p>
                  <p class="font-medium">{{ formatDate(trip.return_date) }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Precio total</p>
                  <p class="font-bold text-lg">
                    ${{ formatPrice(trip.total_price) }}
                  </p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Monto a pagar</p>
                  <p class="font-bold text-lg text-teal-600">
                    ${{ formatPrice(trip.remaining_amount) }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Selección de método de pago -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-lg font-semibold text-gray-800 mb-6">
            Selecciona la forma de pago
          </h3>

          <!-- Opciones de pago -->
          <div class="space-y-4">
            <!-- Pago Total -->
            <div
              class="border-2 rounded-lg p-4 cursor-pointer transition-all duration-200"
              :class="
                selectedPaymentMethod === 'full'
                  ? 'border-teal-600 bg-teal-50'
                  : 'border-gray-200 hover:border-gray-300'
              "
              @click="selectPaymentMethod('full')">
              <div class="flex items-center">
                <input
                  type="radio"
                  id="full_payment"
                  v-model="selectedPaymentMethod"
                  value="full"
                  class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500" />
                <label
                  for="full_payment"
                  class="ml-3 flex-1 cursor-pointer">
                  <div class="flex justify-between items-center">
                    <div>
                      <p class="font-medium text-gray-900">Pago Total</p>
                      <p class="text-sm text-gray-500">
                        Pago con Tarjeta de Débito o Transferencia
                      </p>
                    </div>
                    <div class="text-right">
                      <p class="font-bold text-lg">
                        ${{ formatPrice(trip.remaining_amount) }}
                      </p>
                    </div>
                  </div>
                </label>
              </div>
            </div>

            <!-- Pago en Cuotas Latitud90 -->
            <div
              class="border-2 rounded-lg p-4 cursor-pointer transition-all duration-200"
              :class="
                selectedPaymentMethod === 'installments'
                  ? 'border-teal-600 bg-teal-50'
                  : 'border-gray-200 hover:border-gray-300'
              "
              @click="selectPaymentMethod('installments')">
              <div class="flex items-center">
                <input
                  type="radio"
                  id="installment_payment"
                  v-model="selectedPaymentMethod"
                  value="installments"
                  class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500" />
                <label
                  for="installment_payment"
                  class="ml-3 flex-1 cursor-pointer">
                  <div>
                    <p class="font-medium text-gray-900">
                      Mensual | Cuota Lat 90
                    </p>
                    <p class="text-sm text-gray-500">
                      Pago con Tarjeta de Crédito en
                      {{ selectedInstallments || 3 }} cuotas mensuales, sin
                      recargo de financiamiento
                    </p>
                  </div>
                </label>
              </div>

              <!-- Selector de cuotas (solo se muestra si está seleccionado) -->
              <div
                v-if="selectedPaymentMethod === 'installments'"
                class="mt-4 ml-7">
                <p class="text-sm font-medium text-gray-700 mb-3">
                  Selecciona el número de cuotas:
                </p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                  <div
                    v-for="installment in installmentOptions"
                    :key="installment"
                    class="border rounded-lg p-3 cursor-pointer text-center transition-all duration-200"
                    :class="
                      selectedInstallments === installment
                        ? 'border-teal-600 bg-teal-50'
                        : 'border-gray-200 hover:border-gray-300'
                    "
                    @click="selectedInstallments = installment">
                    <p class="font-bold text-lg">{{ installment }}</p>
                    <p class="text-xs text-gray-500">cuotas de</p>
                    <p class="font-semibold text-teal-600">
                      ${{
                        formatPrice(
                          Math.round(trip.remaining_amount / installment)
                        )
                      }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Faltan pagar -->
          <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <div class="flex justify-between items-center">
              <span class="font-medium text-gray-700">Faltan pagar</span>
              <span class="font-bold text-xl"
                >${{ formatPrice(trip.remaining_amount) }}</span
              >
            </div>
          </div>

          <!-- Botones de acción -->
          <div class="mt-8 flex flex-col sm:flex-row gap-4">
            <button
              @click="goBack"
              class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium transition duration-200">
              Volver
            </button>
            <button
              @click="proceedToPayment"
              :disabled="
                !selectedPaymentMethod ||
                (selectedPaymentMethod === 'installments' &&
                  !selectedInstallments)
              "
              class="flex-1 bg-teal-600 hover:bg-teal-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white py-3 px-6 rounded-lg font-medium transition duration-200">
              Continuar al pago
            </button>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
  import { ref, defineProps } from "vue";
  import { router } from "@inertiajs/vue3";
  import MainLayout from "@/Layouts/MainLayout.vue";

  const props = defineProps({
    trip: {
      type: Object,
      required: true
    },
    rut: {
      type: String,
      required: true
    }
  });

  // Estado del componente
  const selectedPaymentMethod = ref("");
  const selectedInstallments = ref(3);
  const installmentOptions = [3, 6, 9, 12];

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

  // Seleccionar método de pago
  const selectPaymentMethod = (method) => {
    selectedPaymentMethod.value = method;
    if (method === "full") {
      selectedInstallments.value = 1;
    } else if (method === "installments" && !selectedInstallments.value) {
      selectedInstallments.value = 3;
    }
  };

  // Volver al paso anterior
  const goBack = () => {
    router.get(`/buscar-viajes?rut=${props.rut}`);
  };

  // Proceder al pago
  const proceedToPayment = () => {
    if (!selectedPaymentMethod.value) return;

    const paymentData = {
      payment_method: selectedPaymentMethod.value,
      installments: selectedInstallments.value,
      trip_id: props.trip.id,
      passenger_id: props.trip.passenger_id,
      program_id: props.trip.program_id
    };

    router.post("/payment/setup", paymentData);
  };
</script>

<style scoped>
  /* Estilos adicionales si son necesarios */
</style>
