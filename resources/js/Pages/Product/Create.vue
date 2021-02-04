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
            <form-content  @submitted="save"  @reset="reset" enctype='multipart/form-data'>
                <form-section
                title="Product Infos"
                description="You are going to create new product for your company">
                    <!-- Name -->
                    <input-group label="Product Name" labelFor="name" class="col-span-12 md:col-span-6">
                        <InputText id="name"  v-model="form.name"/>
                        <Error :message="error.name"/>
                    </input-group>
                    <!-- Code -->
                    <input-group label="Product Code" labelFor="code" class="col-span-12 md:col-span-6">
                        <InputText id="code"  v-model="form.code"/>
                        <Error :message="error.code"/>
                    </input-group>
                    <!-- Department -->
                    <input-group label="Related Department" labelFor="department_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.department_id" :options="departments" optionLabel="name" :filter="true" placeholder="Select a Department" :showClear="true" @change="productTypeChange" />
                        <Error :message="error.department_id"/>
                    </input-group>
                    <!-- Product Type-->
                    <input-group label="Product Type" labelFor="product_type_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.product_type_id" :options="productTypes" optionLabel="name" :filter="true" placeholder="Select Product Type" :showClear="true"/>
                        <Error :message="error.product_type_id"/>
                    </input-group>
                    <!-- Certified -->
                    <input-group label="Is it certified?" labelFor="is_certified" class="col-span-12 md:col-span-6">
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
                        <Error :message="error.is_certified"/>
                    </input-group>
                    <!-- Standard -->
                    <input-group label="Certified Standard" labelFor="standard_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.standard_id" :options="standards" :disabled="form.is_certified ===null || form.is_certified.value === 0" optionLabel="code" :filter="true" placeholder="Select a Standard" :showClear="true" />
                    </input-group>
                    <!-- Photo -->
                    <input-group label="Product Photo" labelFor="name" class="col-span-12 ">
                        <div class="flex flex-row w-full items-center">
                            <div class="relative flex">
                                <img :src="photo_url" v-if="form.photo" class="object-fill h-48 w-auto ring-1 ring-blue-400 rounded-sm" >
                                <button type="button" v-if="form.photo" @click="resetFile($event)" class="absolute flex right-2 top-2 px-2 cursor-pointer rounded-full bg-red-500 text-white ml-2 rounded-md shadow">x</button>
                            </div>
                            <button type="button" v-if="!form.photo" @click="$refs.photo.click()" class="flex p-2 bg-green-200 text-gray-700 border border-green-500 rounded-md hover:text-white hover:bg-green-400">+ Choose a file</button>

                            <label class="hidden">
                                Product Photo
                                <input type="file"  name="photo" id="photo" @change="processFile($event)" accept=".jpg, .jpeg, .png" ref="photo">
                            </label>
                        </div>
                    </input-group>
                    <!-- Description -->
                    <input-group label="Descripton" labelFor="description" class="col-span-12">
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
import Error from '@/Components/Form/Error'
import Checked from '@/Components/Icons/General/Checked'
import XIcon from '@/Components/Icons/General/XIcon'
import ActionButton from '@/Components/Buttons/ActionButton'
/*PrimeVue Models*/
import InputText from 'primevue/inputtext'
import Dropdown from 'primevue/dropdown';
import SelectButton from 'primevue/selectbutton';
import Textarea from 'primevue/textarea';
import FileUpload from 'primevue/fileupload';





export default {
    props: ['departments','standards','productTypes'],
    components: {
        AppLayout,
        FormContent,
        FormSection,
        InputGroup,
        Error,
        Checked,
        XIcon,
        InputText,
        Dropdown,
        SelectButton,
        ActionButton,
        Textarea,
        FileUpload,
    },
    data() {
        return {
            photo_url:null,
            form: this.$inertia.form({
                _method: 'POST',
                name : null,
                photo : null,
                code : null,
                department_id : null,
                product_type_id : null,
                description : null,
                is_certified : null,
                standard_id : null,
            }),
            error:{},
            isCertified: [
                {name: 'Yes, It is certified', value: 1, icon: 'Checked',class: 'w-5 h-5 text-green-500 mr-2'},
                {name: 'No, It is\'t certified', value: 0, icon: 'XIcon',class: 'w-5 h-5 text-red-500 mr-2'}
            ]
        };
    },
    methods: {
        reset: function () {
            this.form.name = null;
            this.form.photo = null;
            this.form.photo_uzunluk = null;
            this.form.code = null;
            this.form.department_id = null;
            this.form.product_type_id = null;
            this.form.description = null;
            this.form.is_certified = null;
            this.form.standard_id = null;
        },
        save() {
            this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$set(this.error, 'name', '');
            this.form.code === null ? this.$set(this.error, 'code', 'Product code is required') : this.$set(this.error, 'code', '');
            this.form.department_id === null ? this.$set(this.error, 'department_id', 'You should select a department') : this.$set(this.error, 'department_id', '');
            this.form.product_type_id === null ? this.$set(this.error, 'product_type_id', 'You should select a product type') : this.$set(this.error, 'product_type_id', '');
            this.form.is_certified === null ? this.$set(this.error, 'is_certified', 'You should select a certification status') : this.$set(this.error, 'is_certified', '');
            if(this.form.name !== null && this.form.code !== null && this.form.department_id !== null && this.form.product_type_id !== null && this.form.is_certified !== null) {
                this.form.post(route('product.store'), {
                    errorBag: 'product',
                    preserveScroll: true,
                });
                this.loading = true;
            }
        },
        productTypeChange(){
            this.$inertia.reload( {
                method: 'get',
                data: {departmentId :this.form.department_id.id},
                replace: true,
                preserveState: true,
                preserveScroll: true,
                only: ['productTypes','standards'],
            })
        },
        processFile($event) {
/*
            this.form.photo = event.target.files[0]
*/
            this.form.photo = document.getElementById("photo").files[0];
            this.photo_url = URL.createObjectURL(document.getElementById("photo").files[0]);
            console.log(photo_url);

        },
        resetFile($value){
            document.getElementById("photo").value = null;
            this.form.photo = null;
        }


    },
}
</script>
