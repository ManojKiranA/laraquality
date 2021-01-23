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
                title="Personal Infos"
                description="This information is subject to personal data protection law.">
                    <!-- Name -->
                    <input-group label="Name" for="name" class="col-span-12 md:col-span-6">
                        <InputText id="name"  v-model="form.name"/>
                    </input-group>
                    <!-- Citizen Id -->
                    <input-group label="Citizen ID" for="citizen_id" class="col-span-12 md:col-span-6">
                        <InputText id="citizen_id"  v-model="form.citizen_id"/>
                    </input-group>
                    <!-- Birthday -->
                    <input-group label="Birthday" for="birthday_date" class="col-span-12 md:col-span-6">
                        <InputDate v-model="form.birthday_date" />
                    </input-group>
                    <!-- Blood Group -->
                    <input-group label="Blood Group" for="blood_group" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.blood_group" :options="bloodGroup" optionLabel="name" placeholder="Select" :showClear="true">
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
                    <!-- Phone -->
                    <input-group label="Phone" for="phone" class="col-span-12 md:col-span-6">
                        <InputMask id="phone"  v-model="form.phone"  mask="+99(999) 999-9999" />
                    </input-group>
                    <!-- Address -->
                    <input-group label="Address" for="address" class="col-span-12 md:col-span-6">
                        <InputText id="address"  v-model="form.address"/>
                    </input-group>
                    <!-- Emergency Contacts -->
                    <input-group label="Emergency Contacts" for="emergency_contacts" class="col-span-12 md:col-span-6">
                        <InputRepeatable id="emergency_contacts"  v-model="form.emergency_contacts"/>
                    </input-group>
                    <!-- Education Information -->
                    <input-group label="Education Info" for="education_info" class="col-span-12 md:col-span-6">
                        <Chips id="education_info"  v-model="form.education_info"/>
                    </input-group>
                    <!-- Skill Information -->
                    <input-group label="Skill Info" for="skill_info" class="col-span-12 md:col-span-6">
                        <Chips id="skill_info"  v-model="form.skill_info"/>
                    </input-group>
                    <!-- Additional Tasks -->
                    <input-group label="Additional Tasks" for="additional_task" class="col-span-12 md:col-span-6">
                        <Chips id="additional_task"  v-model="form.additional_task"/>
                    </input-group>
                </form-section>
                <form-section
                title="Staff of business information"
                description="The position and other information about of the staff in the business">
                    <!-- Email -->
                    <input-group label="Email" for="email" class="col-span-12 md:col-span-6">
                        <InputText id="email"  v-model="form.email"/>
                    </input-group>
                    <!-- Department -->
                    <input-group label="Department" for="department_id" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.department_id" :options="departments" optionLabel="name" :filter="true" placeholder="Select a Department" :showClear="true" />
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
                    <!-- Directed Staff -->
                    <input-group label="Directed Staff" for="directed_staff" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.directed_staff" :options="users" :value="id" optionLabel="id" :filter="true" placeholder="Select a Staff" :showClear="true">
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
                </form-section>
                <form-section
                title="Employment status of the staff"
                description="Information about the starting and working status of the personnel">
                    <!-- Employment Status -->
                    <input-group label="Employment Status" for="status" class="col-span-12 md:col-span-6">
                        <Dropdown v-model="form.status" :options="employmentStatus" optionLabel="name" placeholder="Select" :showClear="true" @change="jobDescriptionChange">
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
                    <!-- Employment Start Date -->
                    <input-group label="Employment Start Date" for="starting_date" class="col-span-12 md:col-span-6">
                        <InputDate v-model="form.starting_date" />
                    </input-group>
                    <!-- Employment End Date -->
                    <input-group v-if="this.form.status.value == 0 || this.form.status.value == 2" label="Finish Date of Employment" for="leaving_date" class="col-span-12 md:col-span-6">
                        <InputDate v-model="form.leaving_date" />
                    </input-group>
                    <!-- Leaving Reason -->
                    <input-group v-if="this.form.status.value == 0 || this.form.status.value == 2" label="Leaving Reason" for="leaving_reason" class="col-span-12 md:col-span-6">
                        <InputText id="leaving_reason"  v-model="form.leaving_reason"/>
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
import InputDate from '@/Components/Form/Inputs/InputDate'
import InputRepeatable from '@/Components/Form/Inputs/InputRepeatable'
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
import InputMask from 'primevue/inputmask';
import Chips from 'primevue/chips';


export default {
    props: ['departments','jobDescriptions','users'],
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
    },
    data() {
        return {
            loading: '',
            form: this.$inertia.form({
                _method: 'POST',
                name : '',
                citizen_id : '',
                birthday_date : '',
                blood_group : '',
                phone : '',
                address : '',
                emergency_contacts : '',
                education_info : '',
                skill_info : '',
                additional_task : '',
                directed_staff : '',
                status : '',
                leaving_date : '',
                leaving_reason : '',
                email : '',
                department_id : '',
                manager_id : '',
                collar_type : '',
                job_description_id : '',
            }),
            collarType: [
                {name: 'White Collar', value: 0, icon: 'WhiteCollar',class: 'w-5 h-5 text-gray-500 mr-2'},
                {name: 'Blue Collar', value: 1, icon: 'BlueCollar',class: 'w-5 h-5 text-blue-500 mr-2'}
            ],
            bloodGroup: [
                {name: '0-', value: 0},
                {name: '0+', value: 1},
                {name: 'A-', value: 2},
                {name: 'A+', value: 3},
                {name: 'B-', value: 4},
                {name: 'B+', value: 5},
                {name: 'AB-', value: 6},
                {name: 'AB+', value: 7},
            ],
            employmentStatus: [
                {name:"Left",value:0},
                {name:"Active",value:1},
                {name:"Fired",value:2},
                {name:"Retired",value:3}
            ],
            en: {
                firstDayOfWeek: 0,
                dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                dayNamesMin: ["Su","Mo","Tu","We","Th","Fr","Sa"],
                monthNames: [ "January","February","March","April","May","June","July","August","September","October","November","December" ],
                monthNamesShort: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ],
                today: 'Today',
                clear: 'Clear',
                dateFormat: 'mm/dd/yy',
                weekHeader: 'Wk'
            }
        };
    },
    methods: {
        reset: function () {
            this.form.name = '';
            this.form.citizen_id = '';
            this.form.birthday_date = '';
            this.form.blood_group = '';
            this.form.phone = '';
            this.form.address = '';
            this.form.emergency_contacts = '';
            this.form.education_info = '';
            this.form.skill_info = '';
            this.form.additional_task = '';
            this.form.directed_staff = '';
            this.form.status = '';
            this.form.leaving_date = '';
            this.form.leaving_reason = '';
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
