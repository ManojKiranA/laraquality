<template>
    <app-layout>
        <!--Header-->
        <template #header>
           Create New Departments
        </template>
        <!--Sub Header-->
        <template #sub-header>
            You can new departments for your company
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Back to Department List" :link="route('department.index')" action="back"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <form-content @submitted="save"  @reset="reset">
                <form-section
                title="Department Infos"
                description="You are going to create new department for your company">
                    <!-- Name -->
                    <input-group label="Department Name" for="name" class="col-span-12 md:col-span-6">
                        <InputText id="name"  v-model="form.name"/>
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
                    <!-- Department Type-->
                    <input-group label="Main Department" for="department_type" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.department_type" :options="departmentType" optionLabel="name" placeholder="Select Department Type" :showClear="true"/>
                    </input-group>
                    <!-- Main Department -->
                    <input-group label="Main Department" for="department_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.department_id" :options="departments" optionLabel="name":disabled="form.department_type.value === 0" :filter="true" placeholder="Select a Department" :showClear="true" />
                    </input-group>
                    <!-- Customer Complaint -->
                    <input-group label="Can it get a customer complaint?" for="is_complaint" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.is_complaint" :options="isComplaint" optionLabel="name" placeholder="Select" :showClear="true">
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
                    <!-- Production -->
                    <input-group label="Can it make production or has any product?" for="is_production" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.is_production" :options="isProduction" optionLabel="name" placeholder="Select" :showClear="true">
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



export default {
    props: ['users','departments'],
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
        ActionButton
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name: '',
                manager_id: '',
                department_type: '',
                department_id: '',
                is_complaint: '',
                is_production: '',
            }),
            departmentType: [
                {name: 'Main Department', value: 0},
                {name: 'Sub Department', value: 1}
            ],
            isComplaint: [
                {name: 'Yes, It can', value: 1, icon: 'Checked',class: 'w-5 h-5 text-green-500 mr-2'},
                {name: 'No, It can\'t', value: 0, icon: 'XIcon',class: 'w-5 h-5 text-red-500 mr-2'}
            ],
            isProduction: [
                {name: 'Yes, It can', value: 1, icon: 'Checked',class: 'w-5 h-5 text-green-500 mr-2'},
                {name: 'No, It can\'t', value: 0, icon: 'XIcon',class: 'w-5 h-5 text-red-500 mr-2'}
            ]
        };
    },
    methods: {
        reset: function () {
            this.form.name = '';
            this.form.manager_id = '';
            this.form.department_type = '';
            this.form.department_id = '';
            this.form.is_complaint = '';
            this.form.is_production = '';
        },
        save() {
            this.form.post(route('department.store'), {
                    errorBag: 'department',
                    preserveScroll: true,
            });
            this.reset();
        },


    },
}
</script>
