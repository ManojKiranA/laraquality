<template>
    <app-layout>
        <!--Header-->
        <template #header>
           Create New Staff
        </template>
        <!--Sub Header-->
        <template #sub-header>
            You can new staff for your conullmpany
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Back to Staff List" :link="route('staff.index')" action="back"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <form-content @submitted="save" @reset="reset">
                <form-section
                title="Personal Infos"
                description="This information is subject to personal data protection law.">
                    <!-- Name -->
                    <input-group label="Name" for="name" class="col-span-12 md:col-span-6">
                        <InputText id="name"  v-model="form.name"/>
                    </input-group>
                    <!-- Tax ID -->
                    <input-group label="Tax ID" for="tax_id" class="col-span-12 md:col-span-6">
                        <InputText id="tax_id"  v-model="form.tax_id"/>
                    </input-group>
                    <!-- Phone -->
                    <input-group label="Phone" for="phone" class="col-span-12 md:col-span-6">
                        <InputMask id="phone" name="phone" v-model="form.phone"  mask="+99(999) 999-9999" />
                    </input-group>
                    <!-- Email -->
                    <input-group label="Email" for="email" class="col-span-12 md:col-span-6">
                        <InputText id="email"  v-model="form.email"/>
                    </input-group>
                    <!-- Status -->
                    <input-group label="Status" for="status" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.status" :options="status" optionLabel="name" placeholder="Select" :showClear="true">
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
                    <!-- Address -->
                    <input-group label="Address" for="address" class="col-span-12">
                        <Textarea id="address" v-model="form.address" rows="3" cols="30" />
                    </input-group>
                </form-section>
            </form-content>
            <loading-screen v-if="loading"/>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import FormSection from '@/Components/Form/FormSection'
import FormContent from '@/Components/Form/FormContent'
import InputGroup from '@/Components/Form/InputGroup'
import Checked from '@/Components/Icons/General/Checked'
import XIcon from '@/Components/Icons/General/XIcon'
import ActionButton from '@/Components/Buttons/ActionButton'
import LoadingScreen from '@/Components/Misc/LoadingScreen'
/*PrimeVue Models*/
import InputText from 'primevue/inputtext'
import Dropdown from 'primevue/dropdown';
import SelectButton from 'primevue/selectbutton';
import Textarea from 'primevue/textarea';
import ProgressSpinner from 'primevue/progressspinner';
import InputMask from 'primevue/inputmask';


export default {
    props: [],
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
        ProgressSpinner,
        InputMask,
        LoadingScreen,
    },
    data() {
        return {
            loading: false,
            form: this.$inertia.form({
                _method: 'POST',
                name : null,
                tax_id : null,
                email : null,
                phone : null,
                status : null,
                address : null,
            }),
            status: [
                {name: 'Passive', value: 0, icon: 'XIcon',class: 'w-5 h-5 text-red-500 mr-2'},
                {name: 'Active', value: 1, icon: 'Checked',class: 'w-5 h-5 text-green-500 mr-2'}
            ]
        };
    },
    methods: {
        reset: function () {
                this.form.name = null;
                this.form.tax_id = null;
                this.form.email = null;
                this.form.phone = null;
                this.form.status = null;
                this.form.address = null;
        },
        save() {
            this.form.post(route('customer.store'), {
                    errorBag: 'customer',
                    preserveScroll: true,
            });
            this.loading = true;
        }
    },
}
</script>
