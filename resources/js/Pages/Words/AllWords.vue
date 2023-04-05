<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TableWords from "@/Components/TableWords.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import {all} from "axios";

let api = ref('all')

let props = defineProps({
    api: {
        type: String,
        default: 'all',
    }
})

function changeApi(newApi) {
    api.value = newApi
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="m-3 text-gray-900">
                        <PrimaryButton class="m-2" @click="changeApi('all')">
                            All
                        </PrimaryButton>
                        <PrimaryButton class="m-2" @click="changeApi('learn')">
                            Learn
                        </PrimaryButton>
                        <PrimaryButton class="m-2" @click="changeApi('learned')">
                            Learned
                        </PrimaryButton>
                        <TableWords :api="api">
                        </TableWords>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
