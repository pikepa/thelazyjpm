<script setup>
import ForumLayout from '@/Layouts/ForumLayout.vue';
import SelectTopic from '@/Components/SelectTopic.vue';
import Pagination from '@/Components/Pagination.vue';
import Discussion from '@/Components/Forum/Discussion.vue';
import InputLabel from '@/Components/InputLabel.vue';

defineProps({
    discussions: Object
})

import { Head } from '@inertiajs/vue3';

</script>

<template>

    <Head title="Forum" />

    <ForumLayout>
        <div class="space-y-6">

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <InputLabel for="topic" value="Topic" class="sr-only" />
                        <SelectTopic id="topic">
                            <option>All Topics</option>
                            <option :value="topic.slug" v-for="topic in $page.props.topics" :key="topic.id">
                                {{ topic.title }}
                            </option>
                        </SelectTopic>
                    </div>
                </div>
            </div>
            <div class="space-y-3">
                <Discussion v-for="discussion in discussions.data" :key="discussion.id" :discussion="discussion" />
                <!-- <Pagination :pagination="discussions.meta"/> -->
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
