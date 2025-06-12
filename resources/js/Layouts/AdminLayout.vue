<template>
  <div class="min-h-screen flex bg-gray-100">
    <!-- Sidebar -->
    <aside
      class="mt-3 mb-3 ml-6 rounded-xl w-32 bg-white shadow-md flex flex-col">
      <div class="flex items-center justify-center py-6">
        <a
          href="/"
          class="text-lg font-bold">
          <img
            :src="images['logo-color']"
            alt="Logo Latitud 90"
            class="h-12" />
        </a>
      </div>
      <nav class="flex flex-col items-center">
        <NavLink
          :href="route('admin.dashboard')"
          :active="route().current('admin.dashboard')"
          class="flex justify-center w-full p-2 hover:bg-gray-50 transition-colors mt-11">
          <HouseIcon
            class="w-10 h-10 transition-colors"
            :class="
              route().current('admin.dashboard')
                ? 'text-turquesa'
                : 'text-gray-400'
            " />
        </NavLink>
        <NavLink
          :href="route('admin.programs.index')"
          :active="route().current('admin.programs.*')"
          class="flex justify-center w-full p-2 hover:bg-gray-50 transition-colors mt-11">
          <BackpackIcon
            class="w-10 h-10 transition-colors"
            :class="
              route().current('admin.programs.*')
                ? 'text-turquesa'
                : 'text-gray-400'
            "
            stroke-color="currentColor" />
        </NavLink>
        <NavLink
          :href="route('admin.passengers.index')"
          :active="route().current('admin.passengers.*')"
          class="flex justify-center w-full p-2 hover:bg-gray-50 transition-colors mt-11">
          <SchoolIcon
            class="w-10 h-10 transition-colors"
            :class="
              route().current('admin.passengers.*')
                ? 'text-turquesa'
                : 'text-gray-400'
            "
            stroke-color="currentColor" />
        </NavLink>
        <NavLink
          :href="route('admin.payments.index')"
          :active="route().current('admin.payments.*')"
          class="flex justify-center w-full p-2 hover:bg-gray-50 transition-colors mt-11">
          <PersonsIcon
            class="w-10 h-10 transition-colors"
            :class="
              route().current('admin.payments.*')
                ? 'text-turquesa'
                : 'text-gray-400'
            "
            stroke-color="currentColor" />
        </NavLink>
        <NavLink
          :href="route('admin.reports.index')"
          :active="route().current('admin.reports.*')"
          class="flex justify-center w-full p-2 hover:bg-gray-50 transition-colors mt-11">
          <EditIcon
            class="w-10 h-10 transition-colors"
            :class="
              route().current('admin.reports.*')
                ? 'text-turquesa'
                : 'text-gray-400'
            "
            fill-color="currentColor" />
        </NavLink>
      </nav>
      <div class="mt-auto border-t border-gray-200">
        <div class="px-4 py-2">
          <div class="font-medium text-base text-gray-800">
            {{ $page.props.auth.user.name }}
          </div>
          <div class="font-medium text-sm text-gray-500">
            {{ $page.props.auth.user.email }}
          </div>
        </div>
        <nav class="mt-2">
          <NavLink
            :href="route('profile.edit')"
            class="block px-4 py-2">
            Perfil
          </NavLink>
          <NavLink
            :href="route('ecommerce.index')"
            class="block px-4 py-2">
            Ver Sitio Web
          </NavLink>
          <NavLink
            :href="route('logout')"
            method="post"
            as="button"
            class="block px-4 py-2">
            Cerrar Sesión
          </NavLink>
        </nav>
      </div>
    </aside>

    <!-- Page Content -->
    <div class="flex-1">
      <main>
        <slot />
      </main>

      <!-- Toast Notifications -->
      <div
        v-if="$page.props.flash.message"
        class="fixed top-4 right-4 z-50">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
          {{ $page.props.flash.message }}
        </div>
      </div>

      <div
        v-if="$page.props.flash.error"
        class="fixed top-4 right-4 z-50">
        <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
          {{ $page.props.flash.error }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { Link } from "@inertiajs/vue3";
  import Dropdown from "@/Components/Dropdown.vue";
  import DropdownLink from "@/Components/DropdownLink.vue";
  import NavLink from "@/Components/NavLink.vue";
  import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

  // Importar iconos SVG
  import {
    HouseIcon,
    BackpackIcon,
    SchoolIcon,
    PersonsIcon,
    EditIcon
  } from "@/Components/Icons";

  import images from "../../images/index.js";

  export default {
    name: "AdminLayout",
    components: {
      Link,
      Dropdown,
      DropdownLink,
      NavLink,
      ResponsiveNavLink,
      HouseIcon,
      BackpackIcon,
      SchoolIcon,
      PersonsIcon,
      EditIcon
    },
    data() {
      return {
        showingNavigationDropdown: false,
        images
      };
    }
  };
</script>
