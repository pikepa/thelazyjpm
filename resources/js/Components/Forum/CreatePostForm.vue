

<template>
    <div>
        <FixedFormWrapper v-if="visible" v-on:submit.prevent="createPost" :form="form">
            <template v-slot:header>
                <div class="flex items-center justify-between">
                    <h1 class="text-lg font-medium">Replying to {{ discussion.title }}</h1>
                    <button v-on:click="hideCreatePostForm">
                        <Svg class="h-5 w-5" name='icon-close' ></Svg>
                    </button>
                </div>
            </template>

            <template v-slot:main="{ markdownPreviewEnabled }">
                <div >
                    <InputLabel for="body" value="Body" class="sr-only" />
                    <TextArea id='body' v-if="!markdownPreviewEnabled" class="w-full h-48 align-top" v-model="form.body"/>
                    <InputError class="mt-2" :message="form.errors.body" />

                </div>
            </template>
            <template v-slot:button>
                <PrimaryButton >
                    Reply
                </PrimaryButton>
            </template>


        </FixedFormWrapper>
    </div>
</template>

<script setup lang="ts">
import FixedFormWrapper from './FixedFormWrapper.vue';
import InputLabel from '../InputLabel.vue';
import InputError from '../InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextArea from '../TextArea.vue';
import useCreatePost from '@/Composables/useCreatePost.js';
import { useForm } from '@inertiajs/vue3';
import Svg from '../Svg.vue';

const { visible , hideCreatePostForm, form, discussion} = useCreatePost()

const createPost = () => {
 
  
}
</script>