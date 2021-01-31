<template>
    <app-layout>
        <!--Header-->
        <template #header>
            Products Types
        </template>
        <!--Sub Header-->
        <template #sub-header>
            All of products types in your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Create New Product Type" :link="route('product-type.create')" action="submit"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <DataTable
                :value="productTypes"
                :filters="filters"
                :resizableColumns="true"
                columnResizeMode="fit"
                class="p-datatable-responsive-demo p-datatable p-component p-datatable-gridlines p-datatable-striped">
                <template #empty>
                    No product types found.
                </template>
                <template #loading>
                    Loading product type data. Please wait.
                </template>
                <template #empty>
                    No customers found.
                </template>
                <!--Name-->
                <Column field="name" header="Product Type Name" filterMatchMode="contains">
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
                <!--Department-->
                <Column field="department.name" header="Department" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['department.name']" class="p-column-filter" placeholder="Search by department"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Department</span>
                        {{slotProps.data.department.name}}
                    </template>
                </Column>
                <!--Description-->
                <Column field="description" header="Description" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['description']" class="p-column-filter" placeholder="Search by descripton"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Product Type Description</span>
                        {{slotProps.data.description}}
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

export default {
    props: ['productTypes'],
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
        Calendar,
        Button,
        ActionButton,
        Chip
    },
    data(){
        return {
            filters: {},
            content: [],
            isStatus:[
                {name:"Yes",value:1},
                {name:"No",value:0}
                ]
        }
    },
    methods: {
    }
}

</script>


