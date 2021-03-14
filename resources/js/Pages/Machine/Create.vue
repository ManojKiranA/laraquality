<template>
    <app-layout>
        <!--Header-->
        <template #header>
           Create New Machine
        </template>
        <!--Sub Header-->
        <template #sub-header>
            You can new machine for your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Back to Machine List" :link="route('machine.index')" action="back"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <form-content  @submitted="save"  @reset="reset" enctype='multipart/form-data'>
                <form-section
                title="Machine Infos"
                description="You are going to create new machine/equipment for your company">
                    <!-- Name -->
                    <input-group label="Machine Name" labelFor="name" class="col-span-12 md:col-span-6">
                        <InputText id="name"  v-model="form.name"/>
                        <Error :message="error.name"/>
                    </input-group>
                    <!-- Code -->
                    <input-group label="Machine Code" labelFor="code" class="col-span-12 md:col-span-6">
                        <InputText id="code"  v-model="form.code"/>
                        <Error :message="error.code"/>
                    </input-group>
                    <!-- Department -->
                    <input-group label="Related Department" labelFor="department_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.department_id" :options="departments" optionLabel="name" :filter="true" placeholder="Select a Department" :showClear="true"/>
                        <Error :message="error.department_id"/>
                    </input-group>
                    <!-- Machine Type-->
                    <input-group label="Machine Type" labelFor="machine_type_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.machine_type_id" :options="machineTypes" optionLabel="name" :filter="true" placeholder="Select Machine Type" :showClear="true"/>
                        <Error :message="error.machine_type_id"/>
                    </input-group>
                    <!-- Hierarchical Status-->
                    <input-group label="Hierarchical Status" labelFor="hierarchicalStatus" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.hierarchicalStatus" :options="hierarchicalStatusList" placeholder="Select Hierarchical Status" :showClear="true"/>
                        <Error :message="error.hierarchicalStatus"/>
                    </input-group>
                    <!-- Root Machine-->
                    <input-group label="Root Machine" labelFor="machine_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.machine_id" :options="machines" optionLabel="name" :filter="true" placeholder="Select a Root Machine" :showClear="true" :disabled="form.hierarchicalStatus == 'Root Machine' || !form.hierarchicalStatus"/>
                        <Error :message="error.machine_id"/>
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
    props: ['machines','machineTypes','departments'],
    components: {
        AppLayout,
        FormContent,
        FormSection,
        InputGroup,
        Error,
        InputText,
        Dropdown,
        SelectButton,
        ActionButton,
    },
    data() {
        return {
            photo_url:null,
            form: this.$inertia.form({
                _method: 'POST',
                name : null,
                hierarchicalStatus: null,
                code:null,
                department_id:null,
                machine_id:null,
                machine_type_id:null,
            }),
            error:{},
            hierarchicalStatusList: ["Root Machine","Sub Machine"]
        };
    },
    methods: {
        reset: function () {
            this.form.name = null;
            this.form.code=null;
            this.form.name = null;
            this.form.machine_type_id=null;
            this.form.department_id=null;
            this.form.hierarchicalStatus=null;
            this.form.machine_id=null;
        },
        save() {
            this.form.name === null ? this.$set(this.error, 'name', 'Machine name is required') : this.$set(this.error, 'name', '');
            this.form.code === null ? this.$set(this.error, 'code', 'Machine code is required') : this.$set(this.error, 'code', '');
            this.form.department_id === null ? this.$set(this.error, 'department_id', 'You should select a department') : this.$set(this.error, 'department_id', '');
            this.form.machine_type_id === null ? this.$set(this.error, 'machine_type_id', 'You should select a machine type') : this.$set(this.error, 'machine_type_id', '');
            this.form.hierarchicalStatus === null ? this.$set(this.error, 'hierarchicalStatus', 'You should select hierarchical status') : this.$set(this.error, 'hierarchicalStatus', '');
            this.form.hierarchicalStatus === "Sub Machine" &&  this.form.machine_id === null ? this.$set(this.error, 'machine_id', 'You should select a root machine') : this.$set(this.error, 'machine_id', '');
            if(this.form.name !== null &&
                this.form.code !== null &&
                this.form.department_id !== null &&
                this.form.machine_type_id !== null &&
                this.form.hierarchicalStatus !== null) {
                if(this.form.hierarchicalStatus === "Sub Machine" && this.form.machine_id !== null || this.form.hierarchicalStatus === "Root Machine"){
                    this.form.post(route('machine.store'), {
                        errorBag: 'machine',
                        preserveScroll: true,
                    });
                    this.loading = true;
                }
            }
        }
    },
}
</script>
