<template>
    <app-layout>
        <!--Header-->
        <template #header>
           Create New Action
        </template>
        <!--Sub Header-->
        <template #sub-header>
            You are creating a new action for this complaint: <b>#112</b>
        </template>
        <!--Action Buttons-->
        <template #action-buttons>
            <action-button label="Back to Complaint Actions List" :link="route('complaint-action.index')" action="back"/>
        </template>
        <div class="relative w-full">
            <!--Content Table-->
            <form-content @submitted="save" @reset="reset">
                <form-section
                title="Action details"
                description="Please write all details of complaint">
                    <!-- Complaint -->
                    <input-group label="Related Complaint" labelFor="complaint_id" class="col-span-12">
                        <Dropdown v-model="form.complaint_id" :options="complaints" optionLabel="id" :filter="true" placeholder="Select a Complaint" :showClear="true"  @change="complaintSelectionChange()">
                         <!--Chosen Item-->
                            <template #value="slotProps">
                                <div class="flex flex-row items-center" v-if="slotProps.value">
                                    <!--Name-->
                                    <div>#{{slotProps.value.id}} - {{slotProps.value.product.name}}</div>
                                </div>
                                <span v-else>
                                    {{slotProps.placeholder}}
                                </span>
                            </template>
                            <!--Item in The Opened List-->
                            <template #option="slotProps">
                                <div class="flex flex-col space-y-1">
                                    <div class="flex flex-row justify-start">
                                        <span class="mr-2 font-semibold">Date:</span>
                                        <span class="">{{slotProps.option.date}}</span>
                                    </div>
                                    <div class="flex flex-row justify-start">
                                        <span class="mr-2 font-semibold">ID:</span>
                                        <span class="">#{{slotProps.option.id}}</span>
                                    </div>
                                    <div class="flex flex-row justify-start">
                                        <span class="mr-2 font-semibold">Customer:</span>
                                        <span class="">{{slotProps.option.customer.name}}</span>
                                    </div>
                                    <div class="flex flex-row justify-start">
                                        <span class="mr-2 font-semibold">Product</span>
                                        <span class="">{{slotProps.option.product.name}}</span>
                                    </div>
                                </div>
                            </template>
                        </Dropdown>
                        <Error :message="error.complaint_id"/>
                    </input-group>
                    <!-- Action Type -->
                    <input-group label="Action Type" labelFor="action_type" class="col-span-12">
                        <Dropdown v-model="form.action_type" :options="actionTypes" optionLabel="name" placeholder="Select" :showClear="true">
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
                        <Error :message="error.action_type"/>
                    </input-group>
                    <!-- Comment -->
                    <input-group label="Comment" labelFor="comment" class="col-span-12">
                        <Textarea id="comment" v-model="form.comment" rows="3" cols="30"/>
                        <Error :message="error.comment"/>
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
    props: ['complaints'],
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
                complaint_id : null,
                action_type : null,
                comment : null,
            }),
            actionTypes: [
                {name: 'Phone Call', value: 0, class: 'green'},
                {name: 'Customer Visit', value: 1, class: 'yellow'},
                {name: 'Laboratory Inspection', value: 2, class: 'indigo'},
            ],
        };
    },
    computed:{

    },
    methods: {
        reset: function () {
            this.form.complaint_id = null;
            this.form.action_type = null;
            this.form.comment = null;
        },
        save() {
            this.form.action_type === null ? this.$set(this.error, 'action_type', 'You should select a action type') : this.$set(this.error, 'action_type', '');
            this.form.complaint_id === null ? this.$set(this.error, 'complaint_id', 'You should select a complaint') : this.$set(this.error, 'complaint_id', '');
            this.form.comment === null ? this.$set(this.error, 'comment', 'You should write some details') : this.$set(this.error, 'department_id', '');
            if (this.form.action_type !== null && this.form.complaint_id !== null && this.form.comment !== null) {
                this.form.post(route('complaint-action.store'), {
                    errorBag: 'complaint-action',
                    preserveScroll: true,
                });
                this.loading = true;
            }
        },
        complaintSelectionChange(){
            this.$inertia.reload( {
                method: 'get',
                data: {complaintId :this.form.complaint_id.id},
                replace: true,
                preserveState: true,
                preserveScroll: true,
                only: [''],
            })
        }
    },
}
</script>
