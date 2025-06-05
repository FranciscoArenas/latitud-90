<template>
  <MainLayout
    :step="4"
    tittle="Pago realizado con éxito">
    <div class="bg-gray-100 min-h-screen py-10">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <!-- Mensaje de éxito -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <svg
                class="h-8 w-8 text-green-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div class="ml-4">
              <h3 class="text-lg font-bold text-green-800">¡Pago exitoso!</h3>
              <p class="text-green-700 mt-1">
                <span v-if="payment.total_installments > 1">
                  Tu cuota {{ payment.installment_number }} de
                  {{ payment.total_installments }} ha sido procesada
                  correctamente.
                </span>
                <span v-else> Tu pago ha sido procesado correctamente. </span>
              </p>
            </div>
          </div>
        </div>

        <!-- Información del pago realizado -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
          <h3 class="text-lg font-semibold text-gray-800 mb-6">
            Detalles del pago
          </h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <div class="mb-4">
                <p class="text-sm text-gray-500">Número de transacción</p>
                <p class="font-mono text-sm bg-gray-100 p-2 rounded">
                  {{ payment.gateway_transaction_id || "N/A" }}
                </p>
              </div>
              <div class="mb-4">
                <p class="text-sm text-gray-500">Fecha y hora</p>
                <p class="font-medium">
                  {{
                    formatDateTime(payment.payment_date || payment.created_at)
                  }}
                </p>
              </div>
              <div class="mb-4">
                <p class="text-sm text-gray-500">Método de pago</p>
                <p class="font-medium capitalize">{{ payment.gateway }}</p>
              </div>
            </div>

            <div>
              <div class="mb-4">
                <p class="text-sm text-gray-500">Programa</p>
                <p class="font-medium">{{ program.name }}</p>
              </div>
              <div class="mb-4">
                <p class="text-sm text-gray-500">Destino</p>
                <p class="font-medium">{{ program.destination }}</p>
              </div>
              <div class="mb-4">
                <p class="text-sm text-gray-500">Monto pagado</p>
                <p class="font-bold text-xl text-green-600">
                  ${{ formatPrice(payment.amount) }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Estado del pago total si es en cuotas -->
        <div
          v-if="payment.total_installments > 1"
          class="bg-white rounded-lg shadow-md p-6 mb-8">
          <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Estado de cuotas
          </h3>

          <div class="flex justify-between items-center mb-4">
            <p class="text-sm font-medium text-gray-700">Progreso del pago</p>
            <p class="text-sm text-gray-500">
              {{ paidInstallments }} de {{ payment.total_installments }} cuotas
              pagadas
            </p>
          </div>

          <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
            <div
              class="bg-green-600 h-3 rounded-full transition-all duration-300"
              :style="{
                width:
                  (paidInstallments / payment.total_installments) * 100 + '%'
              }"></div>
          </div>

          <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
              <p class="text-gray-500">Total pagado</p>
              <p class="font-bold text-lg">${{ formatPrice(totalPaid) }}</p>
            </div>
            <div>
              <p class="text-gray-500">Restante</p>
              <p
                class="font-bold text-lg"
                :class="
                  remainingAmount > 0 ? 'text-orange-600' : 'text-green-600'
                ">
                ${{ formatPrice(remainingAmount) }}
              </p>
            </div>
          </div>

          <!-- Próxima cuota -->
          <div
            v-if="nextPayment"
            class="mt-6 p-4 bg-blue-50 rounded-lg">
            <div class="flex items-center">
              <svg
                class="h-5 w-5 text-blue-600 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <div>
                <p class="font-medium text-blue-800">Próxima cuota</p>
                <p class="text-sm text-blue-600">
                  Cuota {{ nextPayment.installment_number }}: ${{
                    formatPrice(nextPayment.amount)
                  }}
                  - Vence el {{ formatDate(nextPayment.due_date) }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Información del viaje -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
          <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Información del viaje
          </h3>

          <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/3">
              <img
                :src="program.main_image || '/storage/programs/default.jpg'"
                :alt="program.name"
                class="w-full h-48 object-cover rounded-lg" />
            </div>
            <div class="md:w-2/3">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <p class="text-sm text-gray-500">Fecha de salida</p>
                  <p class="font-medium">
                    {{ formatDate(program.departure_date) }}
                  </p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Fecha de regreso</p>
                  <p class="font-medium">
                    {{ formatDate(program.return_date) }}
                  </p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Duración</p>
                  <p class="font-medium">
                    {{
                      calculateDuration(
                        program.departure_date,
                        program.return_date
                      )
                    }}
                    días
                  </p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Tipo de servicio</p>
                  <p class="font-medium capitalize">
                    {{ program.service_type }}
                  </p>
                </div>
              </div>
              <div class="mt-4">
                <p class="text-sm text-gray-500">Descripción</p>
                <p class="text-gray-700">
                  {{ program.description || "Sin descripción disponible" }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Botones de acción -->
        <div class="flex flex-col sm:flex-row gap-4">
          <button
            @click="searchMoreTrips"
            class="flex-1 bg-teal-600 hover:bg-teal-700 text-white py-3 px-6 rounded-lg font-medium transition duration-200">
            Buscar más viajes
          </button>
          <button
            @click="goHome"
            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-6 rounded-full font-medium transition duration-200">
            Volver al inicio
          </button>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
  import { computed, defineProps } from "vue";
  import { router } from "@inertiajs/vue3";
  import MainLayout from "@/Layouts/MainLayout.vue";

  const props = defineProps({
    passenger: {
      type: Object,
      required: true
    },
    payment: {
      type: Object,
      required: true
    },
    program: {
      type: Object,
      required: true
    },
    rut: {
      type: String,
      required: false
    }
  });

  // Cálculos computados
  const paidInstallments = computed(() => {
    return props.passenger.payments.filter((p) =>
      ["completed", "approved"].includes(p.status)
    ).length;
  });

  const totalPaid = computed(() => {
    return props.passenger.payments
      .filter((p) => ["completed", "approved"].includes(p.status))
      .reduce((sum, p) => sum + p.amount, 0);
  });

  const remainingAmount = computed(() => {
    return Math.max(0, props.passenger.individual_price - totalPaid.value);
  });

  const nextPayment = computed(() => {
    return props.passenger.payments
      .filter((p) => p.status === "pending")
      .sort((a, b) => a.installment_number - b.installment_number)[0];
  });

  // Funciones de formato
  const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  };

  const formatDate = (dateString) => {
    if (!dateString) return "N/A";

    const date = new Date(dateString);
    const day = date.getDate().toString().padStart(2, "0");
    const month = (date.getMonth() + 1).toString().padStart(2, "0");
    const year = date.getFullYear();

    return `${day}-${month}-${year}`;
  };

  const formatDateTime = (dateString) => {
    if (!dateString) return "N/A";

    const date = new Date(dateString);
    const day = date.getDate().toString().padStart(2, "0");
    const month = (date.getMonth() + 1).toString().padStart(2, "0");
    const year = date.getFullYear();
    const hours = date.getHours().toString().padStart(2, "0");
    const minutes = date.getMinutes().toString().padStart(2, "0");

    return `${day}-${month}-${year} ${hours}:${minutes}`;
  };

  const calculateDuration = (startDate, endDate) => {
    if (!startDate || !endDate) return "N/A";

    const start = new Date(startDate);
    const end = new Date(endDate);
    const diffTime = Math.abs(end - start);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    return diffDays;
  };

  // Funciones de navegación
  const searchMoreTrips = () => {
    const rut = props.rut || props.passenger.document_number;
    router.get(`/buscar-viajes?rut=${rut}`);
  };

  const goHome = () => {
    router.get("/");
  };
</script>

<style scoped>
  /* Estilos adicionales si son necesarios */
</style>
