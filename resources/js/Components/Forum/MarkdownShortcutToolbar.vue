<template>
    <markdown-toolbar class="flex items-center">
        <md-bold class="cursor-pointer py-1.5 px-1">
            <Svg class="h-5 w-5" name="icon-bold"></Svg>
        </md-bold>
        <md-italic class="cursor-pointer py-1.5 px-1">
            <Svg class="h-5 w-5" name="icon-italic"></Svg>
        </md-italic>
        <md-code class="cursor-pointer py-1.5 px-1">
            <Svg class="h-5 w-5" name="icon-code"></Svg>
        </md-code>
        <md-link class="cursor-pointer py-1.5 px-1">
            <Svg class="h-5 w-5" name="icon-link"></Svg>
        </md-link>
        <md-mention class="cursor-pointer py-1.5 px-1">
            <Svg class="h-5 w-5" name="icon-at"></Svg>
        </md-mention>
    </markdown-toolbar>
</template>
<script setup>
import Svg from "../Svg.vue";
</script>
