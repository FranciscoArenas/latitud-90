<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <Link :href="route('admin.dashboard')" class="text-xl font-bold text-indigo-600">
                                TravelCMS Admin
                            </Link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <NavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
                                Dashboard
                            </NavLink>
                            <NavLink :href="route('admin.programs.index')" :active="route().current('admin.programs.*')">
                                Programas
                            </NavLink>
                            <NavLink :href="route('admin.passengers.index')" :active="route().current('admin.passengers.*')">
                                Pasajeros
                            </NavLink>
                            <NavLink :href="route('admin.payments.index')" :active="route().current('admin.payments.*')">
                                Pagos
                            </NavLink>
                            <NavLink :href="route('admin.reports.index')" :active="route().current('admin.reports.*')">
                                Reportes
                            </NavLink>
                        </div>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- User Dropdown -->
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ $page.props.auth.user.name }}
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')">
                                    Perfil
                                </DropdownLink>
                                <DropdownLink :href="route('ecommerce.index')">
                                    Ver Sitio Web
                                </DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button">
                                    Cerrar Sesión
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
                        Dashboard
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('admin.programs.index')" :active="route().current('admin.programs.*')">
                        Programas
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('admin.passengers.index')" :active="route().current('admin.passengers.*')">
                        Pasajeros
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('admin.payments.index')" :active="route().current('admin.payments.*')">
                        Pagos
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('admin.reports.index')" :active="route().current('admin.reports.*')">
                        Reportes
                    </ResponsiveNavLink>
                </div>

                <!-- Mobile User Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.edit')">
                            Perfil
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('ecommerce.index')">
                            Ver Sitio Web
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                            Cerrar Sesión
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            <slot />
        </main>

        <!-- Toast Notifications -->
        <div v-if="$page.props.flash.message" class="fixed top-4 right-4 z-50">
            <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                {{ $page.props.flash.message }}
            </div>
        </div>

        <div v-if="$page.props.flash.error" class="fixed top-4 right-4 z-50">
            <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
                {{ $page.props.flash.error }}
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import NavLink from '@/Components/NavLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'

export default {
    name: 'AdminLayout',
    components: {
        Link,
        Dropdown,
        DropdownLink,
        NavLink,
        ResponsiveNavLink,
    },
    data() {
        return {
            showingNavigationDropdown: false,
        }
    },
}
</script>
