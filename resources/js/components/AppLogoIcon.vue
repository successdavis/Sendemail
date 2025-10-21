<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { Mail, ShieldCheck, Send, Inbox, Twitter, Linkedin, Github } from "lucide-vue-next";


defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
            <Mail class="w-6 h-6 text-blue-600" />

</template>
