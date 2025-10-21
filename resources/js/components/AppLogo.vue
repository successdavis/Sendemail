<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Mail, ShieldCheck, Send, Inbox, Twitter, Linkedin, Github } from "lucide-vue-next";

</script>

<template>
    <div
        class="flex aspect-square size-8 items-center justify-center rounded-md bg-sidebar-primary text-sidebar-primary-foreground"
    >
        <Mail class="w-6 h-6 text-blue-600" />
    </div>
    <div class="ml-1 grid flex-1 text-left text-sm">
        <h1 class="text-2xl font-bold text-blue-600 dark:text-blue-400">CorpMail</h1>
    </div>
</template>
