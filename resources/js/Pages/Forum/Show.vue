<script setup>
import ForumLayout from '@/Layouts/ForumLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    discussion: Object
})


</script>

<template>

    <Head title="{{ discussion.title }}" />

    <ForumLayout>
        <div class="space-y-6">

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ discussion.title }}
                </div>
            </div>
        </div>

        <template #side>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Side
                </div>
            </div>
        </template>
    </ForumLayout>
</template>
