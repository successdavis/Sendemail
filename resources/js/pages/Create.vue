<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="p-4 sm:p-6 w-full sm:w-4/5 lg:w-3/5 mx-auto transition-colors duration-300"
        >
            <h1
                class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100 flex items-center gap-2"
            >
                ✉️ Compose New Email
            </h1>

            <form
                @submit.prevent="sendEmail"
                class="space-y-4 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6 transition-colors duration-300"
            >
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                    >
                        To
                    </label>
                    <input
                        v-model="form.to"
                        type="email"
                        placeholder="recipient@example.com"
                        class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-300 dark:focus:ring-blue-700 outline-none"
                        required
                    />
                </div>

                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                    >
                        Subject
                    </label>
                    <input
                        v-model="form.subject"
                        type="text"
                        class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-300 dark:focus:ring-blue-700 outline-none"
                        required
                    />
                </div>

                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                    >
                        Message
                    </label>
                    <textarea
                        v-model="form.body"
                        rows="8"
                        class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-300 dark:focus:ring-blue-700 outline-none resize-none"
                        required
                    ></textarea>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition-colors duration-200 disabled:opacity-60 disabled:cursor-not-allowed"
                        :disabled="loading"
                    >
                        {{ loading ? 'Sending...' : 'Send' }}
                    </button>
                </div>
            </form>

            <p
                v-if="successMessage"
                class="text-green-600 dark:text-green-400 mt-4 text-center"
            >
                {{ successMessage }}
            </p>
        </div>
    </AppLayout>
</template>
<script setup>
import { ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue';
import axios from 'axios'

const form = ref({
    to: '',
    subject: '',
    body: '',
})

const loading = ref(false)
const successMessage = ref('')

const sendEmail = async () => {
    loading.value = true
    successMessage.value = ''
    try {
        await axios.post('/api/emails', form.value)
        successMessage.value = '✅ Email sent successfully!'
        form.value = { to: '', subject: '', body: '' }
    } catch (err) {
        alert('Failed to send email.')
    } finally {
        loading.value = false
    }
}
</script>
