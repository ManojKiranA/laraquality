<template>
    <app-layout>
        <!--Header-->
        <template #header>
            Job Descriptions
        </template>
        <!--Sub Header-->
        <template #sub-header>
            All of job descriptions in your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Create New Job Description" :link="route('job-description.create')" action="submit"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <DataTable
                :value="jobDescriptions"
                :filters="filters"
                class="p-datatable-responsive-demo p-datatable p-component p-datatable-gridlines p-datatable-striped">
                <template #empty>
                    No job descriptions found.
                </template>
                <!--Name-->
                <Column field="name" header="Title" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['name']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by name"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Department Name</span>
                        {{slotProps.data.name}}
                    </template>
                </Column>
                <!--Collar Type-->
                <Column field="collar_type" header="Collar Type" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <MultiSelect v-model="filters['collar_type']" :options="collarType" optionLabel="name" optionValue="value" placeholder="All" class="flex w-full border-gray-300 rounded-md">
                            <template #option="slotProps">
                                <div class="p-multiselect-representative-option">
                                    <span class="image-text">{{slotProps.option.name}}</span>
                                </div>
                            </template>
                        </MultiSelect>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Collar Type</span>
                        {{slotProps.data.collar_type === 0 ? 'White Collar' : 'Blue Collar'}}
                    </template>
                </Column>
                <!--Related Department-->
                <Column field="department.name" header="Related Department" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['department.name']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by department"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Related Department</span>
                        {{ slotProps.data.department.name }}
                    </template>
                </Column>
            </DataTable>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ActionButton from'@/Components/Buttons/ActionButton'

/*PrimeVue Models*/
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';
import MultiSelect from 'primevue/multiselect';


export default {
    props: ['jobDescriptions'],
    components: {
        AppLayout,
        ActionButton,
        DataTable,
        Column,
        InputText,
        MultiSelect,
    },
    data(){
        return {
            filters: {},
            collarType: [
                {name: 'White Collar', value: 0, icon: 'WhiteCollar',class: 'w-5 h-5 text-gray-500 mr-2'},
                {name: 'Blue Collar', value: 1, icon: 'BlueCollar',class: 'w-5 h-5 text-blue-500 mr-2'}
            ]
        }
    },
    methods: {
    }
}
</script>
