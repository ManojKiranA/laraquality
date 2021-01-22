<template>
    <app-layout>
        <!--Header-->
        <template #header>
           Create New Product
        </template>
        <!--Sub Header-->
        <template #sub-header>
            You can new product for your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Back to Products List" :link="route('product.index')" action="back"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <form-content  @submitted="save"  @reset="reset">
                <form-section
                title="Product Infos"
                description="You are going to create new product for your company">
                    <!-- Name -->
                    <input-group label="Product Name" for="name" class="col-span-12 md:col-span-6">
                        <InputText id="name"  v-model="form.name"/>
                    </input-group>
                    <!-- Code -->
                    <input-group label="Product Code" for="code" class="col-span-12 md:col-span-6">
                        <InputText id="code"  v-model="form.code"/>
                    </input-group>
                    <!-- Product Type-->
                    <input-group label="Product Type" for="product_type" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.product_type" :options="productTypes" optionLabel="name" :filter="true" placeholder="Select Product Type" :showClear="true"/>
                    </input-group>
                    <!-- Department -->
                    <input-group label="Related Department" for="department_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.department_id" :options="departments" optionLabel="name" :filter="true" placeholder="Select a Department" :showClear="true" />
                    </input-group>
                    <!-- Certified -->
                    <input-group label="Is it certified?" for="is_certified" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.is_certified" :options="isCertified" optionLabel="name" placeholder="Select" :showClear="true">
                            <!--Chosen Item-->
                            <template #value="slotProps">
                                <div class="flex flex-row items-center" v-if="slotProps.value">
                                    <!--Icon-->
                                    <component v-bind:is="slotProps.value.icon" :class="slotProps.value.class"></component>
                                    <!--Name-->
                                    <div>{{slotProps.value.name}}</div>
                                </div>
                                <span v-else>
                                    {{slotProps.placeholder}}
                                </span>
                            </template>
                            <!--Item in The Opened List-->
                            <template #option="slotProps">
                                <div class="flex flex-row items-center">
                                    <!--Icon-->
                                    <component v-bind:is="slotProps.option.icon" :class="slotProps.option.class"></component>
                                    <!--Name-->
                                    <div>{{slotProps.option.name}}</div>
                                </div>
                            </template>
                        </Dropdown>
                    </input-group>
                    <!-- Standard -->
                    <input-group label="Certified Standard" for="standard_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.standard_id" :options="standards" optionLabel="code" :filter="true" placeholder="Select a Standard" :showClear="true" />
                    </input-group>
                    <!-- Description -->
                    <input-group label="Descripton" for="name" class="col-span-12">
                        <Textarea id="description" v-model="form.description" rows="3" cols="30" />
                    </input-group>
                </form-section>
            </form-content>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import FormContent from '@/Components/Form/FormContent'
import FormSection from '@/Components/Form/FormSection'
import InputGroup from '@/Components/Form/InputGroup'
import Checked from '@/Components/Icons/General/Checked'
import XIcon from '@/Components/Icons/General/XIcon'
import ActionButton from '@/Components/Buttons/ActionButton'
/*PrimeVue Models*/
import InputText from 'primevue/inputtext'
import Dropdown from 'primevue/dropdown';
import SelectButton from 'primevue/selectbutton';
import Textarea from 'primevue/textarea';



export default {
    props: ['departments','standards','productTypes'],
    components: {
        AppLayout,
        FormContent,
        FormSection,
        InputGroup,
        Checked,
        XIcon,
        InputText,
        Dropdown,
        SelectButton,
        ActionButton,
        Textarea
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name : '',
                code : '',
                department_id : '',
                product_type : '',
                description : '',
                is_certified : '',
                standard_id : '',
            }),
            isCertified: [
                {name: 'Yes, It is certified', value: 1, icon: 'Checked',class: 'w-5 h-5 text-green-500 mr-2'},
                {name: 'Yes, It is\'t certified', value: 0, icon: 'XIcon',class: 'w-5 h-5 text-red-500 mr-2'}
            ]
        };
    },
    methods: {
        reset: function () {
            this.form.name = '';
            this.form.code = '';
            this.form.department_id = '';
            this.form.product_type = '';
            this.form.description = '';
            this.form.is_certified = '';
            this.form.standard_id = '';
        },
        save() {
            this.form.post(route('product.store'), {
                    errorBag: 'product',
                    preserveScroll: true,
            });
            this.reset();
        },


    },
}
</script>
