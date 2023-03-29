<script setup>
import { Head, Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {ref} from "vue";

const showingNavigationDropdown = ref(false);


defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Welcome" />

    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                logo
                            </div>

                            <!-- Navigation Links -->
                            <div v-if="canLogin" class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink v-if="$page.props.auth.user" :href="route('dashboard')">
                                    Dashboard
                                </NavLink>

                                <template v-else>
                                    <NavLink :href="route('login')">
                                        Log in
                                    </NavLink>

                                    <NavLink v-if="canRegister" :href="route('register')">
                                        Register
                                    </NavLink>
                                </template>
                            </div>
                        </div>
                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="mt-3 space-y-1">
                            <div v-if="canLogin">
                                <ResponsiveNavLink v-if="$page.props.auth.user" :href="route('dashboard')">
                                    Dashboard
                                </ResponsiveNavLink>

                                <template v-else>
                                    <ResponsiveNavLink :href="route('login')">
                                        Log in
                                    </ResponsiveNavLink>

                                    <ResponsiveNavLink v-if="canRegister" :href="route('register')">
                                        Register
                                    </ResponsiveNavLink>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <p class="display-6">Зарегистрируйтесь, или войдите.</p>
                            <p class="display-6">Отметьте слова которые хотите запомнить.</p>
                            <p class="display-6">Слушайте когда вам это удобно.</p>
                            <p class="display-6">Отметьте слова которые уже запомнили.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





</template>
