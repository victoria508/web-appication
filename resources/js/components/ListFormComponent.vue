<template>
    <div>
        <div v-for="(item, index) in listcpy">
            <div @remove="removeItem(index)">
                <slot v-bind:item="item" v-bind:index="index"></slot>
            </div>
        </div>

        <div @click="removeItem()">
            <slot name="remove"></slot>
        </div>

        <div @click="addItem()">
            <slot name="add"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props  : {
            list: Array,
        },
        data   : function ()
        {
            return {listcpy: this.list}
        },
        methods: {
            removeItem ()
            {
                this.listcpy.pop();
            },
            addItem ()
            {
                this.listcpy.push({key: '', value: ''})
            },
        },
    }
</script>
