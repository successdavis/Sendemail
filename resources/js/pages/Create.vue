<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6 w-4/5 mx-auto">
            <h1 class="text-2xl font-bold mb-6">✉️ Compose New Email</h1>

            <form @submit.prevent="sendEmail" class="space-y-4 bg-white shadow rounded-lg p-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">To</label>
                    <input
                        v-model="form.to"
                        type="email"
                        placeholder="recipient@example.com"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300"
                        required
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                    <input
                        v-model="form.subject"
                        type="text"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300"
                        required
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea
                        v-model="form.body"
                        rows="8"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300"
                        required
                    ></textarea>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg"
                        :disabled="loading"
                    >
                        {{ loading ? 'Sending...' : 'Send' }}
                    </button>
                </div>
            </form>

            <p v-if="successMessage" class="text-green-600 mt-4">{{ successMessage }}</p>
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
