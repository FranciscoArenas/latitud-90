<template>
  <AdminLayout>
    <Head title="Gestión de Pagos" />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-2xl font-bold">Gestión de Pagos</h2>
              <div class="flex space-x-4">
                <input
                  v-model="searchTerm"
                  type="text"
                  placeholder="Buscar por ID o pasajero..."
                  class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                <select
                  v-model="filterStatus"
                  class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                  <option value="">Todos los estados</option>
                  <option value="approved">Aprobado</option>
                  <option value="pending">Pendiente</option>
                  <option value="rejected">Rechazado</option>
                  <option value="refunded">Reembolsado</option>
                </select>
                <select
                  v-model="filterGateway"
                  class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                  <option value="">Todas las pasarelas</option>
                  <option value="transbank_webpay">Transbank WebPay</option>
                  <option value="khipu">Khipu</option>
                  <option value="cash">Efectivo</option>
                  <option value="transfer">Transferencia</option>
                </select>
              </div>
            </div>

            <!-- Estadísticas de Pagos -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
              <div class="bg-blue-50 p-6 rounded-lg">
                <div class="flex items-center">
                  <div class="p-2 bg-blue-100 rounded-lg mr-4">
                    <svg
                      class="w-6 h-6 text-blue-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Total Ingresos</p>
                    <p class="text-2xl font-bold text-blue-600">
                      ${{
                        stats?.total_revenue
                          ? stats.total_revenue.toLocaleString()
                          : "0"
                      }}
                    </p>
                  </div>
                </div>
              </div>

              <div class="bg-green-50 p-6 rounded-lg">
                <div class="flex items-center">
                  <div class="p-2 bg-green-100 rounded-lg mr-4">
                    <svg
                      class="w-6 h-6 text-green-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Completados</p>
                    <p class="text-2xl font-bold text-green-600">
                      {{ stats?.completed ?? 0 }}
                    </p>
                  </div>
                </div>
              </div>

              <div class="bg-yellow-50 p-6 rounded-lg">
                <div class="flex items-center">
                  <div class="p-2 bg-yellow-100 rounded-lg mr-4">
                    <svg
                      class="w-6 h-6 text-yellow-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Pendientes</p>
                    <p class="text-2xl font-bold text-yellow-600">
                      {{ stats?.pending ?? 0 }}
                    </p>
                  </div>
                </div>
              </div>

              <div class="bg-red-50 p-6 rounded-lg">
                <div class="flex items-center">
                  <div class="p-2 bg-red-100 rounded-lg mr-4">
                    <svg
                      class="w-6 h-6 text-red-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Fallidos</p>
                    <p class="text-2xl font-bold text-red-600">
                      {{ stats?.failed ?? 0 }}
                    </p>
                  </div>
                </div>
              </div>

              <div class="bg-purple-50 p-6 rounded-lg">
                <div class="flex items-center">
                  <div class="p-2 bg-purple-100 rounded-lg mr-4">
                    <svg
                      class="w-6 h-6 text-purple-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-600">Reembolsos</p>
                    <p class="text-2xl font-bold text-purple-600">
                      {{ stats?.refunded ?? 0 }}
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabla de Pagos -->
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-turquesa text-blanco">
                  <tr>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                      ID Pago
                    </th>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                      Pasajero
                    </th>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                      Programa
                    </th>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                      Método
                    </th>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                      Monto
                    </th>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                      Estado
                    </th>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                      Fecha
                    </th>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr
                    v-for="payment in filteredPayments"
                    :key="payment.id"
                    class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900">
                        #{{ payment?.id ?? "N/A" }}
                      </div>
                      <div class="text-sm text-gray-500">
                        {{ payment?.transaction_id ?? "Sin ID de transacción" }}
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div
                          class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                          <span class="text-xs font-medium text-gray-700">
                            {{
                              payment?.passenger?.first_name &&
                              payment?.passenger?.last_name
                                ? (
                                    payment.passenger.first_name +
                                    " " +
                                    payment.passenger.last_name
                                  )
                                    .charAt(0)
                                    .toUpperCase()
                                : "?"
                            }}
                          </span>
                        </div>
                        <div>
                          <div class="text-sm font-medium text-gray-900">
                            {{ payment?.passenger?.first_name ?? "Sin nombre" }}
                            {{ payment?.passenger?.last_name ?? "" }}
                          </div>
                          <div class="text-sm text-gray-500">
                            {{ payment?.passenger?.email ?? "Sin email" }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">
                        {{ payment?.program?.title ?? "Sin programa" }}
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <span
                          :class="getGatewayClass(payment?.payment_method)"
                          class="px-2 py-1 text-xs font-semibold rounded-full">
                          {{
                            (payment?.payment_method || "unknown").toUpperCase()
                          }}
                        </span>
                      </div>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      ${{
                        payment?.amount ? payment.amount.toLocaleString() : "0"
                      }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        :class="getStatusClass(payment?.status)"
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                        {{ getStatusText(payment?.status) }}
                      </span>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ formatDate(payment?.created_at) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <div class="flex space-x-2">
                        <button
                          @click="viewPayment(payment)"
                          class="text-blue-600 hover:text-blue-900">
                          Ver
                        </button>
                        <button
                          @click="downloadInvoice(payment)"
                          class="text-green-600 hover:text-green-900"
                          v-if="payment?.status === 'completed'">
                          Factura
                        </button>
                        <button
                          @click="refundPayment(payment)"
                          class="text-red-600 hover:text-red-900"
                          v-if="
                            payment?.status === 'completed' &&
                            !payment?.refunded
                          ">
                          Reembolsar
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
                Mostrando {{ payments?.from ?? 0 }} a {{ payments?.to ?? 0 }} de
                {{ payments?.total ?? 0 }} resultados
              </div>
              <div class="flex space-x-2">
                <button
                  v-for="link in payments?.links || []"
                  :key="link.label"
                  @click="changePage(link.url)"
                  :disabled="!link.url"
                  :class="[
                    'px-3 py-2 text-sm rounded-md',
                    link.active
                      ? 'bg-blue-500 text-white'
                      : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50'
                  ]"
                  v-html="link.label" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal de Vista de Pago -->
    <div
      v-if="showViewModal"
      class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div
        class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Detalles del Pago</h3>
            <button
              @click="showViewModal = false"
              class="text-gray-400 hover:text-gray-600">
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>

          <div
            v-if="selectedPayment"
            class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700"
                  >ID de Pago</label
                >
                <p class="mt-1 text-sm text-gray-900">
                  #{{ selectedPayment?.id ?? "N/A" }}
                </p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700"
                  >ID de Transacción</label
                >
                <p class="mt-1 text-sm text-gray-900">
                  {{
                    selectedPayment?.transaction_id ?? "Sin ID de transacción"
                  }}
                </p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700"
                  >Pasajero</label
                >
                <p class="mt-1 text-sm text-gray-900">
                  {{ selectedPayment?.passenger?.name ?? "Sin nombre" }}
                </p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700"
                  >Programa</label
                >
                <p class="mt-1 text-sm text-gray-900">
                  {{ selectedPayment?.program?.title ?? "Sin programa" }}
                </p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700"
                  >Método de Pago</label
                >
                <span
                  :class="getGatewayClass(selectedPayment?.payment_gateway)"
                  class="mt-1 px-2 py-1 text-xs font-semibold rounded-full">
                  {{
                    selectedPayment?.payment_gateway
                      ? selectedPayment.payment_gateway.toUpperCase()
                      : "DESCONOCIDO"
                  }}
                </span>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700"
                  >Estado</label
                >
                <span
                  :class="getStatusClass(selectedPayment?.status)"
                  class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                  {{ getStatusText(selectedPayment?.status) }}
                </span>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700"
                  >Monto</label
                >
                <p class="mt-1 text-sm text-gray-900">
                  ${{
                    selectedPayment?.amount
                      ? selectedPayment.amount.toLocaleString()
                      : "0"
                  }}
                </p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700"
                  >Fecha</label
                >
                <p class="mt-1 text-sm text-gray-900">
                  {{ formatDateTime(selectedPayment?.created_at) }}
                </p>
              </div>
            </div>

            <div v-if="selectedPayment?.gateway_response">
              <label class="block text-sm font-medium text-gray-700"
                >Respuesta de la Pasarela</label
              >
              <pre class="mt-1 text-xs text-gray-900 bg-gray-100 p-2 rounded">{{
                JSON.stringify(selectedPayment?.gateway_response || {}, null, 2)
              }}</pre>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
  import { ref, computed } from "vue";
  import { Head, router } from "@inertiajs/vue3";
  import AdminLayout from "@/Layouts/AdminLayout.vue";

  const props = defineProps({
    payments: Object,
    stats: Object
  });

  const searchTerm = ref("");
  const filterStatus = ref("");
  const filterGateway = ref("");
  const showViewModal = ref(false);
  const selectedPayment = ref(null);

  const filteredPayments = computed(() => {
    let filtered = props.payments?.data || [];

    if (searchTerm.value) {
      const term = searchTerm.value.toLowerCase();
      filtered = filtered.filter(
        (payment) =>
          (payment?.id?.toString() || "").includes(term) ||
          (payment?.transaction_id?.toLowerCase() || "").includes(term) ||
          (payment?.passenger?.name?.toLowerCase() || "").includes(term) ||
          (payment?.passenger?.email?.toLowerCase() || "").includes(term)
      );
    }

    if (filterStatus.value) {
      filtered = filtered.filter(
        (payment) => payment?.status === filterStatus.value
      );
    }

    if (filterGateway.value) {
      filtered = filtered.filter(
        (payment) => payment?.payment_gateway === filterGateway.value
      );
    }

    return filtered;
  });

  const formatDate = (date) => {
    if (!date) return "Fecha no disponible";
    try {
      return new Date(date).toLocaleDateString("es-ES", {
        year: "numeric",
        month: "short",
        day: "numeric"
      });
    } catch (error) {
      console.error("Error al formatear fecha:", error);
      return "Fecha inválida";
    }
  };

  const formatDateTime = (date) => {
    if (!date) return "Fecha no disponible";
    try {
      return new Date(date).toLocaleString("es-ES", {
        year: "numeric",
        month: "short",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit"
      });
    } catch (error) {
      console.error("Error al formatear fecha y hora:", error);
      return "Fecha y hora inválidas";
    }
  };

  const getStatusClass = (status) => {
    if (!status) return "bg-gray-100 text-gray-800";
    const classes = {
      approved: "bg-green-100 text-green-800",
      pending: "bg-yellow-100 text-yellow-800",
      rejected: "bg-red-100 text-red-800",
      refunded: "bg-purple-100 text-purple-800"
    };
    return classes[status] || "bg-gray-100 text-gray-800";
  };

  const getStatusText = (status) => {
    if (!status) return "Desconocido";
    const texts = {
      approved: "Aprobado",
      pending: "Pendiente",
      rejected: "Rechazado",
      refunded: "Reembolsado"
    };
    return texts[status] || status;
  };

  const getGatewayClass = (gateway) => {
    if (!gateway) return "bg-gray-100 text-gray-800";
    const classes = {
      transbank_webpay: "bg-blue-100 text-blue-800",
      khipu: "bg-green-100 text-green-800",
      cash: "bg-yellow-100 text-yellow-800",
      transfer: "bg-purple-100 text-purple-800"
    };
    return classes[gateway] || "bg-gray-100 text-gray-800";
  };

  const viewPayment = (payment) => {
    selectedPayment.value = payment;
    showViewModal.value = true;
  };

  const downloadInvoice = (payment) => {
    if (!payment?.id) {
      alert("No se puede descargar la factura: ID de pago no disponible");
      return;
    }
    window.open(`/admin/payments/${payment.id}/invoice`, "_blank");
  };

  const refundPayment = (payment) => {
    if (!payment?.id) {
      alert("No se puede reembolsar: ID de pago no disponible");
      return;
    }
    if (confirm("¿Estás seguro de que quieres reembolsar este pago?")) {
      router.post(`/admin/payments/${payment.id}/refund`);
    }
  };

  const changePage = (url) => {
    if (url) {
      router.visit(url);
    }
  };
</script>
