<template>
    <app-layout>
        <!--Header-->
        <template #header>
           Create New Complaint
        </template>
        <!--Sub Header-->
        <template #sub-header>
            You can new complaints
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Back to Complaint List" :link="route('complaint.index')" action="back"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <form-content @submitted="save" @reset="reset">
                <form-section
                title="General Data"
                description="Identity infos of complaint">
                    <!-- Register Date -->
                    <input-group label="Register Date" for="register_date" class="col-span-12 md:col-span-6">
                    <InputDate v-model="form.register_date"/>
                    </input-group>
                    <!-- Customer -->
                    <input-group label="Customer" for="customer_id" class="col-span-12 md:col-span-6">
                      <Dropdown v-model="form.customer_id" :options="customers" optionLabel="name" optionValue="id"  :filter="true" placeholder="Select a Customer" :showClear="true" />
                    </input-group>
                    <!-- Department -->
                    <input-group label="Related Department" for="department_id" class="col-span-12 md:col-span-6">
                      <Dropdown v-model="form.department_id" :options="departments" optionLabel="name" optionValue="id"  :filter="true" placeholder="Select a Department" :showClear="true" @change="ProductChange"/>
                    </input-group>
                    <!-- Product -->
                    <input-group label="Related Product" for="product_id" class="col-span-12 md:col-span-6">
                      <Dropdown v-model="form.product_id" :options="products" optionLabel="name" optionValue="id" :filter="true" placeholder="Select a Product" :showClear="true" :disabled="!form.department_id"/>
                    </input-group>
                    <!-- Complaints -->
                    <input-group label="Complaint Type" labelFor="complaints" class="col-span-12">
                      <MultiSelect v-model="form.complaints" :options="complaints" optionLabel="name" optionValue="id" placeholder="Select a Complaint" :showClear="true" :filter="true" :disabled="!form.department_id"/>
                        <!--Chosen Item-->
                        <template #value="slotProps">
                          <div class="flex flex-row items-center" v-for="option of slotProps.value" :key="option.id">
                            <!--Name-->
                            {{option.name}}
                          </div>
                          <template v-if="!slotProps.value || slotProps.value.length === 0">
                            Select a Complaint
                          </template>
                        </template>
                        <template #option="slotProps">
                          <div class="flex flex-row items-center">
                            <!--Name-->
                            {{slotProps.option.name}}
                          </div>
                        </template>
                      </MultiSelect>
                    </input-group>
                    <!-- Description -->
                    <input-group label="Description" labelFor="description" class="col-span-12">
                      <Textarea id="description" v-model="form.description" rows="3" cols="30" placeholder="Infos (Desc., Contact, etc.)"/>
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
import InputDate from '@/Components/Form/Inputs/InputDate'
import InputRepeatable from '@/Components/Form/Inputs/InputRepeatable'
import Checked from '@/Components/Icons/General/Checked'
import XIcon from '@/Components/Icons/General/XIcon'
import WhiteCollar from '@/Components/Icons/General/WhiteCollar'
import BlueCollar from '@/Components/Icons/General/BlueCollar'
import ActionButton from '@/Components/Buttons/ActionButton'
import LoadingScreen from '@/Components/Misc/LoadingScreen'
/*PrimeVue Models*/
import InputText from 'primevue/inputtext'
import Dropdown from 'primevue/dropdown';
import SelectButton from 'primevue/selectbutton';
import Textarea from 'primevue/textarea';
import ProgressSpinner from 'primevue/progressspinner';
import InputMask from 'primevue/inputmask';
import Chips from 'primevue/chips';
import MultiSelect from 'primevue/multiselect';


export default {
    props: ['departments','customers','products','complaints'],
    components: {
        AppLayout,
        FormContent,
        FormSection,
        InputGroup,
        InputDate,
        InputRepeatable,
        Checked,
        XIcon,
        WhiteCollar,
        BlueCollar,
        InputText,
        Dropdown,
        SelectButton,
        ActionButton,
        Textarea,
        ProgressSpinner,
        InputMask,
        Chips,
        MultiSelect,
        LoadingScreen,
    },
    data() {
        return {
            loading: false,
            form: this.$inertia.form({
                _method: 'POST',
                register_date : null,
                customer_id : null,
                department_id : null,
                product_id : null,
                complaints : [],
                description : null,
            })
        };
    },
    methods: {
        reset: function () {
              this.form.register_date = null;
              this.form.customer_id = null;
              this.form.department_id = null;
              this.form.product_id = null;
              this.form.complaints = [];
              this.form.description = null;
        },
        save() {
            this.form.post(route('complaint.store'), {
                    errorBag: 'complaint',
                    preserveScroll: true,
            });
            this.loading = false;
        },
        ProductChange(){
            this.$inertia.reload( {
                method: 'get',
                data: {departmentID :this.form.department_id},
                replace: true,
                preserveState: true,
                preserveScroll: true,
                only: ['products','complaints'],
            })
        }


    },
}
</script>
