<template>
  <MainLayout :step="3">
    <div class="bg-gray-100 min-h-screen py-10">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <!-- Información del programa -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
          <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/3">
              <img
                :src="program.main_image || '/storage/programs/default.jpg'"
                :alt="program.name"
                class="w-full h-48 object-cover rounded-lg" />
            </div>
            <div class="md:w-2/3">
              <h2 class="text-xl font-bold text-gray-800">
                {{ program.name }}
              </h2>
              <p class="text-gray-600 mt-2">{{ program.destination }}</p>
              <div class="mt-4 grid grid-cols-2 gap-4">
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
              </div>
            </div>
          </div>
        </div>

        <!-- Información del pago -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
          <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Información del pago
          </h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <div class="mb-4">
                <p class="text-sm text-gray-500">Pasajero</p>
                <p class="font-medium">{{ passenger.full_name }}</p>
              </div>
              <div class="mb-4">
                <p class="text-sm text-gray-500">RUT</p>
                <p class="font-medium">{{ passenger.document_number }}</p>
              </div>
              <div class="mb-4">
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium">{{ passenger.email }}</p>
              </div>
            </div>

            <div>
              <div
                class="mb-4"
                v-if="payment.total_installments > 1">
                <p class="text-sm text-gray-500">Cuota</p>
                <p class="font-medium">
                  {{ payment.installment_number }} de
                  {{ payment.total_installments }}
                </p>
              </div>
              <div class="mb-4">
                <p class="text-sm text-gray-500">Monto a pagar</p>
                <p class="font-bold text-2xl text-teal-600">
                  ${{ formatPrice(payment.amount) }}
                </p>
              </div>
              <div
                class="mb-4"
                v-if="payment.due_date">
                <p class="text-sm text-gray-500">Fecha de vencimiento</p>
                <p class="font-medium">{{ formatDate(payment.due_date) }}</p>
              </div>
            </div>
          </div>

          <!-- Progreso de pagos si es en cuotas -->
          <div
            v-if="payment.total_installments > 1"
            class="mt-6">
            <div class="flex justify-between items-center mb-2">
              <p class="text-sm font-medium text-gray-700">Progreso de pagos</p>
              <p class="text-sm text-gray-500">
                {{ paidInstallments }} de
                {{ payment.total_installments }} cuotas
              </p>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div
                class="bg-teal-600 h-2.5 rounded-full transition-all duration-300"
                :style="{
                  width:
                    (paidInstallments / payment.total_installments) * 100 + '%'
                }"></div>
            </div>
          </div>
        </div>

        <!-- Selección de gateway de pago -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-lg font-semibold text-gray-800 mb-6">
            Selecciona tu método de pago preferido
          </h3>

          <div class="space-y-4">
            <!-- Transbank -->
            <div
              class="border-2 rounded-lg p-4 cursor-pointer transition-all duration-200"
              :class="
                selectedGateway === 'transbank'
                  ? 'border-teal-600 bg-teal-50'
                  : 'border-gray-200 hover:border-gray-300'
              "
              @click="selectedGateway = 'transbank'">
              <div class="flex items-center">
                <input
                  type="radio"
                  id="transbank"
                  v-model="selectedGateway"
                  value="transbank"
                  class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500" />
                <label
                  for="transbank"
                  class="ml-3 flex-1 cursor-pointer">
                  <div class="flex justify-between items-center">
                    <div>
                      <p class="font-medium text-gray-900">Transbank WebPay</p>
                      <p class="text-sm text-gray-500">
                        Paga con tarjeta de débito o crédito
                      </p>
                    </div>
                    <div class="flex items-center space-x-2">
                      <img
                        src="/images/logos/webpay.png"
                        alt="WebPay"
                        class="h-8" />
                    </div>
                  </div>
                </label>
              </div>
            </div>

            <!-- Khipu -->
            <div
              class="border-2 rounded-lg p-4 cursor-pointer transition-all duration-200"
              :class="
                selectedGateway === 'khipu'
                  ? 'border-teal-600 bg-teal-50'
                  : 'border-gray-200 hover:border-gray-300'
              "
              @click="selectedGateway = 'khipu'">
              <div class="flex items-center">
                <input
                  type="radio"
                  id="khipu"
                  v-model="selectedGateway"
                  value="khipu"
                  class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500" />
                <label
                  for="khipu"
                  class="ml-3 flex-1 cursor-pointer">
                  <div class="flex justify-between items-center">
                    <div>
                      <p class="font-medium text-gray-900">Khipu</p>
                      <p class="text-sm text-gray-500">
                        Transferencia bancaria simplificada
                      </p>
                    </div>
                    <div class="flex items-center space-x-2">
                      <img
                        src="/images/logos/khipu.png"
                        alt="Khipu"
                        class="h-8" />
                    </div>
                  </div>
                </label>
              </div>
            </div>
          </div>

          <!-- Botones de acción -->
          <div class="mt-8 flex flex-col sm:flex-row gap-4">
            <button
              @click="goBack"
              class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-6 rounded-full font-medium transition duration-200">
              Volver
            </button>
            <button
              @click="processPayment"
              :disabled="!selectedGateway || processing"
              class="flex-1 bg-teal-600 hover:bg-teal-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white py-3 px-6 rounded-full font-medium transition duration-200">
              <span v-if="processing">Procesando...</span>
              <span v-else>Proceder al pago</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
  import { ref, computed, defineProps } from "vue";
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
      required: true
    }
  });

  // Estado del componente
  const selectedGateway = ref("transbank");
  const processing = ref(false);

  // Calcular cuotas pagadas
  const paidInstallments = computed(() => {
    return props.passenger.payments.filter((p) =>
      ["completed", "approved"].includes(p.status)
    ).length;
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

  // Volver al paso anterior
  const goBack = () => {
    history.back();
  };

  // Procesar pago
  const processPayment = async () => {
    if (!selectedGateway.value || processing.value) return;

    processing.value = true;

    try {
      // Actualizar el gateway del pago
      await router.post(`/procesar-pago/${props.payment.id}`, {
        gateway: selectedGateway.value
      });
    } catch (error) {
      console.error("Error al procesar el pago:", error);
      processing.value = false;
    }
  };
</script>

<style scoped>
  /* Estilos adicionales si son necesarios */
</style>
