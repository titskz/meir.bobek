<script setup lang="ts">
import { computed } from 'vue';

const props = withDefaults(
    defineProps<{
        name:
            | 'blocks'
            | 'palette'
            | 'hands'
            | 'flowers'
            | 'boy'
            | 'girl'
            | 'leaf'
            | 'pencil'
            | 'bush'
            | 'hearts';
        size?: number;
    }>(),
    { size: 120 },
);

/** Sprite regions for cliparts.png (1254×1254) */
const regions: Record<
    string,
    {
        x: number;
        y: number;
        w: number;
        h: number;
        sheetW: number;
        sheetH: number;
    }
> = {
    blocks: { x: 30, y: 30, w: 380, h: 380, sheetW: 1254, sheetH: 1254 },
    palette: { x: 430, y: 20, w: 390, h: 390, sheetW: 1254, sheetH: 1254 },
    hands: { x: 840, y: 10, w: 400, h: 400, sheetW: 1254, sheetH: 1254 },
    flowers: { x: 20, y: 430, w: 400, h: 300, sheetW: 1254, sheetH: 1254 },
    boy: { x: 420, y: 400, w: 360, h: 500, sheetW: 1254, sheetH: 1254 },
    girl: { x: 820, y: 390, w: 400, h: 510, sheetW: 1254, sheetH: 1254 },
    leaf: { x: 30, y: 920, w: 250, h: 200, sheetW: 1254, sheetH: 1254 },
    pencil: { x: 300, y: 900, w: 260, h: 220, sheetW: 1254, sheetH: 1254 },
    bush: { x: 580, y: 910, w: 320, h: 200, sheetW: 1254, sheetH: 1254 },
    hearts: { x: 920, y: 930, w: 300, h: 180, sheetW: 1254, sheetH: 1254 },
};

const region = computed(() => regions[props.name]);

const scale = computed(() => props.size / region.value.w);

const style = computed(() => {
    const r = region.value;
    const s = scale.value;
    return {
        width: `${props.size}px`,
        height: `${r.h * s}px`,
    };
});

const imgStyle = computed(() => {
    const r = region.value;
    const s = scale.value;
    return {
        width: `${r.sheetW * s}px`,
        height: `${r.sheetH * s}px`,
        marginLeft: `-${r.x * s}px`,
        marginTop: `-${r.y * s}px`,
    };
});
</script>

<template>
    <div class="inline-block overflow-hidden" :style="style" aria-hidden="true">
        <img
            src="/images/cliparts.png"
            alt=""
            class="max-w-none select-none"
            :style="imgStyle"
            draggable="false"
        />
    </div>
</template>
