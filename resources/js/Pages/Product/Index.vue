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
                :value="products.data"
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
                        <InputText type="text" v-model="filters['code']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by code"/>
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
                        <InputText type="text" v-model="filters['name']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by name"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <div class="flex flex-row items-center">
                            <span class="p-column-title">Product Name</span>
                            <div class="flex flex-shrink-0 justify-center w-12 h-12 border rounded-sm mr-2 bg-gray-200">
                                <img v-if="slotProps.data.photo" :src="slotProps.data.photo" class="object-fill w-auto h-auto"/>
                                <div v-else class="w-10 h-10 border rounded-md mr-2 bg-gray-200"></div>
                            </div>
                            {{slotProps.data.name}}
                        </div>
                    </template>
                </Column>
                <!--Department-->
                <Column field="department_id" header="Main Department"  filterMatchMode="in">
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
                        {{slotProps.data.department}}
                    </template>
                </Column>
                <!--Product Type-->
                <Column field="productType" header="Product Type" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['productType']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by type"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Product Type</span>
                        {{slotProps.data.productType}}
                    </template>
                </Column>
                <!--Standard-->
                <Column field="standard" header="Standard" filterMatchMode="contains">
                    <!--Filter-->
                    <template #filter>
                        <InputText type="text" v-model="filters['standard']" class="flex w-full border-gray-300 rounded-md" placeholder="Search by standard"/>
                    </template>
                    <!--Content-->
                    <template #body="slotProps">
                        <span class="p-column-title">Standard</span>
                        {{slotProps.data.standard}}
                    </template>
                </Column>
                <!--Certified-->
                <Column field="is_certified" header="Is certified?" filterMatchMode="in">
                    <!--Filter-->
                    <template #filter>
                        <MultiSelect v-model="filters['is_certified']" :options="isStatus" optionLabel="name" optionValue="value" placeholder="All" class="flex w-full border-gray-300 rounded-md">
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
                        <div  class="flex w-full justify-center items-center">
                        <yes v-if="slotProps.data.is_certified==1" class="w-5 h-5 text-green-500"/>
                        <no v-if="slotProps.data.is_certified==0" class="w-5 h-5 text-red-500"/>
                        </div>
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
    props: ['products','departments'],
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


