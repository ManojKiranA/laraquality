<template>
    <app-layout>
        <!--Header-->
        <template #header>
            Complaint Types
        </template>
        <!--Sub Header-->
        <template #sub-header>
            All of complaint types for the claims
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Create New Complaint Type" :link="route('complaint-type.create')" action="submit"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <DataTable
                :value="complaintTypes"
                :filters="filters"
                class="p-datatable-responsive-demo p-datatable p-component p-datatable-gridlines p-datatable-striped">
                <template #empty>
                    No staff found.
                </template>
                <template #loading>
                    Loading products data. Please wait.
                </template>
                <!--Name-->
                <Column field="name" header="Staff Name" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['name']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by name"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Product Name</span>
                        <div class="flex flex-row items-center">
                            <img v-if="slotProps.data.profile_photo_path" :src="'/storage/'+slotProps.data.profile_photo_path" class="w-6 h-6 rounded-full mr-2 inline-block"/>
                            <img v-else src="/images/general/dummy_user.svg" class="w-6 h-6 rounded-full mr-2"/>
                            {{slotProps.data.name}}
                        </div>
                    </template>
                </Column>
                <!--Department-->
                <Column field="department.name" header="Department" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['department.name']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by department"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Department</span>
                        {{slotProps.data.department.name}}
                    </template>
                </Column>
                <!--Job Description-->
                <Column field=job_description.name header="Job Description" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['job_description.name']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by job desc."/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Job Description</span>
                        {{slotProps.data.job_description.name}}
                    </template>
                </Column>
                <!--Status-->
                <Column field="status" header="Status" filterMatchMode="in">
                    <!--Filter-->
                    <template #filter>
                        <MultiSelect v-model="filters['status']" :options="employmentStatus" optionLabel="name" optionValue="value" placeholder="All" class="flex w-full border-gray-300 rounded-md">
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
                        <span v-if="slotProps.data.status != null" :class="employmentStatus[slotProps.data.status].class">{{ employmentStatus[slotProps.data.status].name }}</span>
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


