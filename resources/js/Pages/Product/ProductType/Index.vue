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
                <template #header>
                    <div class="table-header flex justify-between items-center">
                        List of Product Types
                        <span class="p-input-icon-left">
                            <i class="pi pi-search" />
                            <InputText v-model="filters['global']" placeholder="Global Search" />
                        </span>
                    </div>
                </template>
                <template #empty>
                    No customers found.
                </template>
                <!--Name-->
                <Column field="name" header="Product Type Name" filterMatchMode="contains">
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Product Name</span>
                        {{slotProps.data.name}}
                    </template>
                </Column>
                <!--Description-->
                <Column field="description" header="Description" filterMatchMode="contains">
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Product Description</span>
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


