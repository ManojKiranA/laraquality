<template>
    <calendar>
        <template v-slot="{ inputValue, inputEvents }">
            <div class="relative flex items-center">
                <input
                    class="border rounded-sm  border-gray-300 w-full p-2"
                    :value="inputValue"
                    v-on="inputEvents"
                />
                <div class="absolute flex right-2">
                    <calendar-icon class="w-5 h-5 text-gray-500" />
                </div>
            </div>
        </template>
    </calendar>
</template>

<script>
import CalendarIcon from '@/Components/Icons/General/Calendar'
import Calendar from 'v-calendar/lib/components/date-picker.umd';


export default {
    components: {
        Calendar,
        CalendarIcon,
    },
}
</script>
