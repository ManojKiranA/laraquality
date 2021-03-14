<template>
    <app-layout>
        <!--Header-->
        <template #header>
            Machine Types
        </template>
        <!--Sub Header-->
        <template #sub-header>
            All of machine types in your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Create New Machine Type" :link="route('machine-type.create')" action="submit"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <DataTable
                :value="machineTypes"
                :filters="filters"
                :resizableColumns="true"
                columnResizeMode="fit"
                class="p-datatable-responsive-demo p-datatable p-component p-datatable-gridlines p-datatable-striped">
                <template #empty>
                    No machine types found.
                </template>
                <template #loading>
                    Loading machine type data. Please wait.
                </template>
                <!--Name-->
                <Column field="name" header="Machine Type Name" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['name']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by name"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Machine Name</span>
                        {{slotProps.data.name}}
                    </template>
                </Column>
                <!--Description-->
                <Column field="description" header="Description" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['description']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by descripton"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Machine Type Description</span>
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
    props: ['machineTypes'],
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
        }
    },
    methods: {
    }
}

</script>


