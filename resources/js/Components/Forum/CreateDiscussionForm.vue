<script setup lang="ts">
import FixedFormWrapper from './FixedFormWrapper.vue';

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
                        <input type="text" name="" class="w-full">
                    </div>
                    <div>
                        <select >
                            <option value="">Laravel</option>
                        </select>
                    </div>
                </div> 
                <div>
                    <textarea name="" rows="4" id="" class="w-full" />
                </div>
            </template>
            <template v-slot:button>
                <button type="submit">Create </button> 
            </template>


        </FixedFormWrapper>
    </div>
</template>