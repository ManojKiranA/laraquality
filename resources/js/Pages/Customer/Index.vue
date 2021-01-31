<template>
    <app-layout>
        <!--Header-->
        <template #header>
            Customers
        </template>
        <!--Sub Header-->
        <template #sub-header>
            All of customers in your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Create New Customer" :link="route('customer.create')" action="submit"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <DataTable
                :value="customers"
                :filters="filters"
                class="p-datatable-responsive-demo p-datatable p-component p-datatable-gridlines p-datatable-striped">
                <template #empty>
                    No customer found.
                </template>
                <template #loading>
                    Loading customers data. Please wait.
                </template>
                <!--Name-->
                <Column field="name" header="Customer Name" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['name']" class="p-column-filter" placeholder="Search by name"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Product Name</span>
                        {{slotProps.data.name}}
                    </template>
                </Column>
                <!--Tax ID-->
                <Column field="tax_id" header="Tax ID" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['tax_id']" class="p-column-filter" placeholder="Search by tax id"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Tax ID</span>
                        {{slotProps.data.tax_id}}
                    </template>
                </Column>
                <!--Phone-->
                <Column field="phone" header="Phone" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['phone']" class="p-column-filter" placeholder="Search by phone"/>
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
                        <MultiSelect v-model="filters['status']" :options="status" optionLabel="name" optionValue="value" placeholder="All" class="p-column-filter">
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
import Calendar from 'primevue/calendar';
import Button from 'primevue/button';
import Chip from 'primevue/chip';
import Badge from 'primevue/badge';

export default {
    props: ['customers'],
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
        Calendar,
        Button,
        ActionButton,
        Chip,
        Badge
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


