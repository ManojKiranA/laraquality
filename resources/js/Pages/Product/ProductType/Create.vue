<template>
    <app-layout>
        <!--Header-->
        <template #header>
           Create New Product Type
        </template>
        <!--Sub Header-->
        <template #sub-header>
            You can new product type for your products
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Back to Product Types List" :link="route('product-type.index')" action="back"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <form-content @submitted="save" @reset="reset">
                <form-section
                title="Product Type Infos"
                description="You are going to create new product type for your products">
                    <!-- Name -->
                    <input-group label="Product Type Name" for="name" class="col-span-12">
                        <InputText id="name"  v-model="form.name"/>
                    </input-group>
                    <!-- Department -->
                    <input-group label="Department" for="department_id" class="col-span-12">
                        <Dropdown v-model="form.department_id" :options="departments" optionLabel="name" :filter="true" placeholder="Select a Department" :showClear="true" />
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
    props: ['departments','standards'],
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
            this.form.post(route('product-type.store'), {
                    errorBag: 'product-type',
                    preserveScroll: true,
            });
            this.reset();
        },
    },
}
</script>
