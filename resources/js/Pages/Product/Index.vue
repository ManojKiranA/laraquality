<template>
    <app-layout>
        <!--Header-->
        <template #header>
            Products
        </template>
        <!--Sub Header-->
        <template #sub-header>
            All of products in your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Create New Product" :link="route('product.create')" action="submit"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <DataTable
                :value="products"
                :filters="filters"
                class="p-datatable-responsive-demo p-datatable p-component p-datatable-gridlines p-datatable-striped">
                <template #empty>
                    No products found.
                </template>
                <template #loading>
                    Loading products data. Please wait.
                </template>
                <!--Code-->
                <Column field="code" header="Product Code" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['code']" class="p-column-filter" placeholder="Search by code"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Product Code</span>
                        {{slotProps.data.code}}
                    </template>
                </Column>
                <!--Name-->
                <Column field="name" header="Product Name" filterMatchMode="contains">
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
                <!--Product Type-->
                <Column field="product_type.name" header="Product Type" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['product_type']" class="p-column-filter" placeholder="Search by type"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Product Type</span>
                        {{slotProps.data.product_type.name}}
                    </template>
                </Column>
                <!--Standard-->
                <Column field="standard.code" header="Standard" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['standard.code']" class="p-column-filter" placeholder="Search by standard"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Standard</span>
                        {{slotProps.data.standard.code}}
                    </template>
                </Column>
                <!--Certified-->
                <Column field="is_certified" header="Is certified?" filterMatchMode="in">
                    <!--Filter-->
                    <template #filter>
                        <MultiSelect v-model="filters['is_certified']" :options="isStatus" optionLabel="name" optionValue="value" placeholder="All" class="p-column-filter">
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
                        <yes v-if="slotProps.data.is_certified==1" class="w-5 h-5 text-green-500"/>
                        <no v-if="slotProps.data.is_certified==0" class="w-5 h-5 text-red-500"/>
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
    props: ['products'],
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


