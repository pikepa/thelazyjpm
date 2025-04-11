<script setup lang="ts">
import FixedFormWrapper from './FixedFormWrapper.vue';
import TextInput from '../TextInput.vue';
import InputLabel from '../InputLabel.vue';
import InputError from '../InputError.vue';
import SelectTopic from '../SelectTopic.vue';
</script>

<template>
    <div>
        <FixedFormWrapper>
            <template v-slot:header>
                <h1 class="text-lg font-medium">New Discussion</h1>
            </template>
            <template v-slot:main>
                <div class="flex items-start space-x-3">
                    <div class="flex-grow">
                        <div>
                            <InputLabel for="title" value="Tilte" class="sr-only"/>

                            <TextInput id="title" type="text" class="w-full" />

                            <!-- <InputError class="mt-2"  /> -->
                        </div>

                    </div>
                    <div>
                        <SelectTopic id="topic">
                            <option value="">Choose a Topic</option>
                            <option 
                                :value="topic.slug" 
                                v-for="topic in $page.props.topics" 
                                :key="topic.id">
                                {{ topic.title }}
                            </option>
                        </SelectTopic>
                    </div>
                </div>
                <div class="mt-2">
                    <textarea name="" rows="4" id="" class="w-full" />
                </div>
            </template>
            <template v-slot:button>
                <button type="submit">Create </button>
            </template>


        </FixedFormWrapper>
    </div>
</template>