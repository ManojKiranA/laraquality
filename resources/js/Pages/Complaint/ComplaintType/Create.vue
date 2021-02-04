<template>
    <app-layout>
        <!--Header-->
        <template #header>
           Create New Complaint Type
        </template>
        <!--Sub Header-->
        <template #sub-header>
            You can new complaint type for complaint records
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Back to Staff List" :link="route('complaint-type.index')" action="back"/>

        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <form-content @submitted="save" @reset="reset">
                <form-section
                title="General infos"
                description="The complaint type helps you to you can sort of complaint types">
                    <!-- Name -->
                    <input-group label="Compliant Type Name" labelFor="name" class="col-span-12 md:col-span-6">
                        <InputText id="name"  v-model="form.name"/>
                    </input-group>
                    <!-- Critical Status -->
                    <!-- Department -->
                    <input-group label="Related Department" labelFor="department_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.department_id" :options="departments" optionLabel="name" :filter="true" placeholder="Select a Department" :showClear="true"/>
                        <Error :message="error.department_id"/>
                    </input-group>
                    <input-group label="Critical Status" labelFor="critical_status" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.critical_status" :options="criticalStatus" optionLabel="name" placeholder="Select" :showClear="true">
                            <!--Chosen Item-->
                            <template #value="slotProps">
                                <div class="flex flex-row items-center" v-if="slotProps.value">
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
                    <!-- Source -->
                    <input-group label="Source" labelFor="source" class="col-span-12">
                        <Textarea id="source" v-model="form.source" rows="3" cols="30" />
                    </input-group>
                    <!-- Solution -->
                    <input-group label="Advice" labellabelFor="advice" class="col-span-12">
                        <Textarea id="advice" v-model="form.advice" rows="3" cols="30" />
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
import WhiteCollar from '@/Components/Icons/General/WhiteCollar'
import BlueCollar from '@/Components/Icons/General/BlueCollar'
import ActionButton from '@/Components/Buttons/ActionButton'
import LoadingScreen from '@/Components/Misc/LoadingScreen'
import Error from '@/Components/Form/Error'
/*PrimeVue Models*/
import InputText from 'primevue/inputtext'
import Dropdown from 'primevue/dropdown';
import SelectButton from 'primevue/selectbutton';
import ProgressSpinner from 'primevue/progressspinner';
import Textarea from 'primevue/textarea';


export default {
    props: ['departments'],
    components: {
        AppLayout,
        FormContent,
        FormSection,
        InputGroup,
        InputText,
        Dropdown,
        SelectButton,
        ActionButton,
        Error,
        ProgressSpinner,
        LoadingScreen,
        Textarea,
    },
    data() {
        return {
            loading: false,
            form: this.$inertia.form({
                _method: 'POST',
                name : '',
                critical_status : '',
                department_id : '',
                source : '',
                advice : '',

            }),
            criticalStatus: [
                {name: 'White Collar', value: 0, icon: 'WhiteCollar',class: 'w-5 h-5 text-gray-500 mr-2'},
                {name: 'Blue Collar', value: 1, icon: 'BlueCollar',class: 'w-5 h-5 text-blue-500 mr-2'}
            ],
        };
    },
    methods: {
        reset: function () {
            this.form.name = '';
            this.form.critical_status = '';
            this.form.department_id = '';
            this.form.source = '';
            this.form.advice = '';
        },
        save() {
            this.form.post(route('complaint-type.store'), {
                    errorBag: 'complaint-type',
                    preserveScroll: true,
            });
            this.loading = true;
        }
    },
}
</script>
