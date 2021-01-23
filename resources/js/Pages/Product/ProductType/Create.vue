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
                name : '',
                description : '',
            }),
            productType: [
                {name: 'Sample 1', value: 0},
                {name: 'Sample 2', value: 1},
                {name: 'Sample 3', value: 2}
            ],
            isCertified: [
                {name: 'Yes, It is certified', value: 1, icon: 'Checked',class: 'w-5 h-5 text-green-500 mr-2'},
                {name: 'Yes, It is\'t certified', value: 0, icon: 'XIcon',class: 'w-5 h-5 text-red-500 mr-2'}
            ]
        };
    },
    methods: {
        reset: function () {
            this.form.name = '';
            this.form.description = '';
        },
        save() {
            this.form.post(route('product-type.store'), {
                    errorBag: 'product',
                    preserveScroll: true,
            });
            this.reset();
        },


    },
}
</script>
