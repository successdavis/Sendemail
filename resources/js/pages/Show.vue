<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">
            <!-- Header -->
            <div
                class="px-6 py-4 border-b flex items-center justify-between"
                :class="email.type === 'incoming' ? 'bg-blue-50' : 'bg-green-50'"
            >
                <h1 class="text-xl font-semibold text-gray-800">
                    {{ email.subject }}
                </h1>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full"
                    :class="email.type === 'incoming' ? 'bg-blue-200 text-blue-800' : 'bg-green-200 text-green-800'"
                >
        {{ email.type }}
      </span>
            </div>

            <!-- Email Details -->
            <div class="px-6 py-4 text-sm text-gray-700 space-y-2">
                <div>
                    <span class="font-semibold text-gray-800">From:</span>
                    <span class="ml-1">{{ email.from }}</span>
                </div>
                <div>
                    <span class="font-semibold text-gray-800">To:</span>
                    <span class="ml-1">{{ email.to }}</span>
                </div>
                <div>
                    <span class="font-semibold text-gray-800">Sent:</span>
                    <span class="ml-1">{{ formattedDate(email.created_at) }}</span>
                </div>
            </div>

            <!-- Body -->
            <div class="px-6 py-6 border-t bg-gray-50">
                <p class="whitespace-pre-wrap text-gray-800 leading-relaxed">
                    {{ email.body }}
                </p>
            </div>

            <!-- Footer -->
            <div class="px-6 py-3 border-t bg-gray-100 flex justify-end">
                <Link href="/inbox"
                      @click="$emit('back')"
                      class="bg-gray-800 text-white text-sm px-4 py-2 rounded-lg hover:bg-gray-700 transition"
                >
                    Back to Inbox
                </Link>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    email: {
        type: Object,
        required: true,
    },
})

/**
 * Format date nicely for display.
 */
const formattedDate = (dateStr) => {
    const date = new Date(dateStr)
    return date.toLocaleString(undefined, {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    })
}
</script>
