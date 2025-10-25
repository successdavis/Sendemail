<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">📥 Inbox</h1>
                <router-link
                    to="/emails/create"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg"
                >
                    Compose
                </router-link>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg divide-y divide-gray-200 dark:divide-gray-700">
                <div
                    v-for="email in emails"
                    :key="email.id"
                    class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer flex justify-between"
                    @click="viewEmail(email.id)"
                >
                    <div>
                        <h2 class="font-semibold text-gray-900 dark:text-gray-100">{{ email.subject }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            From: {{ email.from }} — {{ formatDate(email.created_at) }}
                        </p>
                    </div>
                    <span
                        class="text-sm text-gray-400 dark:text-gray-500"
                        v-if="!email.is_read"
                    >Unread</span>
                </div>

                <div v-if="emails.length === 0" class="p-4 text-gray-500 dark:text-gray-400 text-center">
                    No emails yet.
                </div>
            </div>
        </div>
    </AppLayout>
</template>


<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import AppLayout from '@/layouts/AppLayout.vue';
import axios from 'axios'

const router = useRouter()
const emails = ref([])

const fetchEmails = async () => {
    const res = await axios.get('/api/emails/inbox')
    emails.value = res.data
}

const viewEmail = (id) => {
    router.push(`/emails/${id}`)
}

const formatDate = (date) => new Date(date).toLocaleString()

onMounted(fetchEmails)
</script>
