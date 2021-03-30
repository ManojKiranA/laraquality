<template>
    <app-layout>
        <!--Header-->
        <template #header>
           Create New Job Description
        </template>
        <!--Sub Header-->
        <template #sub-header>
            You can new job description for your HR management
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Back to Department List" :link="route('department.index')" action="back"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <form-content @submitted="save()"  @reset="reset">
                <form-section
                title="Job Description Infos"
                description="You are going to create new job description for relation with your staff">
                    <!-- Name -->
                    <input-group label="Title" labelFor="name" class="col-span-12">
                        <InputText id="name"  v-model="form.name"/>
                        <Error :message="error.name"/>
                    </input-group>
                    <!-- Collar Type -->
                    <input-group label="Collar Type" labelFor="collar_type" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.collar_type" :options="collarType" optionLabel="name" placeholder="Select" :showClear="true">
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
                        <Error :message="error.collar_type"/>
                    </input-group>
                    <!-- Related Department -->
                    <input-group label="Related Department" labelFor="department_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.department_id" :options="departments" optionLabel="name" :filter="true" placeholder="Select a Department" :showClear="true" />
                        <Error :message="error.department_id"/>
                    </input-group>
                    <!-- Summary -->
                    <input-group label="Summary" labelFor="summary" class="col-span-12">
                        <Textarea v-model="form.summary" :autoResize="true" rows="2" cols="30" />
                        <Error :message="error.summary"/>
                    </input-group>
                </form-section>
                <form-section
                title="Requirements, Powers and Responsibilities"
                description="Job description's definitions">
                    <!-- Job Requirements -->
                    <input-group label="Job Requirements" labelFor="job_requirement" class="col-span-12">
                        <InputRepeatable id="job_requirement"  v-model="form.job_requirement" placeHolderText="Requirement"/>
                    </input-group>
                    <!-- Key Performance Indicators (KPIs) -->
                    <input-group label="Key Performance Indicators (KPIs)" labelFor="kpi" class="col-span-12">
                        <InputRepeatable id="kpi"  v-model="form.kpi" placeHolderText="KPI"/>
                    </input-group>
                    <!-- Job Responsibilities -->
                    <input-group label="Job Responsibilities" labelFor="job_responsibility" class="col-span-12">
                        <InputRepeatable id="job_responsibility"  v-model="form.job_responsibility" placeHolderText="Responsibility"/>
                    </input-group>
                    <!-- Working Conditions and Areas-->
                    <input-group label="Working Conditions and Areas" labelFor="working_conditions" class="col-span-12">
                        <InputRepeatable id="working_conditions"  v-model="form.working_conditions" placeHolderText="Condition or Area"/>
                    </input-group>
                    <!-- Working Equipments-->
                    <input-group label="Working Equipments" labelFor="working_equipments" class="col-span-12">
                        <InputRepeatable id="working_equipments"  v-model="form.working_equipments" placeHolderText="Equipment"/>
                    </input-group>
                    <!-- It works together with  -->
                    <input-group label="It works together with" labelFor="working_together" class="col-span-12  md:col-span-6">
                        <MultiSelect v-model="form.working_together" :options="jobDescriptions" optionLabel="name" placeholder="Select a Job Description" :showClear="true" :filter="true">
                            <!--Chosen Item-->
                            <template #value="slotProps">
                                <div class="flex flex-row items-center" v-for="option of slotProps.value" :key="option.id">
                                    <!--Name-->
                                    {{option.name}}
                                </div>
                                <template v-if="!slotProps.value || slotProps.value.length === 0">
                                    Select a Job Description
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
                    <!-- It reports to -->
                    <input-group label="It reports to" labelFor="report_to" class="col-span-12 md:col-span-6">
                        <MultiSelect v-model="form.report_to" :options="users" optionLabel="name" placeholder="Select a Staff" :showClear="true" :filter="true">
                            <!--Chosen Item-->
                            <template #value="slotProps">
                                <div class="flex flex-row items-center" v-for="option of slotProps.value" :key="option.id">
                                    <!--Picture-->
                                    <img v-if="option.profile_photo_path" :src="'/storage/'+option.profile_photo_path" class="w-6 h-6 rounded-full mr-2"/>
                                    <img v-else src="/images/general/dummy_user.svg" class="w-6 h-6 rounded-full mr-2"/>
                                    <!--Name-->
                                    <div>{{option.name}}</div>
                                </div>
                                <template v-if="!slotProps.value || slotProps.value.length === 0">
                                    Select Staff
                                </template>
                            </template>
                            <template #option="slotProps">
                                <div class="flex flex-row items-center">
                                    <!--Picture-->
                                    <img v-if="slotProps.option.profile_photo_path" :src="'/storage/'+slotProps.option.profile_photo_path" class="w-6 h-6 rounded-full mr-2"/>
                                    <img v-else src="/images/general/dummy_user.svg" class="w-6 h-6 rounded-full mr-2"/>
                                    <!--Name-->
                                    <div>{{slotProps.option.name}}</div>
                                </div>
                            </template>
                        </MultiSelect>
                    </input-group>
                </form-section>
            </form-content>
            <loading-screen v-if="loading"/>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import FormContent from '@/Components/Form/FormContent'
import FormSection from '@/Components/Form/FormSection'
import Error from '@/Components/Form/Error'
import InputGroup from '@/Components/Form/InputGroup'
import InputRepeatable from '@/Components/Form/Inputs/InputInlineEditableRepeatable'
import Checked from '@/Components/Icons/General/Checked'
import XIcon from '@/Components/Icons/General/XIcon'
import ActionButton from '@/Components/Buttons/ActionButton'
import LoadingScreen from '@/Components/Misc/LoadingScreen'
import WhiteCollar from '@/Components/Icons/General/WhiteCollar'
import BlueCollar from '@/Components/Icons/General/BlueCollar'
/*PrimeVue Models*/
import InputText from 'primevue/inputtext'
import Dropdown from 'primevue/dropdown';
import SelectButton from 'primevue/selectbutton';
import MultiSelect from 'primevue/multiselect';
import Textarea from 'primevue/textarea';



export default {
    props: ['users','departments','jobDescriptions'],
    components: {
        AppLayout,
        FormContent,
        FormSection,
        Error,
        InputGroup,
        Checked,
        XIcon,
        InputText,
        Dropdown,
        InputRepeatable,
        SelectButton,
        ActionButton,
        BlueCollar,
        WhiteCollar,
        MultiSelect,
        Textarea,
        LoadingScreen,
    },
    data() {
        return {
            loading: false,
            error:{},
            form: this.$inertia.form({
                _method: 'POST',
                name: null,
                summary: null,
                department_id: null,
                collar_type: null,
                job_requirement: [],
                job_responsibility: [],
                kpi: [],
                report_to: [],
                working_conditions: [],
                working_equipments: [],
                working_together: [],
            }),
            collarType: [
                {name: 'White Collar', value: 0, icon: 'WhiteCollar',class: 'w-5 h-5 text-gray-500 mr-2'},
                {name: 'Blue Collar', value: 1, icon: 'BlueCollar',class: 'w-5 h-5 text-blue-500 mr-2'}
            ]
        };
    },
    methods: {
        reset: function () {
                this.form.name = null;
                this.form.summary = null;
                this.form.department_id = null;
                this.form.collar_type = null;
                this.form.job_requirement = [];
                this.form.job_responsibility = [];
                this.form.kpi = [];
                this.form.report_to = [];
                this.form.working_conditions = [];
                this.form.working_equipments = [];
                this.form.working_together = [];
        },
        save() {
                this.form.name === null ? this.$set(this.error, 'name', 'Name is required') : this.$set(this.error, 'name', '');
                this.form.department_id === null ? this.$set(this.error, 'department_id', 'You should select a department') : this.$set(this.error, 'department_id', '');
                this.form.collar_type === null ? this.$set(this.error, 'collar_type', 'You should select a collar type') : this.$set(this.error, 'collar_type', '');
            if(this.form.name !== null && this.form.department_type !== null && this.form.collar_type !== null ) {
                this.form.post(route('job-description.store'), {
                    errorBag: 'job-description',
                    preserveScroll: true,
                });
                this.loading = true;
            }
        },
    },
}
</script>
