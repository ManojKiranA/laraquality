<template>
    <app-layout>
        <!--Header-->
        <template #header>
            Staff
        </template>
        <!--Sub Header-->
        <template #sub-header>
            All of staff in your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Create New Staff" :link="route('staff.create')" action="submit"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <DataTable
                :value="staff"
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
                        <InputText type="text" v-model="filters['name']" class="p-column-filter" placeholder="Search by name"/>
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
                        <InputText type="text" v-model="filters['department.name']" class="p-column-filter" placeholder="Search by department"/>
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
                        <InputText type="text" v-model="filters['job_description.name']" class="p-column-filter" placeholder="Search by job desc."/>
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
                        <MultiSelect v-model="filters['status']" :options="isStatus" optionLabel="name" optionValue="value" placeholder="All" class="p-column-filter">
                            <template #option="slotProps">
                                <div class="p-multiselect-representative-option">
                                    <span class="image-text">{{slotProps.option.name}}</span>
                                </div>
                            </template>
                        </MultiSelect>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Is certified?</span>
                        <span v-if="slotProps.data.status==0" class="px-2 text-white py-1 rounded-md bg-yellow-500">{{ isStatus[0].name }}</span>
                        <span v-if="slotProps.data.status==1" class="px-2 text-white py-1 rounded-md bg-green-500">{{ isStatus[1].name }}</span>
                        <span v-if="slotProps.data.status==2" class="px-2 text-white py-1 rounded-md bg-red-500">{{ isStatus[2].name }}</span>
                        <span v-if="slotProps.data.status==3" class="px-2 text-white py-1 rounded-md bg-blue-500">{{ isStatus[3].name }}</span>
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
import Badge from 'primevue/badge';

export default {
    props: ['staff'],
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
        Chip,
        Badge
    },
    data(){
        return {
            filters: {},
            content: [],
            isStatus:[
                {name:"Left",value:0},
                {name:"Active",value:1},
                {name:"Fired",value:2},
                {name:"Retired",value:3}
                ]
        }
    },
    methods: {
    }
}

</script>


