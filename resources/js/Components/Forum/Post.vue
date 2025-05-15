<template>

    <div :id="`post-${post.id}`"
        class="relative bg-white overflow-hidden shadow-xs sm:rounded-lg p-6 text-gray-900 flex items-start space-x-3
        border-2 border-transparent"
        :class="{ '!border-gray-800' : isSolution, 'border-transparent': !isSolution}"
    >

        <div class="w-7 shrink-0">
            <img :src="post.user?.avatar_url" class="w-7 h-7 rounded-full" v-if="post.user">
        </div>
        <div class="w-full">
            <div>
                <div> {{ post.user?.username || '[User Deleted]' }} </div>
                <div class="text-sm text-gray-500">Posted <time :datetime="post.created_at.human"
                        :title="post.created_at.dateTime">
                        {{ post.created_at.human }}
                    </time></div>
            </div>
            <div class="mt-3 w">
                <form v-on:submit.prevent="editPost" v-if="editing">
                    <InputLabel for="body" value="Body" class="sr-only" />
                    <TextArea v-model="editForm.body" id="body" class="w-full" rows="5" />
                    <InputError class="mt-2" :message="editForm.errors.body" />
                    <div class="flex items-center space-x-3">
                        <PrimaryButton>Edit</PrimaryButton>
                        <button type="button" v-on:click="editing = false" class="text-sm">Cancel</button>
                    </div>
                </form>
                <div v-else v-html="post.body_markdown" class="markdown"> </div>
            </div>
            <ul class="flex items-center space-x-3 mt-6">

                <li v-if="post.discussion.user_can.reply">
                    <button v-on:click="showCreatePostForm(post.discussion)"
                        class="text-indigo-500 text-sm">Reply</button>
                </li>

                <li v-if="post.user_can.edit">
                    <button v-on:click='editing = true' class="text-indigo-500 text-sm">Edit</button>
                </li>
                <li v-if="post.user_can.delete">
                    <button v-on:click='deletePost' class="text-indigo-500 text-sm">Delete</button>
                </li>
                <li v-if="post.discussion.user_can.solve">
                    <button  
                        class="text-indigo-500 text-sm"
                        v-on:click="router.patch(route('discussions.solution.patch', post.discussion),{post_id:
                            isSolution ? null : post.id },{preserveScroll: true})"
                        >
                        {{ isSolution ? "Unmark" :"Mark" }} best Solution
                    </button>
                </li>
            </ul>
        </div>
        <div class="absolute right-0 top-0 bg-gray-800 text-gray-100 px-3 py-1 text-xs 
            uppercase tracking-wide font-semibold rounded-bl shadow-sm" v-if="isSolution">Best answer</div>
    </div>
</template>

<script setup>

import useCreatePost from '@/Composables/useCreatePost';
import TextArea from '../TextArea.vue';
import InputLabel from '../InputLabel.vue';
import PrimaryButton from '../PrimaryButton.vue';
import InputError from '../InputError.vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';


const props = defineProps({
    post: Object,
    isSolution: Boolean
})

const { showCreatePostForm } = useCreatePost()
const editing = ref(false)

const editForm = useForm({
    body: props.post.body
})
const editPost = () =>{
    editForm.patch(route('posts.patch', props.post),{
        preserveScroll: true,
        onSuccess: () => {editing.value = false}
    })
}
const deletePost = () =>{
    if(window.confirm('Are you sure?')){
        router.delete(route('posts.destroy', props.post),{
            preserveScroll:true
        })
    }
 
}



</script>