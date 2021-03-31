<template>
    <app-layout>
        <!--Header-->
        <template #header>
           Create New Raw Material Type
        </template>
        <!--Sub Header-->
        <template #sub-header>
            You can new raw material type for your products
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Back to Raw Material Types List" :link="route('raw-material-type.index')" action="back"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <form-content @submitted="save" @reset="reset">
                <form-section
                title="Raw Material Type Infos"
                description="You are going to create new raw material type for your products and raw materials">
                    <!-- Name -->
                    <input-group label="Raw Material Type Name" labelFor="name" class="col-span-12">
                        <InputText id="name"  v-model="form.name"/>
                        <Error :message="error.name"/>
                    </input-group>
                    <!-- Related Department -->
                    <input-group label="Related Department" labelFor="department_id" class="col-span-12">
                        <Dropdown v-model="form.department_id" :options="departments" optionLabel="name" :filter="true" placeholder="Select a Department" :showClear="true" />
                        <Error :message="error.department_id"/>
                    </input-group>
                    <!-- Description -->
                    <input-group label="Descripton" labelFor="name" class="col-span-12">
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
import Error from '@/Components/Form/Error'
/*PrimeVue Models*/
import InputText from 'primevue/inputtext'
import Dropdown from 'primevue/dropdown';
import SelectButton from 'primevue/selectbutton';
import Textarea from 'primevue/textarea';



export default {
    props: ['departments'],
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
        Textarea,
        Error
    },
    data() {
        return {
            loading: false,
            error:{},
            form: this.$inertia.form({
                _method: 'POST',
                name : null,
                department_id : null,
                description : null,
            })
        };
    },
    methods: {
        reset: function () {
            this.form.name = null;
            this.form.department_id = null;
            this.form.description = null;
        },
        save() {
            this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$set(this.error, 'name', '');
            this.form.department_id === null ? this.$set(this.error, 'department_id', 'You should select a department') : this.$set(this.error, 'department_id', '');
            if(this.form.name !== null && this.form.department_id !== null) {
                this.form.post(route('raw-material-type.store'), {
                    errorBag: 'raw-material-type',
                    preserveScroll: true,
                });
                this.loading = true;
                this.reset();
            }
        },
    },
}
</script>
