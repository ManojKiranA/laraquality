<template>
    <app-layout>
        <!--Header-->
        <template #header>
           Create New Raw Material
        </template>
        <!--Sub Header-->
        <template #sub-header>
            You can new raw material for your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Back to Raw Material List" :link="route('raw-material.index')" action="back"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <form-content  @submitted="save"  @reset="reset" enctype='multipart/form-data'>
                <form-section
                title="Identity Info"
                description="Raw material identity">
                    <!-- Department -->
                    <input-group label="Related Department" labelFor="department_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.department_id" :options="departments" optionLabel="name" :filter="true" placeholder="Select a Department" :showClear="true"  @change="rawMaterialTypeChange" />
                        <Error :message="error.department_id"/>
                    </input-group>
                    <!-- Raw Material Type-->
                    <input-group label="Raw Material Type" labelFor="raw_material_type_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.raw_material_type_id" :options="rawMaterialTypes" optionLabel="name" :filter="true" placeholder="Select Raw Material Type" :showClear="true"/>
                        <Error :message="error.raw_material_type_id"/>
                    </input-group>
                    <!-- Code -->
                    <input-group label="Raw Material Code" labelFor="code" class="col-span-12">
                        <InputText id="code"  v-model="form.code"/>
                        <Error :message="error.code"/>
                    </input-group>
                    <!-- Name -->
                    <input-group label="Raw Material Name" labelFor="name" class="col-span-12">
                        <InputText id="name"  v-model="form.name"/>
                        <Error :message="error.name"/>
                    </input-group>
                    <!-- Manufacturer -->
                    <input-group label="Raw Material Manufacturer" labelFor="manufacturer" class="col-span-12 md:col-span-6">
                        <InputText id="manufacturer"  v-model="form.manufacturer"/>
                    </input-group>
                    <!-- Model -->
                    <input-group label="Raw Material Model" labelFor="model" class="col-span-12 md:col-span-6">
                        <InputText id="model"  v-model="form.model"/>
                    </input-group>
                </form-section>
                <form-section
                title="Other Infos"
                description="About raw material">
                    <!-- Supplier -->
                    <input-group label="Supplier" labelFor="supplier_id" class="col-span-12">
                        <Dropdown v-model="form.supplier_id" :options="suppliers" optionLabel="name" :filter="true" placeholder="Select a Supplier" :showClear="true"/>
                        <Error :message="error.supplier_id"/>
                    </input-group>
                    <!-- Package Type -->
                    <input-group label="Package Type" labelFor="package_type" class="col-span-12">
                        <InputRepeatable id="package_type"  v-model="form.package_type" placeHolderText="Package Type"/>
                    </input-group>
                    <!-- Storage Condition -->
                    <input-group label="Storage Condition" labelFor="storage_condition" class="col-span-12">
                        <InputRepeatable id="storage_condition"  v-model="form.storage_condition" placeHolderText="Storage Condition"/>
                    </input-group>
                    <!-- Description -->
                    <input-group label="Description" labelFor="description" class="col-span-12">
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
import InputRepeatable from '@/Components/Form/Inputs/InputInlineEditableRepeatable'
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
    props: ['departments','standards','rawMaterialTypes','suppliers'],
    components: {
        AppLayout,
        FormContent,
        FormSection,
        InputGroup,
        InputRepeatable,
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
                code : null,
                model : null,
                manufacturer : null,
                raw_material_type_id : null,
                storage_condition : [],
                package_type : [],
                department_id : null,
                supplier_id : null,
                description : null,
            }),
            error:{},
        };
    },
    methods: {
        reset: function () {
            this.form.name = null;
            this.form.code = null;
            this.form.model = null;
            this.form.manufacturer = null;
            this.form.raw_material_type_id = null;
            this.form.storage_condition = [];
            this.form.package_type = [];
            this.form.department_id = null;
            this.form.supplier_id = null;
            this.form.description = null;
        },
        save() {
            this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$set(this.error, 'name', '');
            this.form.code === null ? this.$set(this.error, 'code', 'Raw material code is required') : this.$set(this.error, 'code', '');
            this.form.raw_material_type_id === null ? this.$set(this.error, 'raw_material_type_id', 'You should select a raw material type') : this.$set(this.error, 'raw_material_type_id', '');
            this.form.department_id === null ? this.$set(this.error, 'department_id', 'You should select a department') : this.$set(this.error, 'department_id', '');
            this.form.supplier_id === null ? this.$set(this.error, 'supplier_id', 'You should select a supplier') : this.$set(this.error, 'supplier_id', '');
            if(this.form.name !== null && this.form.code !== null && this.form.raw_material_type_id !== null && this.form.department_id !== null && this.form.manufacturer_id !== null) {
                this.form.post(route('raw-material.store'), {
                    errorBag: 'raw-material',
                    preserveScroll: true,
                });
                this.loading = true;
            }
        },
        rawMaterialTypeChange(){
            this.$inertia.reload( {
                method: 'get',
                data: {departmentId :this.form.department_id.id},
                replace: true,
                preserveState: true,
                preserveScroll: true,
                only: ['rawMaterialTypes'],
            })
        },
    },
}
</script>
