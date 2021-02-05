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
            <action-button label="Back to Complaint Type List" :link="route('complaint-type.index')" action="back"/>
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
                        <Error :message="error.name"/>
                    </input-group>
                    <!-- Department -->
                    <input-group label="Related Department" labelFor="department_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.department_id" :options="departments" optionLabel="name" :filter="true" placeholder="Select a Department" :showClear="true"/>
                        <Error :message="error.department_id"/>
                    </input-group>
                    <!-- Critical Level -->
                    <input-group label="Critical Level" labelFor="critical_level" class="col-span-12">
                        <div class="flex flex-row">
                        <button type="button"
                                v-for="item in criticalLevel"
                                :class="item.value === form.critical_level ? 'bg-'+item.class+'-500 border-2 border-'+item.class+'-700 text-white shadow-inner' :'bg-'+item.class+'-200 text-'+item.class+'-600'"
                                class="flex w-full p-2 items-center justify-between"
                                @click="form.critical_level = item.value"
                                :active="item.value === form.critical_level">
                            <input type="radio"  name="critica_level" v-model="form.critical_level" :value="item.value" class="hidden" >{{ item.name}} <checked v-if="item.value === form.critical_level" class="w-5 h-5" />
                        </button>
                        </div>
                        <Error :message="error.critical_level"/>
                    </input-group>
                    <!-- Source -->
                    <input-group label="Source" labelFor="source" class="col-span-12">
                        <Textarea id="source" v-model="form.source" rows="3" cols="30" class="bg-red-100"/>
                    </input-group>
                    <!-- Solution -->
                    <input-group label="Advice" labelFor="advice" class="col-span-12">
                        <Textarea id="advice" v-model="form.advice" rows="3" cols="30" class="bg-green-100"/>
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
import ActionButton from '@/Components/Buttons/ActionButton'
import Checked from '@/Components/Icons/General/Checked'
import LoadingScreen from '@/Components/Misc/LoadingScreen'
import Error from '@/Components/Form/Error'
/*PrimeVue Models*/
import InputText from 'primevue/inputtext'
import Dropdown from 'primevue/dropdown';
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
        Checked,
        ActionButton,
        Error,
        ProgressSpinner,
        LoadingScreen,
        Textarea,
    },
    data() {
        return {
            error: {},
            loading: false,
            form: this.$inertia.form({
                _method: 'POST',
                name : null,
                critical_level : null,
                department_id : null,
                source : null,
                advice : null,
            }),
            criticalLevel: [
                {name: 'Minor', value: 0, class: 'green'},
                {name: 'Moderate', value: 1, class: 'yellow'},
                {name: 'Major', value: 2, class: 'indigo'},
                {name: 'Critical', value: 3, class: 'red'},
            ],
        };
    },
    methods: {
        reset: function () {
            this.form.name = null;
            this.form.critical_level = null;
            this.form.department_id = null;
            this.form.source = null;
            this.form.advice = null;
        },
        save() {
            this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$set(this.error, 'name', '');
            this.form.critical_level === null ? this.$set(this.error, 'critical_level', 'You should select a critical level') : this.$set(this.error, 'critical_level', '');
            this.form.department_id === null ? this.$set(this.error, 'department_id', 'You should select a department') : this.$set(this.error, 'department_id', '');
            if (this.form.name !== null && this.form.critical_level !== null && this.form.department_id !== null) {
                this.form.post(route('complaint-type.store'), {
                    errorBag: 'complaint-type',
                    preserveScroll: true,
                });
                this.loading = true;
            }
        }
    },
}
</script>
