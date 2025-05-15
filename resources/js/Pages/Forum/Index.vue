<script setup>
import ForumLayout from '@/Layouts/ForumLayout.vue';
import SelectTopic from '@/Components/SelectTopic.vue';
import Pagination from '@/Components/Pagination.vue';
import Navigation from '@/Components/Forum/Navigation.vue';
import Discussion from '@/Components/Forum/Discussion.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import _omitBy from 'lodash.omitby';
import _isEmpty from 'lodash.isempty';
import _debounce from 'lodash.debounce';
import { Head, router } from '@inertiajs/vue3';
import useCreateDiscussion from '@/Composables/useCreateDiscussion';
import {ref , watch } from 'vue';

const props = defineProps({
    discussions: Object,
    query : Object
})

const { visible,showCreateDiscussionForm } = useCreateDiscussion()

const filterTopic = (e) => {
    router.visit('/', {
        data: _omitBy({
            'filter[topic]': e.target.value
        }, _isEmpty),
        preserveScroll: true
    })
}

const searchQuery = ref(props.query.search || '');

const handleSearchInput = _debounce((query) => {
    router.reload({
        data: { search: query },
        preserveScroll: true
    })
}, 500)

watch(searchQuery, (query) => {
    handleSearchInput(query)
})

</script>

<template>

    <Head title="Forum" />

    <ForumLayout>
        <div class="space-y-6">

            <div class="overflow-hidden bg-white shadow-xs sm:rounded-lg">
                <div class="p-6 space-x-3 text-gray-900 flex items-center">
                    <div class="flex-grow">
                        <InputLabel for="search" value="Search" class="sr-only" />
                        <TextInput v-model="searchQuery" type="search" id="search" class="w-full" placeholder="Search discussions..."/>
                    </div>
                    <div>
                        <InputLabel for="topic" value="Topic" class="sr-only" />
                        <SelectTopic id="topic" v-on:change="filterTopic">
                            <option value="">All Topics</option>
                            <option 
                                :value="topic.slug" 
                                v-for="topic in $page.props.topics" 
                                :key="topic.id"
                                :selected="query.filter?.topic === topic.slug">
                                {{ topic.title }}
                            </option>
                        </SelectTopic>
                    </div>
                </div>
            </div>
            <div class="space-y-3">
                <Discussion v-for="discussion in discussions.data" :key="discussion.id" :discussion="discussion" />
                <Pagination :pagination="discussions.meta"/>
            </div>
        </div>

        <template #side>
            <PrimaryButton v-on:click="showCreateDiscussionForm" class="w-full flex justify-center h-10" v-if="$page.props.auth.user">
                Start a discussion
            </PrimaryButton>
            <Navigation :query ='query' />
        </template>
    </ForumLayout>
</template>
