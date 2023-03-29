<script setup>
import  TableLite from "@/Components/TableLite.vue";
import {createRenderer, defineComponent, onMounted, reactive, ref, watch} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineComponent(TableLite)

const props = defineProps({
    api: {
        type: String,
        default: '',
    }
})

watch(() => props.api, (first, second) => {
    doSearch(0, 10, 'word', 'asc', 1);
})

const table = reactive({
    isLoading: false,
    columns: [
        {
            label: "Word",
            field: "word",
            width: "5%",
            sortable: true,
            isKey: false,
        },
        {
            label: "Transcription",
            field: "transcription",
            width: "5%",
            sortable: false,
        },
        {
            label: "Translate",
            field: "translate",
            width: "15%",
            sortable: false,
        },
        {
            label: "action",
            field: "quick",
            width: "10%",

        },
    ],
    rows: [],
    totalRecordCount: 0,
    sortable: {
        order: "word",
        sort: "asc",
    },
});
/**
 * Search Event
 */
const actionWithWord = (id, action) => {
    axios({
        method: "get",
        url: 'api/enWords/action/?idWord=' + id + '&action=' + action
    }).then((response) => {
        //
    }).catch((response) => {
        console.log(response)
    })
}
const doSearch = (offset, limit, order, sort, page) => {
    table.isLoading = true;
    axios({
        method: "get",
        url: `api/enWords/${props.api}/?offset=` + offset
            + '&limit=' + limit
            + '&order=' + order
            + '&sort=' + sort
            + '&page=' + page
    }).then((response) => {
        table.isReSearch = offset == undefined ? true : false;
        table.rows = response.data.data
        table.totalRecordCount = response.data.meta.total
    }).catch((response) => {
        console.log(response)
    })
};
// First get data
doSearch(0, 10, 'word', 'asc', 1);

</script>

<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table-lite
                        :is-loading="table.isLoading"
                        :is-slot-mode="true"
                        :columns="table.columns"
                        :rows="table.rows"
                        :pageSize="10"
                        :total="table.totalRecordCount"
                        :sortable="table.sortable"
                        :messages="table.messages"
                        @do-search="doSearch"
                        @is-finished="table.isLoading = false"
                    >
                        <template v-slot:quick="data">
                            <PrimaryButton
                                v-show="api === 'all' || api === 'learned'"
                                @click="actionWithWord(data.value.id, 'learn')"
                            >Learn</PrimaryButton>
                            <PrimaryButton
                                v-show="api === 'all'"
                                @click="actionWithWord(data.value.id, 'known')"
                            >Known</PrimaryButton>
                            <PrimaryButton
                                v-show="api === 'learn'"
                                @click="actionWithWord(data.value.id, 'learned')"
                            >Learned</PrimaryButton>
                        </template>
                    </table-lite>
                </div>
            </div>
        </div>
    </div>
</template>
