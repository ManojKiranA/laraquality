<template>
    <app-layout>
        <!--Header-->
        <template #header>
            Complaint Types
        </template>
        <!--Sub Header-->
        <template #sub-header>
            All of complaint types in your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Create New Staff" :link="route('complaint-type.create')" action="submit"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <DataTable
                :value="complaintTypes"
                :filters="filters"
                class="p-datatable-responsive-demo p-datatable p-component p-datatable-gridlines p-datatable-striped">
                <template #empty>
                    No complaint type found.
                </template>
                <template #loading>
                    Loading complaint type data. Please wait.
                </template>
                <!--Name-->
                <Column field="critical_status" header="Complaint Type" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['name']" class="p-column-filter" placeholder="Search by name"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Product Name</span>
                        <div class="flex flex-row items-center">
                            {{slotProps.data.name}}
                        </div>
                    </template>
                </Column>
                <!--Critical Status-->
                <Column field="critical_status" header="Critical Status" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['critical_status']" class="p-column-filter" placeholder="Search by critically"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Critical Status</span>
                        {{slotProps.data.critical_status}}
                    </template>
                </Column>
                <!--Related Department-->
                <Column field=department.name header="Related Department" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['department.name']" class="p-column-filter" placeholder="Search by department"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Related Department</span>
                        {{slotProps.data.department.name}}
                    </template>
                </Column>
            </DataTable>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ActionButton from '@/Components/Buttons/ActionButton'
import Yes from '@/Components/Icons/General/Checked'
import No from '@/Components/Icons/General/XIcon'
import Warning from '@/Components/Icons/General/Warning'

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
    props: ['complaintTypes'],
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
            content: [],
            employmentStatus:[
                {name:"Left",value:0,class:'px-2 text-white py-1 rounded-md bg-yellow-500'},
                {name:"Active",value:1,class:'px-2 text-white py-1 rounded-md bg-green-500'},
                {name:"Fired",value:2,class:'px-2 text-white py-1 rounded-md bg-red-500'},
                {name:"Retired",value:3,class:'px-2 text-white py-1 rounded-md bg-blue-500'}
                ]
        }
    },
    methods: {
    }
}

</script>


