<template>
    <div>
        <div @click="toggle()" class="cursor-pointer">
            <slot name="toggle"></slot>
        </div>
        <div v-show="isOpen">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        mounted ()
        {
            document.addEventListener('click', (e) => this.close());
            this.$el.addEventListener('click', (e) => e.stopPropagation());
        },
        data   : () => ({
            isOpen: false,
        }),
        methods: {
            toggle ()
            {
                if (this.isOpen)
                {
                    this.isOpen = false
                    this.$emit('closed')
                }
                else
                {
                    this.isOpen = true
                    this.$emit('opened')
                }
            },
            open ()
            {
                if (!this.isOpen)
                {
                    this.isOpen = true
                    this.$emit('opened')
                }
            },
            close ()
            {
                if (this.isOpen)
                {
                    this.isOpen = false
                    this.$emit('closed')
                }
            },
        },
    }
</script>
