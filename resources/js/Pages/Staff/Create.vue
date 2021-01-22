<template>
    <app-layout>
        <!--Header-->
        <template #header>
           Create New Staff
        </template>
        <!--Sub Header-->
        <template #sub-header>
            You can new staff for your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Back to Products List" :link="route('product.index')" action="back"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <form-content @submitted="save" @reset="reset">
                <form-section
                title="Staff General Infos"
                description="You are going to create new staff for your company">
                    <!-- Name -->
                    <input-group label="Name" for="name" class="col-span-12 md:col-span-6">
                        <InputText id="name"  v-model="form.name"/>
                    </input-group>
                    <!-- Email -->
                    <input-group label="Email" for="name" class="col-span-12 md:col-span-6">
                        <InputText id="email"  v-model="form.email"/>
                    </input-group>
                    <!-- Department -->
                    <input-group label="Department" for="department_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.department_id" :options="departments" optionLabel="name" :filter="true" placeholder="Select a Department" :showClear="true" />
                    </input-group>
                    <!-- Manager -->
                    <input-group label="Manager" for="manager_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.manager_id" :options="users" :value="id" optionLabel="id" :filter="true" placeholder="Select a Manager" :showClear="true">
                            <!--Chosen Item-->
                            <template #value="slotProps">
                                <div class="flex flex-row items-center" v-if="slotProps.value">
                                    <!--Picture-->
                                    <img v-if="slotProps.value.profile_photo_path" :src="'/storage/'+slotProps.value.profile_photo_path" class="w-6 h-6 rounded-full mr-2"/>
                                    <img v-else src="/images/general/dummy_user.svg" class="w-6 h-6 rounded-full mr-2"/>
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
                                    <!--Picture-->
                                    <img v-if="slotProps.option.profile_photo_path" :src="'/storage/'+slotProps.option.profile_photo_path" class="w-6 h-6 rounded-full mr-2"/>
                                    <img v-else src="/images/general/dummy_user.svg" class="w-6 h-6 rounded-full mr-2"/>
                                    <!--Name-->
                                    <div>{{slotProps.option.name}}</div>
                                </div>
                            </template>
                        </Dropdown>
                    </input-group>
                    <!-- Collar Type -->
                    <input-group label="Collar Type" for="collar_type" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.collar_type" :options="collarType" optionLabel="name" placeholder="Select" :showClear="true" @change="jobDescriptionChange">
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
                    <!-- Job Description -->
                    <input-group label="Job Description" for="job_description_id" class="col-span-12 md:col-span-6">
                        <div v-if="loading"><ProgressSpinner /></div>{{ loading}}
                        <Dropdown v-model="form.job_description_id" :options="jobDescriptions" optionLabel="name" :filter="true" placeholder="Select a Job Description" :showClear="true" />
                    </input-group>
                </form-section>
            </form-content>
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
import WhiteCollar from '@/Components/Icons/General/WhiteCollar'
import BlueCollar from '@/Components/Icons/General/BlueCollar'
import ActionButton from '@/Components/Buttons/ActionButton'
/*PrimeVue Models*/
import InputText from 'primevue/inputtext'
import Dropdown from 'primevue/dropdown';
import SelectButton from 'primevue/selectbutton';
import Textarea from 'primevue/textarea';
import ProgressSpinner from 'primevue/progressspinner';



export default {
    props: ['departments','jobDescriptions','users'],
    components: {
        AppLayout,
        FormContent,
        FormSection,
        InputGroup,
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
    },
    data() {
        return {
            loading: '',
            form: this.$inertia.form({
                _method: 'POST',
                name : '',
                email : '',
                department_id : '',
                manager_id : '',
                collar_type : '',
                job_description_id : '',
            }),
            collarType: [
                {name: 'White Collar', value: 0, icon: 'WhiteCollar',class: 'w-5 h-5 text-gray-500 mr-2'},
                {name: 'Blue Collar', value: 1, icon: 'BlueCollar',class: 'w-5 h-5 text-blue-500 mr-2'}
            ]
        };
    },
    methods: {
        reset: function () {
            this.form.name = '';
            this.form.email = '';
            this.form.department_id = '';
            this.form.manager_id = '';
            this.form.collar_type = '';
            this.form.job_description_id = '';
        },
        save() {
            this.form.post(route('staff.store'), {
                    errorBag: 'staff',
                    preserveScroll: true,
            });
            this.reset();
        },
        jobDescriptionChange(){
            this.$inertia.reload( {
                method: 'get',
                data: {collarTypeId :this.form.collar_type.value},
                replace: true,
                preserveState: true,
                preserveScroll: true,
                only: ['jobDescriptions'],
            })
        }


    },
}
</script>
