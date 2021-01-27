<template>
    <app-layout>
        <!--Header-->
        <template #header>
            Departments
        </template>
        <!--Sub Header-->
        <template #sub-header>
            All of departments in your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Create New Department" :link="route('department.create')" action="submit"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <DataTable
                :value="content"
                :filters="filters"
                rowGroupMode="subheader"
                groupRowsBy="department.name"
                sortMode="single"
                sortField="department.name"
                :sortOrder="1"
                class="p-datatable-responsive-demo p-datatable p-component p-datatable-gridlines p-datatable-striped">
                <template #empty>
                    No departments found.
                </template>
                <!--Name-->
                <Column field="name" header="Department Name" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['name']" class="p-column-filter" placeholder="Search by name"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Department Name</span>
                        {{slotProps.data.name}}
                    </template>
                </Column>
                <!--Main Department-->
                <Column field="department.name" header="Main Department" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['department.name']" class="p-column-filter" placeholder="Search by department"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Main Department</span>
                        {{slotProps.data.department.name}}
                    </template>
                </Column>
                <!--Manager-->
                <Column field="manager.name" header="Manager" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['manager.name']" class="p-column-filter" placeholder="Search by manager"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Manager</span>
                        <Chip v-if="slotProps.data.manager.profile_photo_path != null" :label="slotProps.data.manager.name" :image="'/storage/'+slotProps.data.manager.profile_photo_path" />
                        <Chip v-else :label="slotProps.data.manager.name" image="/images/general/dummy_user.svg" />
                    </template>
                </Column>
                <!--Complaint-->
                <Column field="is_complaint" header="Get a complaint?" filterMatchMode="in">
                    <!--Filter-->
                    <template #filter>
                        <MultiSelect v-model="filters['is_complaint']" :options="isStatus" optionLabel="name" optionValue="value" placeholder="All" class="p-column-filter">
                            <template #option="slotProps">
                                <div class="p-multiselect-representative-option">
                                    <span class="image-text">{{slotProps.option.name}}</span>
                                </div>
                            </template>
                        </MultiSelect>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Get a complaint?</span>
                        <yes v-if="slotProps.data.is_complaint==1" class="w-5 h-5 text-green-500"/>
                        <no v-if="slotProps.data.is_complaint==0" class="w-5 h-5 text-red-500"/>
                    </template>
                </Column>
                <!--Production-->
                <Column field="is_production" header="Make Production?"  filterMatchMode="in">
                    <!--Filter-->
                    <template #filter>
                        <MultiSelect v-model="filters['is_production']" :options="isStatus" optionLabel="name" optionValue="value" placeholder="All" class="p-column-filter">
                            <template #option="slotProps">
                                <div class="p-multiselect-representative-option">
                                    <span class="image-text">{{slotProps.option.name}}</span>
                                </div>
                            </template>
                        </MultiSelect>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Make Production?</span>
                        <yes v-if="slotProps.data.is_production==1" class="w-5 h-5 text-green-500"/>
                        <no v-if="slotProps.data.is_production==0" class="w-5 h-5 text-red-500"/>
                    </template>
                </Column>
                <template #groupheader="slotProps">
                    <span class="font-semibold bg-blue-400 text-white px-2 py-1">{{slotProps.data.department.name}}</span>
                </template>
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
    props: ['content'],
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
