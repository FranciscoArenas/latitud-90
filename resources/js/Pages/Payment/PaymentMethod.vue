<template>
  <MainLayout :step="2">
    <div class="bg-gris-3 min-h-screen py-10">
      <div class="grid lg:grid-cols-6 mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <!-- Información del viaje destacado -->
        <div class="lg:col-span-4 bg-gris-3 p-8 mb-8">
          <div class="flex flex-col gap-8 items-center">
            <div class="w-full flex justify-center">
              <img
                :src="trip.image_url"
                :alt="trip.name"
                class="w-full object-cover rounded-xl shadow-md" />
            </div>
            <div class="md:w-2/3 w-full">
              <div
                class="flex w-full items-center justify-between mb-4 text-center">
                <p class="text-teal-700 font-medium mb-4">
                  {{ trip.destination }}
                </p>
                <span
                  class="bg-turquesa text-blanco rounded-full px-3 py-1 ml-2 flex items-center">
                  <p class="text-xs mr-2">Fecha de salida</p>
                  <p class="font-semibold text-base">
                    {{ formatDate(trip.departure_date) }}
                  </p>
                </span>
              </div>
              <h2 class="text-2xl font-bold text-gray-800 mb-2">
                {{ trip.name }}
              </h2>
              <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                  <p class="text-xs text-gray-500">Fecha de regreso</p>
                  <p class="font-semibold text-base">
                    {{ formatDate(trip.return_date) }}
                  </p>
                </div>
                <div>
                  <p class="text-xs text-gray-500">Precio total</p>
                  <p class="font-bold text-xl text-gray-800">
                    ${{ formatPrice(trip.total_price) }}
                  </p>
                </div>
                <div>
                  <p class="text-xs text-gray-500">Monto a pagar</p>
                  <p class="font-bold text-xl text-teal-600">
                    ${{ formatPrice(trip.remaining_amount) }}
                  </p>
                </div>
              </div>

              <!-- Características del viaje -->
              <div class="flex flex-wrap gap-6 mb-6">
                <div>
                  <p>{{ trip.description }}</p>
                </div>
                <div class="flex flex-col items-center">
                  <span class="bg-teal-100 text-teal-600 rounded-full p-3 mb-1">
                    <i class="fas fa-mountain"></i>
                  </span>
                  <span class="text-xs font-semibold text-gray-700">
                    Aventura
                  </span>
                </div>
                <div class="flex flex-col items-center">
                  <span class="bg-blue-100 text-blue-600 rounded-full p-3 mb-1">
                    <i class="fas fa-book-open"></i>
                  </span>
                  <span class="text-xs font-semibold text-gray-700">
                    Educación
                  </span>
                </div>
                <div class="flex flex-col items-center">
                  <span
                    class="bg-yellow-100 text-yellow-600 rounded-full p-3 mb-1">
                    <i class="fas fa-theater-masks"></i>
                  </span>
                  <span class="text-xs font-semibold text-gray-700">
                    Entretenimiento
                  </span>
                </div>
                <div class="flex flex-col items-center">
                  <span
                    class="bg-green-100 text-green-600 rounded-full p-3 mb-1">
                    <i class="fas fa-shield-alt"></i>
                  </span>
                  <span class="text-xs font-semibold text-gray-700">
                    Seguridad
                  </span>
                </div>
              </div>

              <!-- Botones de acción -->
              <div class="flex flex-wrap gap-4 mb-2">
                <button
                  class="bg-white border border-teal-600 text-teal-600 px-4 py-2 rounded-lg font-medium flex items-center gap-2 hover:bg-teal-50 transition">
                  <i class="fas fa-route"></i> Itinerario
                </button>
                <button
                  class="bg-white border border-teal-600 text-teal-600 px-4 py-2 rounded-lg font-medium flex items-center gap-2 hover:bg-teal-50 transition">
                  <i class="fas fa-umbrella-beach"></i> Cobertura de asistencia
                  en viaje
                </button>
                <button
                  class="bg-white border border-teal-600 text-teal-600 px-4 py-2 rounded-lg font-medium flex items-center gap-2 hover:bg-teal-50 transition">
                  <i class="fas fa-list"></i> Lista de equipo
                </button>
              </div>
            </div>
          </div>

          <!-- Advertencia -->
          <div
            class="mt-8 bg-orange-50 border-l-4 border-orange-400 p-4 rounded">
            <div class="flex items-center gap-2">
              <i class="fas fa-exclamation-triangle text-orange-400"></i>
              <span class="text-xs text-gray-700 font-medium">
                El itinerario o programa puede sufrir modificaciones por razones
                de fuerza mayor (clima, pandemia, cortes de ruta, etc). Para más
                información, consulta a nuestro correo
                <a
                  href="mailto:educacion@latitud90.com"
                  class="underline text-teal-600"
                  >educacion@latitud90.com</a
                >.
              </span>
            </div>
          </div>
        </div>

        <!-- Selección de método de pago -->
        <div
          class="lg:col-span-2 bg-white rounded-lg shadow-md p-6 h-fit self-start">
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
              class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-6 rounded-full font-medium transition duration-200">
              Volver
            </button>
            <button
              @click="proceedToPayment"
              :disabled="
                !selectedPaymentMethod ||
                (selectedPaymentMethod === 'installments' &&
                  !selectedInstallments)
              "
              class="flex-1 bg-teal-600 hover:bg-teal-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white py-3 px-6 rounded-full font-medium transition duration-200">
              Continuar al pago
            </button>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
  import { ref, defineProps, computed } from "vue";
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
