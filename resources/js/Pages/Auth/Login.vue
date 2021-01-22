<template>
    <!--Login form-->
    <login>
        <!--Logo-->
        <template #logo>
            <logo class="w-16 h-16 text-blue-500" />
            <span class="ml-2 text-5xl font-semibold text-gray-600 h-16 items-center flex">LaraQuality</span>
        </template>
        <jet-validation-errors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <!--Login Form-->
        <form @submit.prevent="submit">
            <!--Email-->
            <div>
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus />
            </div>
            <!--Password-->
            <div class="mt-4">
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
            </div>
            <!--Login Button-->
            <div class="flex items-center justify-end mt-4">
                <jet-button class="w-full justify-center font-bold" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Login
                </jet-button>
            </div>
            <!--Links-->
            <div class="block mt-4 flex justify-between">
                <label class="flex items-center">
                    <jet-checkbox name="remember" v-model="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Forgot your password?
                </inertia-link>
            </div>


        </form>
    </login>
</template>

<script>
import Login from '@/Components/Authentication/Login'
import Logo from '@/Components/Icons/General/Logo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from '@/Jetstream/Checkbox'
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'

export default {
    components: {
        Login,
        Logo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors
    },

    props: {
        canResetPassword: Boolean,
        status: String
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form
                .transform(data => ({
                    ... data,
                    remember: this.form.remember ? 'on' : ''
                }))
                .post(this.route('login'), {
                    onFinish: () => this.form.reset('password'),
                })
        }
    }
}
</script>
