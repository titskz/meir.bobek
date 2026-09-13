<script setup lang="ts">
import { ref, watch } from 'vue';
import { Button } from '@/components/ui/button';

const model = defineModel<string>({ default: '' });
const editor = ref<HTMLElement | null>(null);

watch(
    model,
    (value) => {
        if (editor.value && editor.value.innerHTML !== value) {
            editor.value.innerHTML = value ?? '';
        }
    },
    { immediate: true },
);

const exec = (command: string, value?: string) => {
    document.execCommand(command, false, value);
    if (editor.value) {
        model.value = editor.value.innerHTML;
    }
};

const onInput = () => {
    if (editor.value) {
        model.value = editor.value.innerHTML;
    }
};
</script>

<template>
    <div class="space-y-2">
        <div class="bg-muted/40 flex flex-wrap gap-1 rounded-md border p-1">
            <Button
                type="button"
                variant="ghost"
                size="sm"
                @click="exec('bold')"
                >B</Button
            >
            <Button
                type="button"
                variant="ghost"
                size="sm"
                @click="exec('italic')"
                ><em>I</em></Button
            >
            <Button
                type="button"
                variant="ghost"
                size="sm"
                @click="exec('underline')"
                ><u>U</u></Button
            >
            <Button
                type="button"
                variant="ghost"
                size="sm"
                @click="exec('insertUnorderedList')"
                >• List</Button
            >
            <Button
                type="button"
                variant="ghost"
                size="sm"
                @click="exec('insertOrderedList')"
                >1. List</Button
            >
            <Button
                type="button"
                variant="ghost"
                size="sm"
                @click="exec('formatBlock', 'h3')"
                >H3</Button
            >
            <Button
                type="button"
                variant="ghost"
                size="sm"
                @click="exec('removeFormat')"
                >Clear</Button
            >
        </div>
        <div
            ref="editor"
            contenteditable
            class="prose prose-sm dark:prose-invert bg-background focus:ring-ring min-h-[200px] max-w-none rounded-md border px-3 py-2 focus:ring-2 focus:outline-none"
            @input="onInput"
        />
    </div>
</template>
