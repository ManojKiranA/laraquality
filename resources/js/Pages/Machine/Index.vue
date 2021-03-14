<template>
    <app-layout>
        <!--Header-->
        <template #header>
            Machines / Equipments
        </template>
        <!--Sub Header-->
        <template #sub-header>
            All of machines in your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Create New Machine / Equipment" :link="route('machine.create')" action="submit"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <DataTable
                :value="machines"
                :filters="filters"
                class="p-datatable-responsive-demo p-datatable p-component p-datatable-gridlines p-datatable-striped">
                <template #empty>
                    No machines/equipments found.
                </template>
                <template #loading>
                    Loading products data. Please wait.
                </template>
                <!--Code-->
                <Column field="code" header="Equipment Code" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['code']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by code"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Equipment Code</span>
                        {{slotProps.data.code}}
                    </template>
                </Column>
                <!--Name-->
                <Column field="name" header="Equipment Name" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['name']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by name"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <div class="flex flex-row items-center">
                            <span class="p-column-title">Equipment Name</span>
                            {{slotProps.data.name}}
                        </div>
                    </template>
                </Column>
                <!--Department-->
                <Column field="department_id" header="Related Department"  filterMatchMode="in">
                    <!--Filter-->
                    <template #filter>
                        <MultiSelect v-model="filters['department_id']" :options="departments" optionLabel="name" optionValue="id" placeholder="All" class="flex w-full border-gray-300 rounded-md">
                            <template #option="slotProps">
                                <div class="p-multiselect-representative-option">
                                    <span class="image-text">{{slotProps.option.name}}</span>
                                </div>
                            </template>
                        </MultiSelect>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Main Department</span>
                        {{slotProps.data.department.name}}
                    </template>
                </Column>
                <!--Machine Type-->
                <Column field="machineType" header="Machine Type" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['machineType']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by type"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Machine Type</span>
                        {{slotProps.data.machine_type.name}}
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
    props: ['machines','departments'],
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


