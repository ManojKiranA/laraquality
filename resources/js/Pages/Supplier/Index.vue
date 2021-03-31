<template>
    <app-layout>
        <!--Header-->
        <template #header>
            Supplier
        </template>
        <!--Sub Header-->
        <template #sub-header>
            All of suppliers in your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Create New Supplier" :link="route('supplier.create')" action="submit"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <DataTable
                :value="suppliers"
                :filters="filters"
                class="p-datatable-responsive-demo p-datatable p-component p-datatable-gridlines p-datatable-striped">
                <template #empty>
                    No supplier found.
                </template>
                <template #loading>
                    Loading suppliers data. Please wait.
                </template>
                <!--Name-->
                <Column field="name" header="Supplier Name" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['name']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by name"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Supplier Name</span>
                        {{slotProps.data.name}}
                    </template>
                </Column>
                <!--Phone-->
                <Column field="phone" header="Phone" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['phone']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by phone"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Phone</span>
                        {{slotProps.data.phone}}
                    </template>
                </Column>
                <!--Status-->
                <Column field="status" header="Status" filterMatchMode="in">
                    <!--Filter-->
                    <template #filter>
                        <MultiSelect v-model="filters['status']" :options="status" optionLabel="name" optionValue="value" placeholder="All" class="flex w-full border-gray-300 rounded-md">
                            <template #option="slotProps">
                                <div class="p-multiselect-representative-option">
                                    <span class="image-text">{{slotProps.option.name}}</span>
                                </div>
                            </template>
                        </MultiSelect>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Status</span>
                        <span v-if="slotProps.data.status != null" :class="status[slotProps.data.status].class">{{ status[slotProps.data.status].name }}</span>
                        <span v-else class="flex items-center px-2 text-red border border-red-500 py-1 rounded-md w-min"><warning class="w-5 h-5 text-red-500 mr-2"/>Undefined</span>
                    </template>
                </Column>
            </DataTable>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ActionButton from'@/Components/Buttons/ActionButton'
import Yes from'@/Components/Icons/General/Checked'
import No from'@/Components/Icons/General/XIcon'
import Warning from'@/Components/Icons/General/Warning'

/*PrimeVue Models*/
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import ProgressBar from 'primevue/progressbar';
import MultiSelect from 'primevue/multiselect';
import Button from 'primevue/button';

export default {
    props: ['suppliers'],
    components: {
        AppLayout,
        DataTable,
        Column,
        ColumnGroup,
        InputText,
        Dropdown,
        ProgressBar,
        MultiSelect,
        Yes,
        No,
        Warning,
        Button,
        ActionButton,
    },
    data(){
        return {
            filters: {},
            status: [
                {name: 'Passive', value: 0, icon: 'XIcon',class: 'px-2 text-white py-1 rounded-md bg-yellow-500'},
                {name: 'Active', value: 1, icon: 'Checked',class: 'px-2 text-white py-1 rounded-md bg-green-500'}
            ]
        }
    },
    methods: {
    }
}

</script>


