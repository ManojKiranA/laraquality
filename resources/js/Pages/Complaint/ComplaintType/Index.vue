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
            <action-button label="Create Complaint Type" :link="route('complaint-type.create')" action="submit"/>
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
                        <InputText type="text" v-model="filters['name']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by name"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Product Name</span>
                        <div class="flex flex-row items-center">
                            {{slotProps.data.name}}
                        </div>
                    </template>
                </Column>
                <!--Critical Level-->
                <Column field="critical_level" header="Critical Level" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <MultiSelect v-model="filters['critical_level']" :options="criticalLevel" optionLabel="name" optionValue="value" placeholder="All" class="flex w-full border-gray-300 rounded-md">
                            <template #option="slotProps">
                                <div class="p-multiselect-representative-option">
                                    <span :class="'text-'+slotProps.option.class+'-600 image-text'">{{slotProps.option.name}}</span>
                                </div>
                            </template>
                        </MultiSelect>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Critical Level</span>
                        <span v-if="slotProps.data.critical_level != null" :class="'p-2 rounded-md bg-'+criticalLevel[slotProps.data.critical_level].class+'-100 text-'+criticalLevel[slotProps.data.critical_level].class+'-600'">{{ criticalLevel[slotProps.data.critical_level].name }}</span>
                        <span v-else class="flex items-center px-2 text-red border border-red-500 py-1 rounded-md w-min"><warning class="w-5 h-5 text-red-500 mr-2"/>Undefined</span>
                    </template>
                </Column>
                <!--Related Department-->
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
    props: ['complaintTypes','departments'],
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
            criticalLevel: [
                {name: 'Minor', value: 0, class: 'green'},
                {name: 'Moderate', value: 1, class: 'yellow'},
                {name: 'Major', value: 2, class: 'indigo'},
                {name: 'Critical', value: 3, class: 'red'},
            ],
        }
    },
    methods: {
    }
}

</script>


