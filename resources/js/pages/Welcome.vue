<template>
  <div class="min-h-screen max-w-4/5 mx-auto bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    <!-- Navbar -->
    <header class="flex items-center justify-between px-8 py-4 border-b border-gray-200 dark:border-gray-800">
      <div class="flex items-center gap-2">
        <Mail class="w-6 h-6 text-blue-600" />
        <h1 class="text-2xl font-bold text-blue-600 dark:text-blue-400">CorpMail</h1>
      </div>

      <nav class="flex items-center justify-end gap-4">
        <Link
          v-if="$page.props.auth.user"
          :href="dashboard()"
          class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
        >
          Dashboard
        </Link>

        <template v-else>
          <Link
            :href="login()"
            class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
          >
            Log in
          </Link>

          <Link
            v-if="canRegister"
            :href="register()"
            class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
          >
            Register
          </Link>
        </template>
      </nav>
    </header>

    <!-- Hero Section -->
    <section class="flex flex-col-reverse md:flex-row items-center justify-between px-10 py-20">
      <div class="flex-1 space-y-6">
        <h2 class="text-4xl font-extrabold md:text-5xl leading-tight">
          Send and Receive Emails <br />
          <span class="text-blue-600">with Your Company Domain</span>
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-lg">
          Manage your company emails easily and securely from one unified dashboard.
          Designed for performance, privacy, and a professional experience.
        </p>
        <div class="flex gap-4">
          <Button size="lg">Start Free Trial</Button>
          <Button variant="outline" size="lg">Request Demo</Button>
        </div>
      </div>

      <div class="flex-1 flex justify-center md:justify-end mt-10 md:mt-0">
        <img
          src="/images/email-dashboard.jpg"
          alt="Email dashboard mockup"
          class="w-[90%] md:w-[80%] rounded-2xl shadow-xl"
        />
      </div>
    </section>

    <!-- Features -->
    <section id="features" class="bg-gray-50 dark:bg-gray-800 py-20">
      <div class="max-w-6xl mx-auto px-8 text-center">
        <h3 class="text-3xl font-bold mb-12">Why Companies Choose CorpMail</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
          <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl shadow-md">
            <ShieldCheck class="w-10 h-10 mx-auto text-blue-600 mb-4" />
            <h4 class="text-xl font-semibold mb-2">Enterprise Security</h4>
            <p class="text-gray-600 dark:text-gray-300">
              End-to-end encryption ensures your data and messages are protected.
            </p>
          </div>

          <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl shadow-md">
            <Send class="w-10 h-10 mx-auto text-blue-600 mb-4" />
            <h4 class="text-xl font-semibold mb-2">Reliable Delivery</h4>
            <p class="text-gray-600 dark:text-gray-300">
              Lightning-fast SMTP routing for guaranteed email delivery.
            </p>
          </div>

          <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl shadow-md">
            <Inbox class="w-10 h-10 mx-auto text-blue-600 mb-4" />
            <h4 class="text-xl font-semibold mb-2">Unified Inbox</h4>
            <p class="text-gray-600 dark:text-gray-300">
              Manage all your company emails in a single organized dashboard.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Stats -->
    <section class="py-20">
      <div class="max-w-5xl mx-auto px-8 text-center">
        <h3 class="text-3xl font-bold mb-10">Trusted by Businesses Worldwide</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div>
            <h4 class="text-4xl font-bold text-blue-600">+50K</h4>
            <p class="text-gray-500">Emails sent daily</p>
          </div>
          <div>
            <h4 class="text-4xl font-bold text-blue-600">+10K</h4>
            <p class="text-gray-500">Companies onboarded</p>
          </div>
          <div>
            <h4 class="text-4xl font-bold text-blue-600">99.99%</h4>
            <p class="text-gray-500">Delivery success rate</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-200 dark:border-gray-800 py-10 text-center text-sm text-gray-500">
      <p>© {{ new Date().getFullYear() }} CorpMail. All rights reserved.</p>
      <div class="flex justify-center gap-4 mt-3">
        <a href="#"><Twitter class="w-5 h-5 hover:text-blue-500" /></a>
        <a href="#"><Linkedin class="w-5 h-5 hover:text-blue-700" /></a>
        <a href="#"><Github class="w-5 h-5 hover:text-gray-700 dark:hover:text-gray-300" /></a>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { Mail, ShieldCheck, Send, Inbox, Twitter, Linkedin, Github } from "lucide-vue-next";
import { Button } from "@/components/ui/button";
import { Link } from "@inertiajs/vue3"; // Inertia Link
import { computed } from "vue";

// Example dynamic route helpers (replace with actual route() calls if using Ziggy)
const login = () => "/login";
const register = () => "/register";
const dashboard = () => "/dashboard";
const canRegister = computed(() => true);
</script>
